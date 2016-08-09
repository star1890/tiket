<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\AlertBlock;

$this->title = 'Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>
            
            <?php echo AlertBlock::widget([
                'useSessionFlash' => true,
                'type' => AlertBlock::TYPE_ALERT,
                'delay' => 0,
            ]);?>
            
        </div>
    </div>
</div>
