<?php
/* @var $this yii\web\View */

//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\BaseController;
use dosamigos\chartjs\ChartJs;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use app\modules\setting\models\Setting;

$this->registerJsFile('@web/js/count.js');

$ajax = "$.ajax({
        url: '{url}',
        data: {
            wisata: {wisata},
        },
        method: 'POST',
        success: function (result) {
            $('.' + '{target}' + '{wisata}').empty();
            $('.' + '{target}' + '{wisata}').html(result);
        }
    })";

$this->title = 'Pengunjung';
?>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <?php foreach ($wisatas as $wisata): ?>
            <?php //$this->registerJs('MYLIBRARY.init(["'.$wisata->id.'","'.Url::to(['today']).'","'.Url::to(['week']).'","'.Url::to(['month']).'","'.Url::to(['year']).'"]);MYLIBRARY.getTotal();'); ?>
            <div class="x_panel">
                <div class="x_title">
                    <h1><?= Html::encode($wisata->wisata) ?></h1>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="x_panel">

                <div class="x_title">
                    <h2>Jumlah Pengunjung</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="row tile_count">
                    <?php
                    $ajax_today = str_replace('{url}', Url::to(['today']), $ajax);
                    $ajax_today = str_replace('{wisata}', $wisata->id, $ajax_today);
                    $ajax_today = str_replace('{target}', 'today_', $ajax_today);
                    $this->registerJs("window.today_" . $wisata->id . " = function () { $ajax_today };today_" . $wisata->id . "();setInterval(today_" . $wisata->id . ", " . Setting::getReload() . ");");
                    ?>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Hari ini</span>
                            <div class="count green today_<?= $wisata->id ?>">0</div>
                            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d')) ?></span>
                        </div>
                    </div>
                    <?php
                    $ajax_today = str_replace('{url}', Url::to(['week']), $ajax);
                    $ajax_today = str_replace('{wisata}', $wisata->id, $ajax_today);
                    $ajax_today = str_replace('{target}', 'week_', $ajax_today);
                    $this->registerJs("window.week_" . $wisata->id . " = function () { $ajax_today };week_" . $wisata->id . "();setInterval(week_" . $wisata->id . ", " . Setting::getReload() . ");");
                    ?>
                    <div class="animated flipInY col-md-3 col-sm-5 col-xs-5 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Minggu Ini</span>
                            <div class="count week_<?= $wisata->id ?>">0</div>
                            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d', strtotime('monday this week'))) ?> - <?= BaseController::indonesian_date(date('Y-m-d')) ?></span>
                        </div>
                    </div>
                    <?php
                    $ajax_today = str_replace('{url}', Url::to(['month']), $ajax);
                    $ajax_today = str_replace('{wisata}', $wisata->id, $ajax_today);
                    $ajax_today = str_replace('{target}', 'month_', $ajax_today);
                    $this->registerJs("window.month_" . $wisata->id . " = function () { $ajax_today };month_" . $wisata->id . "();setInterval(month_" . $wisata->id . ", " . Setting::getReload() . ");");
                    ?>
                    <div class="animated flipInY col-md-3 col-sm-5 col-xs-5 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Bulan Ini</span>
                            <div class="count month_<?= $wisata->id ?>">0</div>
                            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d'), 'F Y') ?></span>
                        </div>
                    </div>
                    <?php
                    $ajax_today = str_replace('{url}', Url::to(['year']), $ajax);
                    $ajax_today = str_replace('{wisata}', $wisata->id, $ajax_today);
                    $ajax_today = str_replace('{target}', 'year_', $ajax_today);
                    $this->registerJs("window.year_" . $wisata->id . " = function () { $ajax_today };year_" . $wisata->id . "();setInterval(year_" . $wisata->id . ", " . Setting::getReload() . ");");
                    ?>
                    <div class="animated flipInY col-md-3 col-sm-5 col-xs-5 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Tahun Ini</span>
                            <div class="count year_<?= $wisata->id ?>">0</div>
                            <span class="count_bottom"><?= BaseController::indonesian_date(date('Y-m-d'), 'Y') ?></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Total Pengunjung Masuk Berdasarkan Pintu Masuk</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="pengunjung_<?= $wisata->id ?>">
                        <?=
                        Highcharts::widget([
                            'id' => 'pengunjung_' . $wisata->id,
                            'scripts' => [
                                'modules/exporting',
//                                'themes/grid-light',
                            ],
                            'options' => [
                                'chart' => [
                                    'type' => 'column',
                                    'events' => [
                                        'load' => new JsExpression("function () {
                                            var series = this.series[0];
                                            var categories = this.xAxis[0];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['jam']) . "',
                                                    data: {
                                                        wisata: " . $wisata->id . ",
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        categories.setCategories(result.pukul);
                                                        series.setData(result.jumlah);
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
                                    'title' => ['text' => 'Orang']
                                ],
                                'plotOptions' => [
                                    'series' => [
                                        'borderWidth' => 0,
                                        'dataLabels' => [
                                            'enabled' => true,
                                        ],
                                    ]
                                ],
                                'series' => [
                                    ['name' => 'Jumlah Orang', 'data' => []],
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Total Pengunjung Masuk Perorangan Berdasarkan Pintu Masuk</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="perorangan_<?= $wisata->id ?>">
                        <?=
                        Highcharts::widget([
                            'options' => [
                                'chart' => [
                                    'type' => 'pie',
                                    'events' => [
                                        'load' => new JsExpression("function () {
                                            var series = this.series[0];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['perorangan']) . "',
                                                    data: {
                                                        wisata: " . $wisata->id . ",
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        series.setData(result);
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
                                'title' => ['text' => 'Pengunjung Perorangan'],
                                'plotOptions' => [
                                    'pie' => [
                                        'dataLabels' => [
                                            'format' => '<b>Jumlah {point.name}</b>: {point.y}',
                                        ],
                                    ],
                                ],
                                'series' => [
                                    [
                                        'data' => [
//                                            ['name' => 'Dewasa', 'y' => 10],
//                                            ['name' => 'Anak', 'y' => 20],
//                                            ['name' => 'Pelajar', 'y' => 50],
                                        ]
                                    ],
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Total Pengunjung dan Estimasi Pendapatan Berdasarkan Kasir</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="pendapatan_<?= $wisata->id ?>">
                        <?=
                        Highcharts::widget([
                            'options' => [
                                'chart' => [
                                    'zoomType' => 'xy',
                                    'events' => [
                                        'load' => new JsExpression("function () {
                                            var pengunjung = this.series[0];
                                            var pendapatan = this.series[1];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['estimasi']) . "',
                                                    data: {
                                                        wisata: " . $wisata->id . ",
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        pengunjung.setData(result.pengunjung);
                                                        pendapatan.setData(result.pendapatan);
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
                                'title' => [
                                    'text' => 'Total Pengunjung dan Estimasi Pendapatan',
                                ],
                                'xAxis' => [
                                    'categories' => ['Hari Ini'],
                                    'crosshair' => true,
                                ],
                                'yAxis' => [
                                    [
                                        'title' => [
                                            'text' => 'Total Pengunjung',
                                            'style' => [
                                                'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
                                            ]
                                        ]
                                    ],
                                    [
                                        'title' => [
                                            'text' => 'Estimasi Pendapatan',
                                            'style' => [
                                                'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
                                            ]
                                        ],
                                        'opposite' => true,
                                    ]
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
                                        'type' => 'column',
                                        'name' => 'Total Pengunjung',
                                        'data' => [],
                                    ],
                                    [
                                        'type' => 'column',
                                        'name' => 'Estimasi Pendapatan',
                                        'yAxis'=> 1,
                                        'data' => [],
                                    ],
                                ],
                            ]
                        ]);
                        ?>

                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Traffic Pintu Masuk</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="gate_<?= $wisata->id ?>">
                        <?=
                        Highcharts::widget([
                            'options' => [
                                'chart' => [
                                    'type' => 'column',
                                    'events' => [
                                        'load' => new JsExpression("function () {
                                            var series = this.series[0];
                                            var categories = this.xAxis[0];
                                            
                                            function getData() {
                                                $.ajax({
                                                    url: '" . Url::to(['pintu-masuk']) . "',
                                                    data: {
                                                        wisata: " . $wisata->id . ",
                                                    },
                                                    method: 'POST',
                                                    dataType : 'json',
                                                    success: function (result) {
                                                        categories.setCategories(result.gate);
                                                        series.setData(result.jumlah);
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
                                'title' => ['text' => 'Traffic Pintu Masuk'],
                                'xAxis' => [
                                    'categories' => []
                                ],
                                'yAxis' => [
                                    'title' => ['text' => 'Orang']
                                ],
                                'plotOptions' => [
                                    'series' => [
                                        'borderWidth' => 0,
                                        'dataLabels' => [
                                            'enabled' => true,
                                        ],
                                    ]
                                ],
                                'series' => [
                                    ['name' => 'Jumlah Orang', 'data' => []],
                                ]
                            ]
                        ]);
                        ?>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
