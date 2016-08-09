<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\master\models\HargaTiket;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\search\TiketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Tambah Tiket', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'id',
                        'filter' => false,
                    ],
                    [
                        'attribute'=>'wisata',
                        'filter' => Html::activeDropDownList($searchModel, 'wisata', HargaTiket::getListwisata(),['class'=>'form-control','prompt' => '']),
                        'value' => function ($data) {
                            return $data->wisatadesc->wisata;
                        },
                    ],
                    [
                        'attribute'=>'kategori_tiket',
                        'filter' => Html::activeDropDownList($searchModel, 'kategori_tiket', HargaTiket::getListtiket(),['class'=>'form-control','prompt' => '']),
                        'value' => function ($data) {
                            return $data->kategoritiket->kategori;
                        },
                    ],
                    [
                        'attribute'=>'kategori_perorangan',
                        'filter' => Html::activeDropDownList($searchModel, 'kategori_perorangan', HargaTiket::getListperorangan(),['class'=>'form-control','prompt' => '']),
                        'value' => function ($data) {
                            return $data->kategoriperorangan->kategori;
                        },
                    ],
                    [
                        'attribute'=>'harga',
                        'filter' => false,
                        'value' => function ($data) {
                            return number_format($data->harga);
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>
