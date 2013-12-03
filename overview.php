<html>
<head>
	<title>Who Got Me Sick</title>&nbsp;
	<link rel="stylesheet" type="text/css" href="global.css">
	<link rel="stylesheet" type="text/css" href="useraccountsettings.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="handlebuttonpressed.js"></script>
</head>
<body id="body">

<?php

include('dbcontrol.php');

function totalSymptoms($string) {
	$len = strlen($string);
	$list = [];
	for($i=0; $i < $len; $i++){
		$key = substr($string, $i, 1);
		$list[$i] = $key;
	}
	return $list;
}

$set_query = "select zip_code, count(zip_code) from reports group by zip_code;";
$result = $db->query($set_query);

//$array = mysqli_fetch_array($result);

echo "<div>";
echo "<table  class='overview'>      ";
echo "<tr>                    ";
echo "<th>Zip Code</th>       ";
echo "<th>Total Reports</th>  ";
echo "<th>Fever</th>          ";
echo "<th>Cough</th>          ";
echo "<th>Stuffiness</th>     ";
echo "<th>Aches</th>          ";
echo "<th>Chills</th>         ";
echo "<th>Fatigue</th>        ";
echo "<th>Nausea/Vomiting</th>";
echo "<th>Diarrhea</th>       ";
echo "<th>Other</th>          ";
echo "</tr>                   ";

while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
	echo "<tr>";
	echo "<td>".$row[0]."</td>";
	echo "<td>".$row[1]."</td>";
	
	$sym_query = "select symptoms from reports where zip_code=".$row[0].";";
	$symresult = $db->query($sym_query);
	$total = array_fill(0, 9, 0);
	
	while ($row = mysqli_fetch_array($symresult, MYSQL_NUM)) {
		$len = strlen($row[0]);
		for($i=0; $i < $len; $i++){
			$key = substr($row[0], $i, 1);
			$total[$i] += intval($key);
		}
	}
	
	for($i=0; $i < 9; $i++){
	echo "<td>".$total[$i]."</td>";
	}
	
	echo "</tr>";
}
echo "</table>";
echo "</div>";

?>

</body>
</html>	