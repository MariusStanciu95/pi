  <?php
 include 'db_ecoheating.php';
 mysql_connect($dbhost,$dbuser,$dbpass)  
or die ("Unable to connect to database");  

mysql_select_db($dbname)  
or die ("Unable to select database");  

$sql2 = "SELECT * FROM coils";

$result=mysql_query($sql2);
if($result)
	while($row = mysql_fetch_array($result)){
		$value = $row['coil5'];
		}
		else {$message  = 'Invalid query: ' . mysql_error() . "\n";
			  return "wrong!!!";}

if($value==0) $sql = "UPDATE coils SET coil5= '1' ";
	else if($value==1) $sql = "UPDATE coils SET coil5= '0' ";

mysql_query($sql);

mysql_close();
  ?>