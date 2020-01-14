<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highstock Example</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/highstock.js"></script>
    <script src="js/modules/exporting.js"></script>
    <script src="js/themes/dark-orange.js"></script>
    <script type="text/javascript">
        jQuery(function() {

            // Create the chart
            var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
            window.chart = new Highcharts.StockChart({

                chart: {

                    renderTo: 'container'

                },



                rangeSelector: {

                    selected: 1

                },



                title: {

                    text: 'Temperature Levels'

                },



                xAxis: {

                    maxZoom: 14 * 24 * 3600000 // fourteen days

                },

                yAxis: {

                    title: {

                        text: 'Average C'

                    }

                },



                series: [{

                    name: 'C',
                    data: [<?php
                        include 'db_ecoheating.php';
                        $flow_temp = 'temp';
                        $insert_date = 'data';
                        $connection = mysqli_connect($dbhost,$dbuser,$dbpass)
                        or die ("Unable to connect to database");

                        mysqli_select_db($connection, $dbname)
                        or die ("Unable to select database");


                        $query = sprintf("SELECT DATE(data)
DAY , AVG(temp)
FROM temp_hum 
WHERE  `data` 
BETWEEN  '2016-04-1'
AND Now() 
GROUP BY DATE( data)
, DAY( data ) 
ORDER BY data ASC;");
                        $result=mysqli_query($connection, $query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysqli_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }





                        while($row = mysqli_fetch_array($result)){


                            $datatimp = date('o', strtotime($row['DAY']));
                            $datatimp2 = date('n', strtotime($row['DAY']));
                            $datatimp3 = date('j', strtotime($row['DAY']));
                            $datatimp21 = ($datatimp2)-1;

                            $insert_date = ($datatimp);
                            $avg_temp = $row['AVG(temp)'];


                            echo "[Date.UTC($insert_date,$datatimp21,$datatimp3),$avg_temp,30],";
                            echo " \n";
                        }

                        mysqli_close($connection);
                        ?>]


                }]

            });

        });
    </script>
</head>
<body>
<div id="container" style="width: 960px; height: 350px; margin: 0 0"></div>
</body>
</html>
