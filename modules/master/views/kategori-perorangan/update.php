<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\KategoriPerorangan */

$this->title = 'Ubah Kategori Perorangan: ' . ' ' . $model->kategori;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Perorangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kategori, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
