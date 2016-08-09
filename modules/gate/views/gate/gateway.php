<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile('@web/js/tiket.js');

$this->title = 'Gateway';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-barcode"></i>
                </span>
                <?=
                Html::input('text', 'tiket', '', [
                    'class' => 'form-control tiket',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                    'placeholder' => 'Scan barcode / ketik kode tiket untuk validasi tiket.',
                    'data-url' => Url::to(['get-tiket']),
                    'data-workstation' => $workstation->id,
                    'data-wisata' => $workstation->wisata,
                ])
                ?>
            </div>

            <div class="ln_solid"></div>

            <div id="info"></div>
        </div>
    </div>
</div>
