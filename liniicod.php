<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="onoffswitches.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="tabs.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="updatecoils.js"></script>
  <script type="text/javascript">
    function tab(tab) {
        document.getElementById('tab1').style.display = 'none';
        document.getElementById('tab2').style.display = 'none';
        document.getElementById('tab3').style.display = 'none';
        document.getElementById('li_tab1').setAttribute("class", "");
        document.getElementById('li_tab2').setAttribute("class", "");
        document.getElementById('li_tab3').setAttribute("class", "");
        document.getElementById(tab).style.display = 'block';
        document.getElementById('li_'+tab).setAttribute("class", "active");
    }
</script>

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
        <li><a href="tables.php">Tables</a></li>
        <li class="active"><a href="liniicod.php">Code</a></li>
      
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
    <h1>Programming code</h1>
    <div id="Tabs">
    <ul>
        <li id="li_tab1" onclick="tab('tab1')" ><a>Arduino (C++)</a></li>
        <li id="li_tab2" onclick="tab('tab2')"><a>Raspberry Pi (Python)</a></li>
        <li id="li_tab3" onclick="tab('tab3')"><a>MySql Database</a></li>
    </ul>
    
    <div id="Content_Area">
    
    <div id="tab1">
     <h1>Arduino (C++)</h1>
      
      <div>  <img src="images/arduinocode1.png"/>  </div>
      <div>  <img src="images/arduinocode2.png"/>  </div>
      <div>  <img src="images/arduinocode3.png"/>  </div>
      <div>  <img src="images/arduinocode4.png"/>  </div>
      <div>  <img src="images/arduinocode5.png"/>  </div>

    </div>

    <div id="tab2" style="display: none;"> 

    <h1>Raspberry Pi (Python)</h1>
         <div>  <img src="images/pythoncode1.png"/>  </div>
         <div>  <img src="images/pythoncode2.png"/>  </div>
         <div>  <img src="images/pythoncode3.png"/>  </div>
         <div>  <img src="images/pythoncode4.png"/>  </div>
         <div>  <img src="images/pythoncode5.png"/>  </div>
    </div>

    <div id="tab3" style="display: none;">
     <h1>MySql Database</h1>
      
      <br><br>
      <div>  
          <img src="images/database1.png"/>  
      </div>
      <br><br>
      <p><b>Coils table</b></p>
      <div>
          <img src="images/database2.png"/>
      </div>
      
      <br><br>
      <p><b>Temperature&Humidity table</b></p>
      <div> 
          <img src="images/database3.png"/>
      </div>
      <br><br>
      <p><b>Errors table</b></p>
      <div>
          <img src="images/database4.png"/>
      </div>

    </div>
   
    </div> 
    
    </div>
    


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