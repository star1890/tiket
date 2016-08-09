<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\Url;
use app\components\BaseController;
use app\modules\setting\models\Setting;

$this->registerJsFile('@web/js/count.js');
$this->title = 'Dashboard';

$ajax = "$.ajax({
        url: '{url}',
        data: {
            wisata: {wisata},
            tanggal: '{tanggal}',
        },
        method: 'POST',
        success: function (result) {
            $('.' + '{target}').empty();
            $('.' + '{target}').html(result);
        }
    })";
?>

<div class="row tile_count">

    <?php
    $ajax_today = str_replace('{url}', Url::to(['today']), $ajax);
    $ajax_today = str_replace('{wisata}', 1, $ajax_today);
    $ajax_today = str_replace('{tanggal}', date('Y-m-d'), $ajax_today);
    $ajax_today = str_replace('{target}', 'borobudur', $ajax_today);
    $this->registerJs("window.borobudur = function () { $ajax_today };borobudur();setInterval(borobudur, " . Setting::getReload() . ");");
    ?>
    <div class="animated flipInY col-md-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Borobudur</span>
            <div class="count green borobudur">0</div>
            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d')) ?></span>
        </div>
    </div>

    <?php
    $ajax_today = str_replace('{url}', Url::to(['today']), $ajax);
    $ajax_today = str_replace('{wisata}', 2, $ajax_today);
    $ajax_today = str_replace('{tanggal}', date('Y-m-d'), $ajax_today);
    $ajax_today = str_replace('{target}', 'prambanan', $ajax_today);
    $this->registerJs("window.prambanan = function () { $ajax_today };prambanan();setInterval(prambanan, " . Setting::getReload() . ");");
    ?>
    <div class="animated flipInY col-md-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Prambanan</span>
            <div class="count green prambanan">0</div>
            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d')) ?></span>
        </div>
    </div>

    <?php
    $ajax_today = str_replace('{url}', Url::to(['today']), $ajax);
    $ajax_today = str_replace('{wisata}', 3, $ajax_today);
    $ajax_today = str_replace('{tanggal}', date('Y-m-d'), $ajax_today);
    $ajax_today = str_replace('{target}', 'boko', $ajax_today);
    $this->registerJs("window.boko = function () { $ajax_today };boko();setInterval(boko, " . Setting::getReload() . ");");
    ?>
    <div class="animated flipInY col-md-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Ratu Boko</span>
            <div class="count green boko">0</div>
            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d')) ?></span>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Total Pengunjung</h2>
                <div class="clearfix"></div>
            </div>

            <?=
            Highcharts::widget([
                'scripts' => [
                    'modules/exporting',
                ],
                'options' => [
                    'chart' => [
                        'type' => 'column',
                        'events' => [
                            'load' => new JsExpression("function () {
                                            var categories = this.xAxis[0];
                                            
                                            var borobudur = this.series[0];
                                            var prambanan = this.series[1];
                                            var boko = this.series[2];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['jam']) . "',
                                                    data: {
                                                        tanggal: '" . date('Y-m-d') . "',
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        categories.setCategories(result.pukul);
                                                        
                                                        borobudur.setData(result.borobudur);
                                                        prambanan.setData(result.prambanan);
                                                        boko.setData(result.boko);
                                                    }
                                                });
                                            }
                                            
                                            getData();
                                                
                                            setInterval(function () {
                                                getData();
                                            }, " . Setting::getReload() . ");
                                        }"),
                        ],
                    ],
                    'title' => ['text' => 'Total Pengunjung'],
                    'xAxis' => [
                        'categories' => []
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Total Pengunjung']
                    ],
                    'plotOptions' => [
                        'series' => [
                            'borderWidth' => 0,
                            'dataLabels' => [
                                'enabled' => true,
                            ],
                        ]
                    ],
                    'tooltip' => [
                        'shared' => true,
                    ],
                    'series' => [
                        [
                            'name' => 'Borobudur',
                            'data' => [],
                        ],
                        [
                            'name' => 'Prambanan',
                            'data' => [],
                        ],
                        [
                            'name' => 'Ratu Boko',
                            'data' => [],
                        ],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Estimasi Pendapatan</h2>
                <div class="clearfix"></div>
            </div>

            <?=
            Highcharts::widget([
                'scripts' => [
                    'modules/exporting',
                ],
                'options' => [
                    'chart' => [
                        'type' => 'column',
                        'events' => [
                            'load' => new JsExpression("function () {
                                            var categories = this.xAxis[0];
                                            
                                            var borobudur = this.series[0];
                                            var prambanan = this.series[1];
                                            var boko = this.series[2];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['jam']) . "',
                                                    data: {
                                                        tanggal: '" . date('Y-m-d') . "',
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        categories.setCategories(result.pukul);
                                                        
                                                        borobudur.setData(result.borobudur_pendapatan);
                                                        prambanan.setData(result.prambanan_pendapatan);
                                                        boko.setData(result.boko_pendapatan);
                                                    }
                                                });
                                            }
                                            
                                            getData();
                                                
                                            setInterval(function () {
                                                getData();
                                            }, " . Setting::getReload() . ");
                                        }"),
                        ],
                    ],
                    'title' => ['text' => 'Estimasi Pendapatan'],
                    'xAxis' => [
                        'categories' => []
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Estimasi Pendapatan']
                    ],
                    'plotOptions' => [
                        'series' => [
                            'borderWidth' => 0,
                            'dataLabels' => [
                                'enabled' => true,
                            ],
                        ]
                    ],
                    'tooltip' => [
                        'shared' => true,
                    ],
                    'series' => [
                        [
                            'name' => 'Borobudur',
                            'data' => [],
                        ],
                        [
                            'name' => 'Prambanan',
                            'data' => [],
                        ],
                        [
                            'name' => 'Ratu Boko',
                            'data' => [],
                        ],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
</div>