<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\AlertBlock;
use app\assets\PerfectScrollbarAsset;

PerfectScrollbarAsset::register($this);

$this->title = 'Penjualan';

$this->registerJsFile('@web/js/menu-toggle.js');
$this->registerCssFile('@web/css/pos.css');
?>
<div class="row pos">

    <table class="layout-table" style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 460px;vertical-align: top;">
                    <div id="pos">
                        <div id="leftdiv" class="well well-sm">
                            <div id="print">
                                <div id="list-table-div" class="ps-container" style="height: 0px;">
                                    <table id="posTable" class="table table-striped table-condensed table-hover list-table" style="margin:0;">
                                        <thead>
                                            <tr class="success">
                                                <th>Product</th>
                                                <th style="width: 15%;text-align:center;">Price</th>
                                                <th style="width: 15%;text-align:center;">Qty</th>
                                                <th style="width: 20%;text-align:center;">Subtotal</th>
                                                <th class="satu" style="width: 20px;"><i class="fa fa-trash-o"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                            <tr class="18 danger">
                                                <td>Borobudur</td>
                                                <td class="text-right">30,000</td>
                                                <td>1</td>
                                                <td class="text-right">30,000</td>
                                                <td class="text-center"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="clear:both;"></div>
                                <div id="totaldiv">
                                    <table id="totaltbl" class="table totals" style="margin-bottom:10px;">
                                        <tbody>
                                            <tr class="info">
                                                <td width="25%">Total Item</td>
                                                <td class="text-right" style="padding-right:10px;"><span id="count">0 (0.00)</span></td>
                                                <td width="25%">Total</td>
                                                <td class="text-right" colspan="2"><span id="total">0.00</span></td>
                                            </tr>
                                            <tr class="success">
                                                <td style="font-weight:bold;" colspan="2">Total Pembelian</td>
                                                <td class="text-right" style="font-weight:bold;" colspan="2"><span id="total-payable">0.00</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="botbuttons" class="col-xs-12 text-center">
                                <div class="row">
                                    <div class="col-xs-4" style="padding: 0;">
                                        <button id="batal" class="btn btn-danger btn-block btn-flat" style="height:67px;" type="button">Batal</button>
                                    </div>
                                    <div class="col-xs-4" style="padding: 0 5px;">
                                        
                                    </div>
                                    <div class="col-xs-4" style="padding: 0;">
                                        <button id="bayar" class="btn btn-success btn-block btn-flat" style="height:67px;" type="button">Bayar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </td>

                <td>
                    <div id="right-col" class="contents">
                        <div id="item-list">
                            <div class="items ps-container">
                                <div>
                                    <?php for ($i=1;$i<=12;$i++):?>
                                    <button class="btn btn-both btn-flat product" value="00011" id="product-0206" data-name="coco" type="button">
                                        <span><span>
                                                <p>Tiket Reguler</p>
                                                <p>Borobudur</p>
                                                <p>Dewasa</p>
                                        </span></span>
                                    </button>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>
                        <div class="product-nav">
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <button id="previous" class="btn btn-warning pos-tip btn-flat" type="button" style="z-index:10002;" disabled="disabled">
                                        <i class="fa fa-chevron-left"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    
                                </div>
                                <div class="btn-group">
                                    <button id="next" class="btn btn-warning pos-tip btn-flat" type="button" style="z-index:10004;" disabled="disabled">
                                        <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</div>
