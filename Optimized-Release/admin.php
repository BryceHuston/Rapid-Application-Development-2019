<link rel="stylesheet" type="text/css" href="project.css">
<link rel="shortcut icon" type="image/png" href="img/admin.png">
<center>
<h1>Admin Page</h1>
</center>
<?php $username=$_POST['username'];$password=$_POST['password'];if(empty($username)){echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}if(empty($password)){echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}if($username!="admin"){echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}if($password!="admin"){echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<style>@media only screen and (max-width:620px){.menu,.main,.right{width:100%}}</style>
<head>
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="project.css">
</head>
<body>
<section class="section">
<div class="w3-container">
<div class="w3-card-4">
<div class="w3-container w3-red">
<h2>Remove Account</h2>
</div>
<form action="RemoveUser.php" method="post" class="w3-container w3-padding-xlarge">
<label>Email</label>
<input class="w3-input" type="email" name="email" id="email">
<br>
<center>
<button type="submit" class="w3-button w3-red w3-large">Remove Account</button>
</center>
<br></br>
</form>
</div>
</div>
</section>
<section class="section">
<div class="w3-container">
<div class="w3-card-4">
<div class="w3-container w3-green">
<h2>Message To Users</h2>
</div>
<form action="AdminCommunication.php" method="post" class="w3-container w3-padding-xlarge">
<label>Message</label>
<textarea class="w3-input w3-border" name="AdminComm" id="AdminComm" rows="15" cols="80" style="resize:none"></textarea>
<br>
<center>
<input type="radio" name="CommType" value="Notification"> Send A Notification<br>
<input type="radio" name="CommType" value="Newsletter"> Send A Newsletter<br>
<br>
<button type="submit" class="w3-button w3-green w3-large">Send</button>
</center>
<br></br>
</form>
</div>
</div>
</section>
<fieldset>
<center>
<button class="btn btn3" onclick="window.location.href='index.html'">Home Page</button>
<button class="btn btn4" onclick="window.open('http://localhost/phpmyadmin/db_structure.php?server=1&db=movies')" type="button">Access DBMS</button>
</center>
</fieldset>
</body>
</html>