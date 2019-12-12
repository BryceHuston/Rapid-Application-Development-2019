<link rel="shortcut icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="project.css">
<h1>Top Ten Search Results</h1>
<?php require"connect.php";$query="SELECT * FROM `movielist` ORDER BY `movielist`.`searches` DESC LIMIT 10";try{$stmt=$pdo->prepare($query);$stmt->execute();echo "<table>";echo "<tr>
            <th>Times Searched</th>
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
          </tr>";for($i=0;$i<10;$i++){$row=$stmt->fetch();echo '<tr>
                <td>'.$row['searches'].'</td>
                <td>'.$row['Title'].'</td>
                <td>'.$row['Studio'].'</td>
                <td>'.$row['Status'].'</td>
                <td>'.$row['Sound'].'</td>
                <td>'.$row['Versions'].'</td>
                <td>'.$row['RecRetPrice'].'</td>
                <td>'.$row['Rating'].'</td>
                <td>'.$row['Year'].'</td>
                <td>'.$row['Genre'].'</td>
                <td>'.$row['Aspect'].'</td>
              </tr>';}}catch(Exception $e){echo "<p>No results were found.</p>";}echo '</table>'?>
<button class="btn btn3" onclick="window.location.href='index.html'">Home Page</button>