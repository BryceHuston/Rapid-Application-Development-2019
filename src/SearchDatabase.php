<!-- Team C - Copyright Held by ACME Entertainment Pty Ltd --->

<link rel="stylesheet" type="text/css" href="project.css">
<html lang="en" dir="ltr">
<h1>Database Search Results</h1>
<?php
{
//get all of the form data
$title = $_POST['title'];
$genre = $_POST['genre'];
$rating = $_POST['rating'];
$year = $_POST['year'];

// Setup the string ready for concatenation
$query = "SELECT * FROM `movielist` WHERE";

// If the title exists, add the result to the query
if (empty($title)) {

} else {
    $query .= ' Title LIKE "%' . $title . '%" AND';
}

// If the genre exists
if (empty($genre)) {

} else {
    // If the genre follows the regex convention
    if (!preg_match("#^[a-zA-Z-/]*$#", $genre)) {
      ?>
          <meta name="viewport" content="width=device-width, initial-scale=1">
           <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
             <strong>Error.</strong> Only letters, spaces, dashes and apostrophes can be used for
              genre.
            </div>
            <br>
          <button class="btn btn3" onclick="window.location.href = 'index.html';">Home Page</button>
          <?php
          return;
    }
    $query .= ' Genre LIKE "%' . $genre . '%" AND';
}

// If the rating exists
if (empty($rating)) {

} else {
    // If the rating follows the regex convention
    if (!preg_match("#^[a-zA-Z0-9-]*$#", $rating)) {
      ?>
          <meta name="viewport" content="width=device-width, initial-scale=1">
           <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
             <strong>Error.</strong> Only letters, spaces, dashes and apostrophes can be used for
              rating.
            </div>
            <br>
          <button class="btn btn3" onclick="window.location.href = 'index.html';">Home Page</button>
          <?php
          return;
    }
    $query .= ' Rating ="' . $rating . '" AND';
}

// If the year exists
if (empty($year)) {

} else {
    // If the name follows the regex convention
    if (!preg_match("#^[0-9]*$#", $year)) {
      ?>
          <meta name="viewport" content="width=device-width, initial-scale=1">
           <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
             <strong>Error.</strong> Only numbers can be used for release year.
            </div>
            <br>
          <button class="btn btn3" onclick="window.location.href = 'index.html';">Home Page</button>
          <?php
          return;
    }
    $query .= ' Year ="' . $year . '" AND';
}

// Stops the query having a comma at the end
// If no comma was found that means no data was given
if (substr($query, -1) == "D") {
    $query = substr_replace($query, "", -1);
	$query = substr_replace($query, "", -1);
	$query = substr_replace($query, ";", -1);
} else {
  ?>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <div class="moderate">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
         <strong>Error.</strong> No data was input.
        </div>
        <br>
      <button class="btn btn3" onclick="window.location.href = 'index.html';">Home Page</button>
      <?php
      return;
}

// Debugging the statement
// echo $query."<p><br />\n</p>";

//Get connection script
require"connect.php";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Setup the searches SQL
    $searchquery = 'UPDATE `movielist` SET searches = searches + 1 WHERE ID = :id;';
    $stmtt = $pdo->prepare($searchquery);
    echo "<div id='table-div'>";
    echo "<table>
            <tr>
              <th>Title</th>
              <th>Studio</th>
              <th>Status</th>
              <th>Sound</th>
              <th>Versions</th>
	            <th>Retail Price</th>
              <th>Rating</th>
              <th>Year</th>
              <th>Genre</th>
              <th>Aspect Ratio</th>
              <th>User Rating</th>
            </tr>";
    // Loop all values and display them
    while ($row = $stmt->fetch()) {
        echo '<tr>
                <td>'.$row['Title'].'</td>
                <td>'.$row['Studio'].'</td>
                <td>'.$row['Status'].'</td>
                <td>'.$row['Sound'].'</td>
                <td>'.$row['Versions'].'</td>
                <td>'.$row['RecRetPrice'].'</td>
                <td>'.$row['Rating'].'</td>
                <td>'.$row['Year'].'</td>
                <td>'.$row['Genre'].'</td>
                <td>'.$row['Aspect'].'</td>'
		// Display a like and dislike button
		?>
		<td>
		<form action="MovieRating.php" method="post">
			<select name="likeDislike">
			<?php
			echo '<option value="like,'.$row['ID'].'">Like</option>';
			echo '<option value="dislike,'.$row['ID'].'">Dislike</option>';
			?>
			</select>
      <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <button class="w3-button w3-green w3-tiny" type="submit" title="Submit your rating for the movie selected">Send</button>
		</form>
		</td>
		<?php
        // Add 1 to the search field
        $stmtt->bindValue(':id', $row['ID']);
        $stmtt->execute();
    }
} catch (Exception $e) {
    echo "<p>No results were found.</p>";
}
echo "</table>";
echo "</div>";
?>
    <button class="btn btn3" onclick="window.location.href = 'index.html';" title="Go back to the index (home) page">Home Page</button>
    <?php
}
?>
