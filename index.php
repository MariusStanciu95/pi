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
        <li class="active"><a href="">Home</a></li>
        <li><a href="coilsactions.php">Coils</a></li>
        <li><a href="charts.php">Charts</a></li>
        <li><a href="tables.php">Tables</a></li>
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
      <h1>Project Description</h1>
      <p>The following project will present a start for a Smart House Application based on a Master-Slave RS-485 connection over modbus consisting of two devices: </p>
      <p><b> -Raspberry Pi (master) </b></p>
      <p><b> -Arduino Mega (slave) </b></p>
      <p> A temperature&humidity DHT11 sensor is placed on the Arduino which receives those 2 values and transmits them to the master (Raspberry Pi). The master 
      registers them (every 20 minutes) into a MySql database table consisting of 4 columns (the unique ID of the registration, 
      the temperature value, humidity value and the timestamp). </p>
      <p>We take the values from the database into a PHP application displaying them into charts, tables and also displaying the current values on all pages.</p>
      <p>Furthermore, we have 5 coils actioned by 5 different on/off switches from the application. Those 5 buttons edit 5 diffent columns into a table from 
      our database (0 and 1 values). The master reads those values and turns on/off 5 different LEDs placed on the arduino, 4 of them being part of 4 Channels
      Relay. </p>

      <p style="text-decoration:underline; font-size: 18px"><b>Modbus Connection</b></p>
      <p>Modbus is a serial communications protocol originally published by Modicon in 1979 for use with its programmable logic controllers (PLCs). 
      It has become standard communication protocol, and it is now a commonly available means of connecting industrial electronic devices. 
      The main reasons for the use of Modbus in the industrial environment are: </p>
	  <p style="text-decoration:underline"> -developed with industrial applications in mind</p>
	  <p style="text-decoration:underline"> -openly published and royalty-free</p>
	  <p style="text-decoration:underline"> -easy to deploy and maintain</p>
	  <p style="text-decoration:underline"> -moves raw bits or words without placing many restrictions on vendors</p>
	  <p>Modbus enables communication among many devices connected to the same network. It is often used to connect a supervisory computer with a 
	  remote terminal unit (RTU) in supervisory control and data acquisition (SCADA) systems. Many of the data types are named from its use in driving relays: 
	  a single-bit physical output is called a coil, and a single-bit physical input is called a discrete input or a contact. </p>

	  <ul>
	  	<p style="font-size: 18px"><b>Software Part</b></p>
	  	<li>Raspberry Pi configuration (Python)</li>
	  	<li>Modbus libraries implementation in Python (MinimalModbus)</li>
	  	<li>Arduino programming (C++)</li>
	  	<li>DHT11 sensor implementation in Arduino</li>
	  	<li>Database design (MySql)</li>
	  	<li>Web interface - PHP-MySql connection, template design (HTML,CSS,Javascript), PHP programming</li>
	  	<li>Modbus communication protocol implementation</li>
	  	<li>Installation and configuration RS-485 communication interfaces</li>
	  	<li>Start-Up script (python script configuration to run as a service for start-up levels (2,3,5) and shut down (1,4,6) )</li>
	  </ul>
      
     
      
      
      

    </div>


    
     <!--  <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div> -->
    

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