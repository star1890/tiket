<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kasir\models\Kasir */

$this->title = 'Update Kasir: ' . ' ' . $model->kasir_id;
$this->params['breadcrumbs'][] = ['label' => 'Kasirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kasir_id, 'url' => ['view', 'id' => $model->kasir_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kasir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
