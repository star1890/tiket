<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{input}\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);
?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'email','placeholder'=>'Username','autocomplete'=>'off']) ?>

<?= $form->field($model, 'password')->passwordInput(['class'=>'password','placeholder'=>'Password','autocomplete'=>'off']) ?>

<div class="submit">
    <input type="submit" value="LOGIN"/>
</div>

<?php ActiveForm::end(); ?>
