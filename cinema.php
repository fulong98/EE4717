<html>
<head>
  <title>Cinema</title>
</head>
<body>
<h1>Movies</h1>
<?php
  @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  $query = "select * from movies";
  $result = $db->query($query);

  $num_results = $result->num_rows;

  echo "<p>Number of movies found: ".$num_results."</p>";
  echo "<table>";
  for ($i=0; $i <$num_results; $i++) {
    if ($i%3==0){
        if ($i!=0){
          echo "</tr>";
        }
        echo "<tr>";
    }
    
    echo "<td>";
     $row = $result->fetch_assoc();
     echo "<p>".($i+1).". Movie: ";
     echo htmlspecialchars(stripslashes($row['name']))."</p>";
    //  echo "</strong><br />Starting date: ";
    //  echo stripslashes($row['starting_date']);
    //  echo "</strong><br />Ending date: ";
    //  echo stripslashes($row['ending_date']);
    //  echo "</strong><br />Location: ";
    //  echo stripslashes($row['Location']);
     echo "<br />Details: ";
     echo "<p>".stripslashes($row['details'])."</p>";
     echo '<br /><img src='.stripslashes($row['pic_url']).' height=100 width=100>';
    //  echo '<br /><iframe src='.stripslashes($row['trailer_url']).' title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
     echo "</td>";
     
  }
  echo "</table>";
  $result->free();
  $db->close();

?>
</body>
</html>
