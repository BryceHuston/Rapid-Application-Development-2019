<!-- Team C - Copyright Held by ACME Entertainment Pty Ltd --->

<html lang="en" dir="ltr">
<link rel="stylesheet" type="text/css" href="project.css">
<h1>User Adder</h1>
<?php
{
//get all of the form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
if (empty($_POST['emails'])) {
	$emails = "FALSE";
} else {
	$emails = "TRUE";
}
if (empty($_POST['notifications'])) {
	$notifications = "FALSE";
} else {
	$notifications = "TRUE";
}

// If someone actually input a first name
if (empty($firstname)) {
	?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				 <strong>Error.</strong> Please enter a name.
				</div>
				<br>
			<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
			<?php
			return;
} else {
    // If the name follows the regex convention (only letters)
    if (!preg_match("#^[a-zA-Z]*$#", $firstname)) {
			?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Invalid name.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
    }
}

// If someone actually input a last name
if (empty($lastname)) {
	?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				 <strong>Error.</strong> Please enter a last name.
				</div>
				<br>
			<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
			<?php
			return;
} else {
    // If the name follows the regex convention (only letters)
    if (!preg_match("#^[a-zA-Z]*$#", $lastname)) {
			?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Invalid name.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
    }
}

if (empty($email)) {
	?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <div class="alert">
				<span class="closebtn" title="Error reading email. Please try again" onclick="this.parentElement.style.display='none';">&times;</span>
				 <strong>Error.</strong> Your almost there. Please enter a email.
				</div>
				<br>
			<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
			<?php
			return;
}

if (empty($emails) && empty($notifications)) {
	echo "<p>Invalid Notifications. Please select at least 1 type. <p><a href='index.html'>Return to Home Page</a></p></p>";
    return;
}

// Statement to check if the user's email is in the database (Names can be duped, emails cannot)
$query = 'SELECT * FROM `users` WHERE `email` = "'.$email.'";';
echo $query;

//Get connection script
require"connect.php";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Get the email values to check if account is already signed up
    while ($row = $stmt->fetch()) {
        if (empty($row['Email'])) {

		} else {
			echo "<p>Account already exists. <p><a href='index.html'>Return to Home Page</a></p></p>";
			return;
		}
    }
} catch (Exception $e) {
    echo "<p>Unhandled error occured while checking database.</p>";
	echo "<p><a href='index.html'>Return to Home Page</a></p>";
	return;
}

// Create a new user
$query = 'INSERT INTO `users` (`FirstName`, `LastName`, `Email`, `WantsEmail`, `WantsNotification`) VALUES ("'.$firstname.'", "'.$lastname.'", "'.$email.'", '.$emails.', '.$notifications.');';
echo $query;
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
	?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> User was created.
	        </div>
	        <br>
	      <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
	      <?php
	      return;
} catch (Exception $e) {
	?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				 <strong>Error.</strong> Cannot register account.
			<?php
}
echo "</table>";
echo "</div>";
?>
    <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
    <?php
}
?>
