<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Workstation */

$this->title = $model->workstation;
$this->params['breadcrumbs'][] = ['label' => 'Workstation', 'url' => ['index']];
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
                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Anda yakin ingin hapus item ini?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'workstation',
                    'workstation_ip',
                    [
                        'attribute' => 'wisata',
                        'value' => $model->wisatadesc,
                    ],
                    [
                        'attribute' => 'kategori',
                        'value' => $model->detailkategori->kategori,
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
