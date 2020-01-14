 <?php
 error_reporting(E_ALL ^ E_DEPRECATED);
 include 'db_ecoheating.php';
 mysql_connect($dbhost,$dbuser,$dbpass)  
or die ("Unable to connect to database");  

mysql_select_db($dbname)  
or die ("Unable to select database");  

$sql = "SELECT * from coils ";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	$coil1 = $row['coil1'];
	}
echo $coil1;
mysql_close();
  ?>


