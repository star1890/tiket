<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\widgets\AlertBlock;
use app\modules\kasir\models\Kasir;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kasir\models\search\KasirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kasir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>
            
            <?php echo AlertBlock::widget([
                'useSessionFlash' => true,
                'type' => AlertBlock::TYPE_ALERT,
                'delay' => 5000,
            ]);?>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Buka Kasir', ['buka'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'kasir_id',
                    [
                        'attribute'=>'user',
                        'value' => function ($data) {
                            return $data->detailuser->name;
                        },
                    ],
                    [
                        'attribute'=>'workstation',
                        'filter' => Html::activeDropDownList($searchModel, 'workstation', Kasir::getKasirworkstation(),['class'=>'form-control','prompt' => '']),
                        'value' => function ($data) {
                            return $data->detailworkstation->workstation;
                        },
                    ],
                    [
                        'attribute'=>'transactions',
                        'filter'=>false,
                    ],
                    [
                        'attribute'=>'open_date',
                        'filter'=>false,
                    ],

                    [
                        'class' => '\kartik\grid\ActionColumn',
                        'dropdown' => true,
                        'dropdownOptions'=>['class'=>'pull-right'],
                        
                        'template' => '{tutup}',
                        'buttons' => [
                            'tutup' => function ($url, $model) {
                                return Html::a('<h4><i class="fa fa-close"></i> Tutup Kasir</h4>', $url, [
                                    'title' => Yii::t('app', 'Tutup Kasir'),
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>
