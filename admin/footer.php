<footer class="main-footer">

    <div class="float-right d-none d-sm-inline">

    </div>

</footer>
</div>


<script src="js/jquery.min.js"></script>


<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/adminlte.min.js?v=3.2.0"></script>
<script src="https://kit.fontawesome.com/315a019457.js" crossorigin="anonymous"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.bootstrap4.js"></script>
<script src="js/Chart.min.js"></script>
 <script src="js/uPlot.iife.min.js"></script>

<!-- AdminLTE App -->


<script>
    $(function () {
        /* uPlot
         * -------
         * Here we will create a few charts using uPlot
         */

        function getSize(elementId) {
            return {
                width: document.getElementById(elementId).offsetWidth,
                height: document.getElementById(elementId).offsetHeight,
            }
        }

        let data = [
            [0, 1, 2, 3, 4, 5, 6],
            [28, 48, 40, 19, 86, 27, 90],
            [65, 59, 80, 81, 56, 55, 40]
        ];

        //--------------
        //- AREA CHART -
        //--------------

        const optsAreaChart = {
            ... getSize('areaChart'),
            scales: {
                x: {
                    time: false,
                },
                y: {
                    range: [0, 100],
                },
            },
            series: [
                {},
                {
                    fill: 'rgba(60,141,188,0.7)',
                    stroke: 'rgba(60,141,188,1)',
                },
                {
                    stroke: '#c1c7d1',
                    fill: 'rgba(210, 214, 222, .7)',
                },
            ],
        };

        let areaChart = new uPlot(optsAreaChart, data, document.getElementById('areaChart'));

        const optsLineChart = {
            ... getSize('lineChart'),
            scales: {
                x: {
                    time: false,
                },
                y: {
                    range: [0, 100],
                },
            },
            series: [
                {},
                {
                    fill: 'transparent',
                    width: 5,
                    stroke: 'rgba(60,141,188,1)',
                },
                {
                    stroke: '#c1c7d1',
                    width: 5,
                    fill: 'transparent',
                },
            ],
        };

        let lineChart = new uPlot(optsLineChart, data, document.getElementById('lineChart'));

        window.addEventListener("resize", e => {
            areaChart.setSize(getSize('areaChart'));
            lineChart.setSize(getSize('lineChart'));
        });
    })
</script>


<script>
    $(document).ready(function() {
        $('#example1').DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        } );
    } );
</script>
</body>
</html>
