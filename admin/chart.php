<link rel="stylesheet" href="http://jtblin.github.io/angular-chart.js/node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="http://jtblin.github.io/angular-chart.js/node_modules/angular/angular.min.js"></script>
<script src="http://jtblin.github.io/angular-chart.js/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="http://jtblin.github.io/angular-chart.js/dist/angular-chart.js"></script>

<!--

Attributes that should be changed -

1. class = "chart-" example: chart-bar, chart-line, chart-doughnut
2. chart-data = This will contain the comma seperated arryas with values example [ [10,20,30,40], [50,60,70,80] ]
3. chart-label = These are text that we want on the chart axis to identify to the data columns.
4. chart-series = These are the grouping of the data
5. chart-options = Some extra options that we want to have to customise the chart. example animation, layout, legend, layout, title, tooltip, elements
6. chart-dataset-override = Override settings related to axis or metrics

-->

<body ng-app="app">
<div class="col-md-12" ng-controller="ChartCtrl">

    <div class="col-md-12">

        <!-------- Linear Charts -------->
        <div class="row">
            <!-- Linear Chart - Single Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h4>Linear Chart - Single Y Axis</h4>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="optionsLinearSingle" chart-dataset-override="datasetOverrideSingle" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Linear Chart - Single Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h4>Linear Chart - Multi Y Axis</h4>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="optionsLinearDouble" chart-dataset-override="datasetOverrideDouble" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Line Chart - Single Axis-->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h4>Line Chart - Single Y Axis</h4>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="optionsLineSingle" chart-dataset-override="datasetOverrideSingle" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Line Chart - Single Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h4>Line Chart - Single Y Axis</h4>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="optionsLineDouble" chart-dataset-override="datasetOverrideDouble" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-------- Bar Charts -------->
        <div class="row">
            <!-- Bar Chart - Single Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Vertical Single</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-bar" chart-data="BarDatasingle" chart-labels="BarLabelsMultiple" chart-series="BarSeriesMultiple" chart-options="optionsLineSingle" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Bar Chart - Single Horizontal Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Horizontal Single</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-horizontal-bar" chart-data="BarDataSingle" chart-labels="BarLabelsMultiple" chart-series="BarSeriesMultiple" chart-options="BarOptions" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Bar Chart - Multiple Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Vertical Multiple grouped</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-bar" chart-data="BarDataMultiple" chart-labels="BarLabelsMultiple" chart-options="BarOptions" chart-series="BarSeriesMultiple" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Bar Chart - Single Horizontal Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Horizontal Multiple grouped</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-horizontal-bar" chart-data="BarDataMultiple" chart-options="BarOptions" chart-labels="BarLabelsMultiple" chart-series="BarSeriesMultiple" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-------- Stacked & Pie Charts -------->
        <div class="row">
            <!-- Bar Chart - Stacked Vertical Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Stacked Vertical Axis</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-bar" chart-data="BarDataMultiple" chart-options="StackedBarOptions" chart-dataset-override="StackedBarOverride" chart-labels="BarLabelsMultiple" chart-series="BarSeriesMultiple" chart-colors="['#9575cd', '#7986cb', '#90caf9']" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Bar Chart - Stacked Horizontal Axis -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Stacked Horizontal Axis</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="line" class="chart chart-horizontal-bar" chart-data="BarDataMultiple" chart-options="StackedBarOptions" chart-dataset-override="StackedBarOverride" chart-labels="BarLabelsMultiple" chart-series="BarSeriesMultiple" chart-colors="['#9575cd', '#7986cb', '#90caf9']" chart-click="onClick">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Doughnut Chart -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Doughnut Chart</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="chartDoughnut" class="chart chart-doughnut" chart-data="DoughnutPieData" chart-labels="DoughnutPieLabels" chart-options="DoughnutPieoptions"></canvas>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Pie Chart</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="chartPie" class="chart chart-pie" chart-data="DoughnutPieData" chart-labels="DoughnutPieLabels" chart-options="DoughnutPieoptions"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extended Bar Charts -->
        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Bar Chart - Mixed with Line Chart</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="base" class="chart-bar" chart-data="MixedData" chart-labels="MixedLabels" chart-colors="MixedColors" chart-dataset-override="MixedDatasetOverride" chart-options="MixedOptions">
                        </canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-head">
                        <h3>Mixed - Stacked Bar & Group Bar chart</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="base" class="chart-bar" chart-data="MixedData" chart-labels="MixedLabels" chart-colors="MixedColors" chart-dataset-override="MixedDatasetOverride" chart-options="MixedOptions">
                        </canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</div>
</body>
<script>
    angular.module("app", ["chart.js"]).controller("ChartCtrl", function ($scope) {
        // -------- Linear Charts --------

        $scope.labels = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July"
        ];
        $scope.series = ["Series A", "Series B"];
        $scope.data = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90]
        ];
        $scope.onClick = function (points, evt) {
            console.log(points, evt);
        };

        // Linear - Single Axis
        $scope.datasetOverrideSingle = [{ yAxisID: "y-axis-1" }];
        $scope.optionsLinearSingle = {
            scales: {
                yAxes: [
                    {
                        id: "y-axis-1",
                        type: "linear",
                        display: true,
                        position: "left"
                    }
                ]
            },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };
        // Line - Single Axis
        $scope.optionsLineSingle = {
            scales: {
                yAxes: [
                    {
                        id: "y-axis-1",
                        type: "linear",
                        display: true,
                        position: "left"
                    }
                ]
            },
            elements: { line: { tension: 0 } },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // Linear - Double Axis
        $scope.datasetOverrideDouble = [
            { yAxisID: "y-axis-1" },
            { yAxisID: "y-axis-2" }
        ];
        $scope.optionsLinearDouble = {
            scales: {
                yAxes: [
                    {
                        id: "y-axis-1",
                        type: "linear",
                        display: true,
                        position: "left"
                    },
                    {
                        id: "y-axis-2",
                        type: "linear",
                        display: true,
                        position: "right"
                    }
                ]
            },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };
        // Line - Double
        $scope.optionsLineDouble = {
            scales: {
                yAxes: [
                    {
                        id: "y-axis-1",
                        type: "linear",
                        display: true,
                        position: "left"
                    },
                    {
                        id: "y-axis-2",
                        type: "linear",
                        display: true,
                        position: "right"
                    }
                ]
            },
            elements: { line: { tension: 0 } },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // -------- Bar Charts --------

        // Bar - Single
        $scope.BarLabelsSingle = [
            "2006",
            "2007",
            "2008",
            "2009",
            "2010",
            "2011",
            "2012"
        ];
        $scope.BarSeriesSingle = ["Series A", "Series B"];

        $scope.BarDataSingle = [[65, 59, 80, 81, 56, 55, 40]];

        // Bar - Multiple
        $scope.BarLabelsMultiple = [
            "2006",
            "2007",
            "2008",
            "2009",
            "2010",
            "2011",
            "2012"
        ];
        $scope.BarSeriesMultiple = ["Series A", "Series B", "Series C"];

        $scope.BarDataMultiple = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90],
            [35, 46, 99, 56, 23, 50, 20]
        ];

        // Bar - Single
        $scope.BarDatasingle = [[65, 59, 80, 81, 56, 55, 40]];

        // Bar - Single
        $scope.BarOptions = {
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // stacked horizontal
        $scope.StackedHBarOptions = {
            scales: {
                xAxes: [
                    {
                        stacked: true
                    }
                ],
                yAxes: [
                    {
                        stacked: true
                    }
                ]
            },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        $scope.StackedBarOptions = {
            scales: {
                xAxes: [
                    {
                        stacked: true
                    }
                ],
                yAxes: [
                    {
                        stacked: true
                    }
                ]
            },
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // Doughtnut
        $scope.DoughnutPieLabels = [
            "Download Sales",
            "In-Store Sales",
            "Mail-Order Sales"
        ];
        $scope.DoughnutPieData = [300, 500, 100];
        $scope.DoughnutPieoptions = {
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // Mixed Data
        $scope.MixedColors = ["#45b7cd", "#ff6384", "#ff8e72"];
        $scope.MixedLabels = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];
        $scope.MixedData = [
            [65, 20, 80, 81, 30, 55, 10],
            [28, 48, 20, 19, 86, 27, 90]
        ];
        $scope.MixedDatasetOverride = [
            {
                label: "Bar chart",
                borderWidth: 1,
                type: "bar"
            },
            {
                label: "Line chart",
                borderWidth: 3,
                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                hoverBorderColor: "rgba(255,99,132,1)",
                type: "line"
            }
        ];
        $scope.MixedOptions = {
            legend: {
                display: true,
                labels: {
                    fontColor: "rgba(0,0,0,0.5)"
                }
            }
        };

        // NanData
        $scope.NanLabels = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];
        $scope.MixedData = [
            [65, 20, 80, 81, 30, 55, 10],
            [28, 48, 20, 19, 86, 27, 90]
        ];
    });

</script>