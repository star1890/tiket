<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
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
                <?= Html::a('Tambah User', ['tambah'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'filter' => false,
                    ],
                    'username',
                    'name',
                    [
                        'attribute' => 'role',
                        'filter' => Html::activeDropDownList($searchModel, 'role', User ::getRole(),['class'=>'form-control','prompt' => '']),
                    ],
                    [
                        'attribute' => 'last_ip',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'last_login',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => Html::activeDropDownList($searchModel, 'status', ['1'=>'Aktif','2'=>'Tidak Aktif'],['class'=>'form-control','prompt' => '']),
                        'value' => function($data){
                            return User::getStatus($data->status);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>
