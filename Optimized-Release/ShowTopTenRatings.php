<?php $host="localhost";$db="movies";$user="updater";$pass="updater";$array=array();try{$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);$query=$conn->prepare("SELECT movierating.Likes, movielist.Title FROM `movierating` INNER JOIN movielist ON movierating.ID = movielist.ID ORDER BY `movierating`.`Likes` DESC LIMIT 10");$query->execute();$result=$query->fetchAll(PDO::FETCH_OBJ);foreach($result as $row){array_push($array,array("y"=>$row->Likes,"label"=>$row->Title));}$conn=null;}catch(PDOException $e){echo "Error: ".$e->getMessage();}?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="shortcut icon" type=image/png href=img/favicon.png>
<link rel=stylesheet type=text/css href=project.css>
<button class="btn btn3" onclick="window.location.href='index.html'">Home Page</button>
<script>window.onload=function(){var b=new CanvasJS.Chart("chartContainer",{animationEnabled:true,exportEnabled:true,theme:"light1",title:{text:"Top 10 Highest Ratings"},data:[{type:"pie",startAngle:240,yValueFormatString:'(##0"" Likes)',indexLabel:"{label} {y}",dataPoints:<?php echo json_encode($array,JSON_NUMERIC_CHECK);?>}]});b.render()};</script>
</head>
<body>
<div id=chartContainer style=height:370px;width:100%></div>
<script src=https://canvasjs.com/assets/script/canvasjs.min.js></script>
<br>
<br>
<center>
<p>TAP ON SLICES FOR MORE DETAILS</p>
</center>
</body>
</html>