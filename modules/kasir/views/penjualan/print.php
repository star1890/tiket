<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

use app\components\barcode\BarcodeGenerator;
use app\components\BaseController;

$this->registerJs("$( document ).ready(function() {
  window.print(); window.close();
});");
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
                <h1><?= $tiket->kategoriperorangan->kategori?></h1>
            </div>
            <div style="clear:both;"></div>
            <hr>
            
            <div>
                <table style="margin: 0 auto;">
                    <tr>
                        <td style="text-align:center;"><?= Html::img('@web/images/candi.png',['width'=>'90%','height'=>'90%']);?></td>
                        <td style="text-align:center;">Taman Wisata Candi</td>
                        <td style="text-align:center;"><?= Html::img('@web/images/brisyariah.jpg',['width'=>'90%','height'=>'90%']);?></td>
                    </tr>
                </table>
            </div>
            <div style="clear:both;"></div>
            <div style="text-align:center;">
                <?= $tiket->kategoritiket->kategori?>
            </div>
            <div style="text-align:center;">
                Tiket Masuk Candi <?= $tiket->wisatadesc->wisata?>
            </div>
            <div style="clear:both;"></div>
            <hr>
            
            <div>
                <table style="margin: 0 auto;">
                    <tr>
                        <td style="text-align:center;"><?= BaseController::indonesian_date(date('d-m-Y',  strtotime($tiket->create_date)));?></td>
                        <td style="text-align:center;"><?=date('H:i:s',  strtotime($tiket->create_date))?></td>
                    </tr>
                </table>
            </div>
            <div style="clear:both;"></div>
            
            <div id="barcode_<?=$tiket->id?>" class="barcode" style="margin: 0 auto;"></div>
            <div style="clear:both;"></div>
            
            <div style="text-align:center;">
                <?= $tiket->id ?>
            </div>
            <hr>
            
        </div>
        <div style="page-break-after: always;"></div>
        <?php } ?>
    
</div>
