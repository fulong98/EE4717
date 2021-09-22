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

  // echo "<p>Number of movies found: ".$num_results."</p>";
  echo "<h1>Available Now</h1><table>";
  $j = 0;
  $current_date = date("Y-m-d");
  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    if ($row['starting_date']<$current_date){
      if ($j%3==0){
          if ($j!=0){
            echo "</tr>";
          }
          echo "<tr>";
      }
      
      $movie_detail_dict = json_decode(stripslashes($row['details']));

      
      echo "<td>";
      
      echo "<p> Movie: ";
      echo htmlspecialchars(stripslashes($row['name']))."</p>";
      echo '<br />
      <a href="view.php?id='.$row["name"].'"">
      <img src='.stripslashes($row["pic_url"]).' height=400 width=300>
      </a>';
      //  echo '<br /><iframe src='.stripslashes($row['trailer_url']).' title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
      echo "</td>";
      $j = $j +1;
     
  }}
  // COming Soon
  $query = "select * from movies";
  $result = $db->query($query);

  $num_results = $result->num_rows;
  echo "</table>";
  echo "<h1>Coming Soon</h1><table>";
  $j = 0;
  $current_date = date("Y-m-d");
  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    if ($row['starting_date']>$current_date){
      if ($j%3==0){
          if ($j!=0){
            echo "</tr>";
          }
          echo "<tr>";
      }
      
      $movie_detail_dict = json_decode(stripslashes($row['details']));

      
      echo "<td>";
      
      echo "<p> Movie: ";
      echo htmlspecialchars(stripslashes($row['name']))."</p>";
      echo '<br /><img src='.stripslashes($row['pic_url']).' height=400 width=300>';
      //  echo '<br /><iframe src='.stripslashes($row['trailer_url']).' title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
      echo "</td>";
      $j = $j +1;
     
  }}
  echo "</table>";
  $result->free();
  $db->close();

?>
</body>
</html>
