<link rel="stylesheet" type="text/css" href="project.css">
<h1>Database Search Results</h1>
<?php {$title=$_POST['title'];$genre=$_POST['genre'];$rating=$_POST['rating'];$year=$_POST['year'];$query="SELECT * FROM `movielist` WHERE";if(empty($title)){}else{$query.=' Title LIKE "%'.$title.'%" AND';}if(empty($genre)){}else{if(!preg_match("#^[a-zA-Z-/]*$#",$genre)){echo "<p>Only letters, slashes and dashes can be used for
        genres. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}$query.=' Genre LIKE "%'.$genre.'%" AND';}if(empty($rating)){}else{if(!preg_match("#^[a-zA-Z0-9-]*$#",$rating)){echo "<p>Only letters, numbers and dashes can be used for
        ratings. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}$query.=' Rating ="'.$rating.'" AND';}if(empty($year)){}else{if(!preg_match("#^[0-9]*$#",$year)){echo "<p>Only numbers can be used for release
        years. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}$query.=' Year ="'.$year.'" AND';}if(substr($query,-1)=="D"){$query=substr_replace($query,"",-1);$query=substr_replace($query,"",-1);$query=substr_replace($query,";",-1);}else{echo "<p>No data was
    input. <p><a href='index.html'>Return to Home Page</a></p></p>";return;}require"connect.php";try{$stmt=$pdo->prepare($query);$stmt->execute();$searchquery='UPDATE `movielist` SET searches = searches + 1 WHERE ID = :id;';$stmtt=$pdo->prepare($searchquery);echo "<div id='table-div'>";echo "<table>
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
            </tr>";while($row=$stmt->fetch()){echo '<tr>
                <td>'.$row['Title'].'</td>
                <td>'.$row['Studio'].'</td>
                <td>'.$row['Status'].'</td>
                <td>'.$row['Sound'].'</td>
                <td>'.$row['Versions'].'</td>
                <td>'.$row['RecRetPrice'].'</td>
                <td>'.$row['Rating'].'</td>
                <td>'.$row['Year'].'</td>
                <td>'.$row['Genre'].'</td>
                <td>'.$row['Aspect'].'</td>'?>
<td>
<form action="MovieRating.php" method="post">
<select name="likeDislike">
<?php echo '<option value="like,'.$row['ID'].'">Like</option>';echo '<option value="dislike,'.$row['ID'].'">Dislike</option>';?>
</select>
<button type="submit">Send</button>
</form>
</td>
<?php $stmtt->bindValue(':id',$row['ID']);$stmtt->execute();}}catch(Exception $e){echo "<p>No results were found.</p>";}echo "</table>";echo "</div>";echo "<p><a href='index.html'>Return to Home Page</a></p>";}?>