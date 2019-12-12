<!-- Team C - Copyright Held by ACME Entertainment Pty Ltd --->

<html lang="en" dir="ltr">
<link rel="stylesheet" type="text/css" href="project.css">
<h1>Removal Requester</h1>
<?php
{
//get all of the form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

// If someone actually input a first name
if (empty($firstname)) {
	echo "<p>Invalid First Name. <p><a href='index.html'>Return to Home Page</a></p></p>";
    return;
} else {
    // If the name follows the regex convention (only letters)
    if (!preg_match("#^[a-zA-Z]*$#", $firstname)) {
        ?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Invalid first name.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
    }
}

// If someone actually input a last name
if (empty($lastname)) {
	echo "<p>Invalid Last Name. <p><a href='index.html'>Return to Home Page</a></p></p>";
    return;
} else {
    // If the name follows the regex convention (only letters)
    if (!preg_match("#^[a-zA-Z]*$#", $lastname)) {
        ?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Invalid last name.
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
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Invalid email.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
}

// Statement to check if the user's email is in the database
$query = 'SELECT * FROM `users` WHERE NOT EXISTS (SELECT null FROM users d WHERE d.Email = "'.$email.'");';
echo $query;

//Get connection script
require"connect.php";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Get the email values to check if account exists
    while ($row = $stmt->fetch()) {
        if (empty($row['Email'])) {

		} else {
			?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Account does not exist.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
		}
    }
} catch (Exception $e) {
    ?>
					<meta name="viewport" content="width=device-width, initial-scale=1">
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						 <strong>Error.</strong> Database error.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
}

// The message that will be sent to the admin with all user info
$msg = "First Name: ".$firstname."\nLast Name: ".$lastname."\nEmail: ".$email;

// Use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg, 70);

// Send the email to the admin team
mail("tafeteamcrad@gmail.com", "Removal Request", $msg);

?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> Request submitted.
	        </div>
	        <br>
	      <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
	      <?php
}
?>
