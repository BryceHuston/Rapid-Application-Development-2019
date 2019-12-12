<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Admin Page</title>
	</head>
</html>
<link rel="stylesheet" type="text/css" href="project.css">
<link rel="shortcut icon" type="image/png" href="img/admin.png">
<center>
<h1>Admin Page</h1>
</center>
<?php
// Team C - Copyright Held by ACME Entertainment Pty Ltd

// Get login info
$username = $_POST['username'];
$password = $_POST['password'];

// Check can be thrown if you try to access the direct URL
if (empty($username)) {
	echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";
	return;
}

// Check can be thrown if you try to access the direct URL
if (empty($password)) {
	echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";
	return;
}

// If username = "admin"
if ($username != "admin"){
	echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";
	return;
}

// If password = "admin"
if ($password != "admin"){
	echo "<p>Incorrect Username or Password. <p><a href='index.html'>Return to Home Page</a></p></p>";
	return;
}

// If you get this far, nothing failed and you can now do admin stuff!
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<style>
@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width:100%;
  }
}
</style>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="project.css">
</head>
<body>
<!--Remove Account-->
<section class="section ">
	<div class="w3-container">
		<div class="w3-card-4">
			<div class="w3-container w3-red">
				<h2>Remove Account</h2>
			</div>
			<form action="RemoveUser.php" method="post" class="w3-container w3-padding-xlarge" title = "Enter the information to be removed">
				<label>Email</label>
				<input class="w3-input" type="email" name="email" id="email" title = "Enter the email address to be removed">
				<br>
				<center>
				<button type="submit" class="w3-button w3-red w3-large" title = "Remove the account after entering the email address">Remove Account</button>
			</center>
				<br></br>
			</form>
		</div>
	</div>
</section>
	<!--Send message to all users-->
  <section class="section ">
    <div class="w3-container">
      <div class="w3-card-4">
        <div class="w3-container w3-green">
          <h2>Message To Users</h2>
        </div>
        <form action="AdminCommunication.php" method="post" class="w3-container w3-padding-xlarge" title = "controls used to send information to users">
          <label>Message</label>
          <textarea class="w3-input w3-border" name="AdminComm" id="AdminComm" rows="15" cols="80" style="resize:none" title = "This information will be posted as either a notification or newsletter"></textarea>
          <br>
          <center>
            <input type="radio" name="CommType" value="Notification" title = "Click this button to send a notification"> Send A Notification<br>
            <input type="radio" name="CommType" value="Newsletter" title = "Click this button to send a newsletter"> Send A Newsletter<br>
            <br>
            <button type="submit" class="w3-button w3-green w3-large" title = "Clicking this button will send the notification if a message is typed and communication type selected">Send</button>
          </center>
          <br></br>
        </form>
      </div>
    </div>
  </section>
<fieldset>
	<center>
	<button class="btn btn3" onclick="window.location.href = 'index.html';" title = "Return to the home page">Home Page</button>
	<button class="btn btn4" onclick="window.open('http://localhost/phpmyadmin/db_structure.php?server=1&db=movies')" type="button" title="Have Direct Access to the DataBase">Access DBMS</button>
</center>
</fieldset>
</body>
</html>
