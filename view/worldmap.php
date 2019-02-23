<?php

	define('WORLDMAP_WIDTH', 1600);
	define('WORLDMAP_HEIGHT', 800);
	
	require_once('map/map.php');


	function GetX($longitude)
	{
		//Return X based on 180 deegres
		return round(($longitude + 180.0) * (WORLDMAP_WIDTH / 360.0));
	}
	
	function GetY($latitude)
	{
		//Get Latitude Radian
		$rad = ($latitude * M_PI) / 180.0;
		
		//Return Y using Mercator Projection based on Radian
		$m = log(tan((M_PI / 4) + ($rad / 2)));
		return round((WORLDMAP_HEIGHT / 2) - ((WORLDMAP_WIDTH * $m) / (M_PI * 2)));
	}
	
	function GetCSSPointPosition($latitude, $longitude)
	{
		return 'left: '.GetX($longitude).'.'.rand(0,95).'px; top: '.GetY($latitude).'.'.rand(0,95).'px;';
	}
	
	
	function GetGeoIP($ip)
	{
		return json_decode(file_get_contents('http://freegeoip.net/json/'.$ip));
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>GM Panel - RegnumPT</title>
<link rel="stylesheet" href="view/worldmap.css">
</head>
<body>
	<div class="worldmapimg" style="background-image: url('view/map/render.png');">
<?php
	foreach($listuseron as $user):
	$obj = GetGeoIP($user[2]);
?>
		<div id="circleYellow" class="circlemap" style="<?= GetCSSPointPosition($obj->latitude,$obj->longitude) ?>"></div>
	<?php endforeach; ?>
	</div>
</body>
</html>


