<!-- Team C - Copyright Held by ACME Entertainment Pty Ltd --->

<link rel="stylesheet" type="text/css" href="project.css">
<html lang="en" dir="ltr">
<h1>Movie Rating</h1>
<?php
{
// If the if liked is empty (bad input), update dislikes
if (empty($_POST['likeDislike'])) {
	?>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <div class="moderate">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         <strong>Error.</strong> Reading Data.
        </div>
        <br>
      <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
      <?php
      return;
}

// Create an array for use
$array = array();

// Split the string into 2 different parts for easy reading / usability
$array = explode(",", $_POST['likeDislike'], 2);

// Check the first part of the response, whether it was liked or disliked
switch ($array[0]) {
	// IF liked, increase the given ID by 1 in the likes
	case 'like':
		$query = "UPDATE `movierating` SET Likes = Likes + 1 WHERE ID = ".$array[1].";";
		break;
	// IF liked, increase the given ID by 1 in the likes
	case 'dislike':
		$query = "UPDATE `movierating` SET Dislikes = Dislikes + 1 WHERE ID = ".$array[1].";";
		break;
	// IF it code reaches here someone made a big mistake
	default:
	?>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <div class="moderate">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         <strong>Error.</strong> Bad input given.
        </div>
        <br>
      <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
      <?php
      return;
		break;
}

//Get connection script
require"connect.php";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
		?>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	       <div class="success">
	        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	         <strong>Success.</strong> Rating submitted.
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
				 <strong>Error.</strong> Cannot execute rating.
			<?php
}
?>
		<button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
		<?php
}
?>
