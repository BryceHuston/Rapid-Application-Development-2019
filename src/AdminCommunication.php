<html lang="en" dir="ltr">
<link rel="stylesheet" type="text/css" href="project.css">
<?php
//Get POST information
    $msg = $_POST['AdminComm'];
    $commtype = $_POST['CommType'];
//If commtype is notification, send notification to all users who have true
//WantsNotification
if($commtype === "Notification") {
  $query = 'SELECT Email FROM `users` WHERE WantsEmail = 1';
  require"connect.php";
  try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $msg = wordwrap($msg, 80);
    while($row = $stmt->fetch()) {
      foreach($row as $email) {
      mail($email, "Notification From WMDB!!!", $msg);
      }
    }
    ?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> Notification was sent.
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
				 <strong>Error.</strong> Cannot send notification.
			<button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
			<?php
  	return;
  }
}
//if commtype is newsletter send newsletter to all users who have true
//WantsEmail
elseif($commtype === "Newsletter") {
  $query = 'SELECT Email FROM `users` WHERE WantsNotification = 1';
  require"connect.php";
  try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $msg = wordwrap($msg, 80);
    while($row = $stmt->fetch()) {
      foreach($row as $email) {
      mail($email, "WMDB Monthly Newsletter", $msg);
      }
    }
    ?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> Newsletter was sent.
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
				 <strong>Error.</strong> Cannot send newsletter.
			<button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
			<?php
  	return;
  }
}
else {
  ?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				 <strong>Error.</strong> No communication type selected.
			<button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
			<?php
}
?>
