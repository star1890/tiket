<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Tiket */

$this->title = $model->wisatadesc->wisata .' ['.$model->kategoritiket->kategori.' '.$model->kategoriperorangan->kategori.']';
$this->params['breadcrumbs'][] = ['label' => 'Tiket', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute'=>'wisata',
                        'value'=>$model->wisatadesc->wisata,
                    ],
                    [
                        'attribute'=>'kategori_tiket',
                        'value'=>$model->kategoritiket->kategori,
                    ],
                    [
                        'attribute'=>'kategori_perorangan',
                        'value'=>$model->kategoriperorangan->kategori,
                    ],
                    [
                        'attribute'=>'harga',
                        'value'=>'Rp. '.  number_format($model->harga),
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
