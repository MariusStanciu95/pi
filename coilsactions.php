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
        <li class="active"><a href="">Coils</a></li>
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
      <!-- <p><a href="#">Coils</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>COILS</h1>
     



<table class="table table-condensed">

        <th> Coils (choose which coil to be actioned)</th>
        <th> Action ( ON / OFF)</th>
      <tr>
      <td>Coil 1</td>
      <td>
      <div class="onoffswitch4">
      <input type='checkbox' onclick='saveData4()' name='onoffswitch4' class='onoffswitch4-checkbox' id='myonoffswitch4' 
      
      
      <?php
       include 'db_ecoheating.php';
      $connection =  mysqli_connect($dbhost,$dbuser,$dbpass)
       or die ("Unable to connect to database");  

       mysqli_select_db($connection, $dbname)
       or die ("Unable to select database");  

       $sql = "SELECT * from coils ";

       $result = mysqli_query($connection, $sql);
      

       while($row = mysqli_fetch_array($result)){
       $coil4 = $row['coil4'];
        }
       if($coil4==1) echo "checked />";
          else echo "/>";
          
        
      ?>

      <label class="onoffswitch4-label" for="myonoffswitch4"></label></div>
      
      </td>
      </tr>

      <tr class="success">
      <td>Coil 2</td>
      <td>
      <div class="onoffswitch3">
      <input type='checkbox' onclick='saveData3()' name='onoffswitch3' class='onoffswitch3-checkbox' id='myonoffswitch3' 
      
      
      <?php
       include 'db_ecoheating.php';
      $connection = mysqli_connect($dbhost,$dbuser,$dbpass)
       or die ("Unable to connect to database");  

       mysqli_select_db($connection, $dbname)
       or die ("Unable to select database");  

       $sql = "SELECT * from coils ";
       $result = mysqli_query($connection, $sql);
      

       while($row = mysqli_fetch_array($result)){
       $coil3 = $row['coil3'];
        }
       if($coil3==1) echo "checked />";
          else echo "/>";
          
        
      ?>

      <label class="onoffswitch3-label" for="myonoffswitch3"></label></div>
      
      </td>
      </tr>

      <tr class="danger">
       <td>Coil 3</td>
       <td>
      <div class="onoffswitch2">
      <input type='checkbox' onclick='saveData2()' name='onoffswitch2' class='onoffswitch2-checkbox' id='myonoffswitch2' 
      
      
      <?php
       include 'db_ecoheating.php';
      $connection = mysqli_connect($dbhost,$dbuser,$dbpass)
       or die ("Unable to connect to database");  

       mysqli_select_db($connection, $dbname)
       or die ("Unable to select database");  

       $sql = "SELECT * from coils ";
       $result = mysqli_query($connection, $sql);
      

       while($row = mysqli_fetch_array($result)){
       $coil2 = $row['coil2'];
        }
       if($coil2==1) echo "checked />";
          else echo "/>";
          
        
      ?>

      <label class="onoffswitch2-label" for="myonoffswitch2"></label></div>
      </td>
      
      
      </tr>

      <tr class="warning">
      <td>Coil 4</td>
      <td>
      <div class="onoffswitch1">
      <input type='checkbox' onclick='saveData1()' name='onoffswitch1' class='onoffswitch1-checkbox' id='myonoffswitch1' 
      
      
      <?php
       include 'db_ecoheating.php';
      $connection =  mysqli_connect($dbhost,$dbuser,$dbpass)
       or die ("Unable to connect to database");  

       mysqli_select_db($connection, $dbname)
       or die ("Unable to select database");  

       $sql = "SELECT * from coils ";
       $result = mysqli_query($connection, $sql);
      

       while($row = mysqli_fetch_array($result)){
       $coil1 = $row['coil1'];
        }
       if($coil1==1) echo "checked />";
          else echo "/>";
          
        
      ?>

      <label class="onoffswitch1-label" for="myonoffswitch1"></label></div>
      
      
      
       </td>
       </tr>
       
      

      


      <tr class="info">
      <td>Coil 5</td>
      <td>
      <div class="onoffswitch5">
      <input type='checkbox' onclick='saveData5()' name='onoffswitch5' class='onoffswitch5-checkbox' id='myonoffswitch5' 
      
      
      <?php
       include 'db_ecoheating.php';
      $connection = mysqli_connect($dbhost,$dbuser,$dbpass)
       or die ("Unable to connect to database");  

       mysqli_select_db($connection, $dbname)
       or die ("Unable to select database");  

       $sql = "SELECT * from coils ";
       $result = mysqli_query($connection, $sql);
      

       while($row = mysqli_fetch_array($result)){
            $coil5 = $row['coil5'];
        }

       if($coil5==1) echo "checked />";
          else echo "/>";
          
        
      ?>

      <label class="onoffswitch5-label" for="myonoffswitch5"></label></div>
      
      </td>
      </tr>
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