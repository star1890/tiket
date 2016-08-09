<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;

use app\modules\kasir\models\Kasir;

$this->title = 'Gateway';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <?php
            $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'action' => Url::to(['gateway']),
                'method' => 'post',
            ]);
            ?>

            <?=
            $form->field($model, 'workstation')->widget(Select2::classname(), [
                'data' => Kasir::getGateworkstation(),
                'options' => ['placeholder' => 'Pilih workstation ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton('Proses', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
