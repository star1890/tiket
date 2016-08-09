<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\master\models\Workstation;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\search\WorkstationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workstation';
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
                <?= Html::a('Tambah Workstation', ['tambah'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'workstation',
                    'workstation_ip',
                    [
                        'attribute'=>'kategori',
                        'filter' => Html::activeDropDownList($searchModel, 'wisata', Workstation::getListkategori(),['class'=>'form-control','prompt' => '']),
                        'value' => function ($data) {
                            return $data->detailkategori->kategori;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>
