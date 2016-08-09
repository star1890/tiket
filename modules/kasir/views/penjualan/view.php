<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\AlertBlock;
use yii\helpers\Url;

$this->registerCssFile('@web/css/invoice.css');

$this->title = 'Invoice';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("window.open('" . Url::to(['print', 'id' => $trx->id]) . "', '_blank', 'toolbar=0,location=0,menubar=0');");
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <?php
            echo AlertBlock::widget([
                'useSessionFlash' => true,
                'type' => AlertBlock::TYPE_ALERT,
                'delay' => 0,
            ]);
            ?>
            <div style="width: auto; max-width: 480px; min-width: 250px; margin: 0 auto;">

                <div id="receipt-data">
                    <div style="text-align:center;">
                        <h2>Taman Wisata Candi</h2>
                    </div>
                    <div style="clear:both;"></div>
                    <div style="text-align:center;">
                        No. Invoice: <?= $trx->id ?></br>
                        Kasir: <?= $trx->detailkasir->detailuser->name ?></br>
                        Tanggal: <?= date('d-m-Y', strtotime($trx->trx_date)) ?></br>
                    </div>
                    <div style="clear:both;"></div>
                    <table id="invoiceTable" class="table table-striped">
                        <tbody>
                                <?php
                                    foreach ($tikets as $tiket):
                                    $id = $tiket->kategori_tiket . $tiket->wisata . $tiket->kategori_perorangan;
                                ?>
                                <tr>
                                    <td><?= $tiket->kategoritiket->kategori ?></br><?= $tiket->wisatadesc->wisata ?></br><?= $tiket->kategoriperorangan->kategori ?></td>
                                    <td class="invoice-qty"><div id="qty_<?= $id ?>">1</div></td>
                                    <td class="invoice-harga"><div id="harga_<?= $id ?>"><?= number_format($tiket->harga) ?></div></td>
                                    <td class="invoice-harga"><div id="total_<?= $id ?>"><?= number_format($tiket->harga) ?></div></td>
                                </tr>  
                                <?php
                                endforeach; 
                                ?>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Total Pembelian</td>
                                <td class="invoice-harga"><?= number_format($trx->total_pembelian) ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Pembayaran</td>
                                <td class="invoice-harga"><?= $trx->tipe_pembayaran ?></td>
                            </tr>
                            <tr>
                                <td>Bayar</td>
                                <td class="invoice-harga"><?= number_format($trx->uang_dibayar) ?></td>
                            </tr>
                            <tr>
                                <td>Kembali</td>
                                <td class="invoice-harga"><?= number_format($trx->kembalian) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
