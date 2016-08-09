<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

use app\components\barcode\BarcodeGenerator;

$this->registerJs("$( document ).ready(function() {
//  window.print(); window.close();
});");
$this->registerCssFile('@web/css/print.css');
?>

<div id="wrapper">
    
        <?php foreach ($tikets as $tiket) {
            $optionsArray = [
                'elementId'=> 'barcode_'.$tiket->id,
                'value' => $tiket->id,
                'type'=>'code39',
            ];
            echo BarcodeGenerator::widget($optionsArray);
        ?>
        <div id="receipt-data">
            <div style="text-align:center;">
                <h2>Taman Wisata Candi</h2>
            </div>
            <div style="clear:both;"></div>
            <table class="table table-striped table-condensed">
                <tbody>
                    <tr>
                        <td style="width: 50%">Kasir</td>
                        <td style="width: 50%">: <?= $trx->detailkasir->detailuser->name?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>: <?= date('d-m-Y', strtotime($trx->trx_date))?></td>
                    </tr>
                    <tr>
                        <td>No. Invoice</td>
                        <td>: <?= $trx->id?></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-striped table-condensed">
                <tbody>
                    <tr>
                        <td style="width: 50%">Kategori</td>
                        <td style="width: 50%">: <?= $tiket->kategoritiket->kategori?></td>
                    </tr>
                    <tr>
                        <td>Wisata</td>
                        <td>: <?= $tiket->wisatadesc->wisata?></td>
                    </tr>
                    <tr>
                        <td>Jenis</td>
                        <td>: <?= $tiket->kategoriperorangan->kategori?></td>
                    </tr>
                    <tr>
                        <td>Berlaku s/d</td>
                        <td>: <?= date('d-m-Y', strtotime($tiket->expired_date))?></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div id="barcode_<?=$tiket->id?>" class="barcode center"></div>
            <div class="text-barcode">
                <?= $tiket->id ?>
            </div>
        </div>
        <div style="page-break-after: always;"></div>
        <?php } ?>
    
</div>
