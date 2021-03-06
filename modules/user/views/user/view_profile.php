<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Detail User <?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <p>
                <?= Html::a('Ubah Password', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'name',
                    'role',
                    'last_ip',
                    'last_login',
                    [
                        'label' => 'Status',
                        'value' => User::getStatus($model->status),
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
