<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\AlertBlock;
use app\assets\PerfectScrollbarAsset;
use kartik\grid\GridView;
use yii\bootstrap\Button;
use kartik\form\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

use app\modules\master\models\HargaTiket;

//PerfectScrollbarAsset::register($this);

$this->title = 'Penjualan';

$this->registerJsFile('@web/js/perfect-scrollbar.jquery.min.js');
$this->registerJsFile('@web/js/pos.js');
$this->registerCssFile('@web/css/pos.css');

//echo '11749'.str_shuffle(round(microtime(true) * 1000));
//echo strtoupper('11749'.substr(str_shuffle(MD5(round(microtime(true) * 1000))), 0, 10));
?>
<div class="row pos">
    <table class="layout-table" style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 460px;vertical-align: top;">
                    <?php $form = ActiveForm::begin(['id'=>'form-penjualan']); ?>
                    <div id="pos">
                        <div id="leftdiv" class="well well-sm">
                            <div id="print">
                                <div id="list-table-div" class="ps-container" style="height: 0px;">
                                    <table id="posTable" class="table table-striped table-hover list-table" style="margin:0;">
                                        <thead>
                                            <tr class="success">
                                                <th>Product</th>
                                                <th style="width: 15%;text-align:center;">Price</th>
                                                <th style="width: 15%;text-align:center;">Qty</th>
                                                <th style="width: 20%;text-align:center;">Subtotal</th>
                                                <th class="satu" style="width: 20px;"><i class="fa fa-trash-o"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div style="clear:both;"></div>
                                <div id="totaldiv">
                                    <table id="totaltbl" class="table totals" style="margin-bottom:10px;">
                                        <tbody>
                                            <tr class="success">
                                                <td style="font-weight:bold;" colspan="2">Total Pembelian</td>
                                                <td class="text-right" style="font-weight:bold;" colspan="2"><span class="total_pembayaran">0</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="botbuttons" class="col-xs-12 text-center">
                                <div class="row">
                                    <div class="col-xs-6" style="padding: 0;">
                                        <button id="batal" class="btn btn-danger btn-block btn-flat" type="button">Batal</button>
                                    </div>
                                    <div class="col-xs-6" style="padding: 0;">
                                        <?=
                                        Html::button('Pembayaran', [
                                            'id' => 'bayar',
                                            'class' => 'btn btn-success btn-block btn-flat',
                                            'data' => [
                                                'toggle' => 'modal',
                                                'target' => '#pembayaran',
                                            ],
                                        ])
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php
                    Modal::begin([
                        'id' => 'pembayaran',
                        'header' => '<h2>Pembayaran</h2>',
                        'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data' => ['dismiss' => 'modal']]) . ' <div id="modal-button">' . Html::submitButton('Proses', ['class' => 'btn btn-success']) . '</div>',
                    ]);
                    ?>
                    <div id="modal-warning">Pilih Produk Terlebih Dahulu.</div>

                    <div id="modal-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered list-table" style="margin-bottom: 0;">
                                    <tbody>
                                        <tr>
                                            <td class="text-middle" width="25%" style="border-right-color: #FFF !important;">Total Pembelian</td>
                                            <td class="text-right" width="25%">
                                                <span class="total_pembayaran">0</span>
                                            </td>
                                            <td class="text-middle" width="25%" style="border-right-color: #FFF !important;">Saldo Kas</td>
                                            <td class="text-right" width="25%">
                                                <span class="saldo_kas">0</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= $form->field($model, 'tipe_pembayaran')->dropDownList(['Tunai' => 'Tunai']) ?>
                            </div>
                            <div class="col-xs-6">
                                <?=
                                $form->field($model, 'uang_dibayar', [
                                    'addon' => [
                                        'prepend' => [
                                            'content' => 'Rp.'
                                        ]
                                    ]
                                ])->widget('yii\widgets\MaskedInput', [
                                    'clientOptions' => [
                                        'alias' => 'decimal',
                                        'groupSeparator' => ',',
                                        'autoGroup' => true
                                    ]
                                ])
                                ?>
                            </div>
                            <div class="col-xs-6">
                                <?= $form->field($model, 'kembalian', [
                                    'addon' => [
                                        'prepend' => [
                                            'content' => 'Rp.'
                                        ]
                                    ]
                                ])->textInput(['maxlength' => true, 'readonly' => true]) ?>
                                <?= $form->field($model, 'total_pembelian',['showLabels'=>false])->hiddenInput() ?>
                            </div>
                        </div>
                        <div id="peringatan"></div>
                    </div>
                    <?php
                    Modal::end();
                    ?>
                    <?php ActiveForm::end(); ?>
                </td>

                <td>
                    <?php Pjax::begin(); ?> 
                    <?=
                    GridView::widget([
                        'id' => 'list-item',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'kategori_tiket',
                                'filter' => Html::activeDropDownList($searchModel, 'kategori_tiket', HargaTiket::getListtiket(), ['class' => 'form-control', 'prompt' => '']),
                                'value' => function ($data) {
                            return $data->kategoritiket->kategori;
                        },
                            ],
                            [
                                'attribute' => 'wisata',
                                'filter' => Html::activeDropDownList($searchModel, 'wisata', HargaTiket::getListwisata(), ['class' => 'form-control', 'prompt' => '']),
                                'value' => function ($data) {
                            return $data->wisatadesc->wisata;
                        },
                            ],
                            [
                                'attribute' => 'kategori_perorangan',
                                'filter' => Html::activeDropDownList($searchModel, 'kategori_perorangan', HargaTiket::getListperorangan(), ['class' => 'form-control', 'prompt' => '']),
                                'value' => function ($data) {
                            return $data->kategoriperorangan->kategori;
                        },
                            ],
                            [
                                'attribute' => 'harga',
                                'filter' => false,
                                'value' => function ($data) {
                                    return number_format($data->harga);
                                },
                            ],
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'template' => '{tambah}',
                                'buttons' => [
                                    'tambah' => function ($url, $model) {
                                        return Button::widget([
                                                    'label' => 'Tambah',
                                                    'options' => [
                                                        'class' => 'btn-success pilih-item',
                                                        'data-id' => $model->id,
                                                        'data-tiket' => $model->kategoritiket->kategori,
                                                        'data-wisata' => $model->wisatadesc->wisata,
                                                        'data-perorangan' => $model->kategoriperorangan->kategori,
                                                        'data-harga' => $model->harga,
                                                        'onclick' => 'aksi(this);',
                                                    ],
                                        ]);
                                    },
                                        ],
                                    ],
                                ],
                            ]);
                            ?>
                            <?php Pjax::end(); ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
