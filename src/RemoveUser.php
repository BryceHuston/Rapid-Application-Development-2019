<!-- Team C - Copyright Held by ACME Entertainment Pty Ltd --->

<html lang="en" dir="ltr">
<link rel="stylesheet" type="text/css" href="project.css">
<h1>Account Remover</h1>
<?php
{
//get all of the form data
$email = $_POST['email'];

if (empty($email)) {
	echo "<p>Invalid Email (somehow). <p><a href='index.html'>Return to Home Page</a></p></p>";
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

// Statement to remove the user from the database
$query = 'DELETE FROM `users` WHERE `email` = "'.$email.'";';
echo $query;

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    ?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> User was removed.
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
						 <strong>Error.</strong> Database error.
						</div>
						<br>
					<button class="btn btn3" onclick="window.location.href = 'members.html';" title="Go Back To Members Page">Members Page</button>
					<?php
					return;
}

echo "<p><a href='index.html'>Return to Home Page</a></p>";
}
?>
