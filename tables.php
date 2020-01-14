<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="onoffswitches.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="updatecoils.js"></script>




</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="index.php"><img src="images/fils.png" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="coilsactions.php">Coils</a></li>
        <li><a href="charts.php">Charts</a></li>
        <li class="active"><a href="">Tables</a></li>
        <li><a href="liniicod.php">Code</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="coilsactions.php">Coils</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Tables</h1>
      
      
      <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nr. Crt</th>
        <th>Humidity</th>
        <th>Temperature</th>
        <th>Date</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>


       <!-- {
      //   //     $temp = $row['temp'];
      //   //     $hum = $row['hum'];
      //   //     $data = $row['data'];
      //   //     $date = $data;
      //   //     $date->format('Y-m-d'); 
      //   //     $time = $date;
      //   //     $time->format('H:i:s');

      //   //     echo "<tr>";
      //   //       echo "<td>";echo "1"; echo "</td>";
      //   //       echo "<td>";echo $hum; echo "</td>";
      //   //       echo "<td>";echo $temp; echo "</td>";
      //   //       echo "<td>";echo $date; echo "</td>";
      //   //       echo "<td>";echo $time; echo "</td>";
      //   //     echo "</tr>";
      //   //     //$i++;

      //   //     }
        
       
          
      //   // mysql_close(); -->
      




      <?php
include 'db_ecoheating.php';

$connection = mysqli_connect($dbhost,$dbuser,$dbpass)
or die ("Unable to connect to database");  

mysqli_select_db($connection, $dbname)
or die ("Unable to select database");  


$query = sprintf("SELECT * FROM temp_hum ORDER BY data DESC LIMIT 9");
$result=mysqli_query($connection, $query);
if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}


$i=1;

    
while($row = mysqli_fetch_array($result)){
  
  
  $data = date('j/n/o', strtotime($row['data']));
  $time = date('H:i', strtotime($row['data']));

  
  $temp = $row['temp'];
  $hum = $row['hum'];
  echo "<tr>";
            echo "<td>";echo $i; echo "</td>";
            echo "<td>";echo $hum; echo "</td>";
             echo "<td>";echo $temp; echo "</td>";
             echo "<td>";echo $data; echo "</td>";
             echo "<td>";echo $time; echo "</td>";
       echo "</tr>";

       $i++;
}

mysqli_close($connection);
?>

    </tbody>
  </table>


      

    </div>
    <div class="col-sm-2 sidenav">
            <?php
          include 'db_ecoheating.php';

         $connection = mysqli_connect($dbhost,$dbuser,$dbpass)
          or die ("Unable to connect to database");  

mysqli_select_db($connection, $dbname)
or die ("Unable to select database");  


$query = sprintf("SELECT * FROM temp_hum ORDER BY data DESC LIMIT 1");
$result=mysqli_query($connection, $query);
if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}




    
while($row = mysqli_fetch_array($result)){
  
  
  $data = date('j/n/o', strtotime($row['data']));
  $time = date('H:i', strtotime($row['data']));

  
  $temp = $row['temp'];
  $hum = $row['hum'];
  
  echo '<div class="well">';
       echo '<p style="font-size:20px">'; echo "Current Temperature"; echo "<br>"; echo $temp; echo "°C"; echo '</p>';
       echo '</div>';
    echo '<div class="well">';
      echo '<p style="font-size:20px">'; echo "Current Humidity"; echo "<br>";echo $hum; echo "%";echo '</p>';
    echo '</div>';


}

mysqli_close($connection);
?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>FILS</p>
</footer>

</body>
</html>