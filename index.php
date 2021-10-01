<html>
<head>
  <title>Cinema</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/mainlayout.css" />
  <link rel="stylesheet" href="css/home.css" />
</head>
<body>
    <div class="header">
      <div class="container">
        <img
          class="header-logo"
          src="images/logo.svg"
          alt="logo"
          width="200px"
          height="auto"
        />
        <div class="nav-bar">
          <div class="nav-menu-item" class="active">
            <a href="index.php" class="active">Movies</a>
          </div>
          <div class="nav-menu-item">
            <a href="showtimes.html">Showtimes</a>
          </div>
          <div class="checkout-cart">
            <a href="cart.php">Checkout Cart</a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h1>Movies</h1>
      <?php

        include_once 'php/db.php';

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
            echo '<br />
            <a href="view.php?id='.$row["name"].'"">
            <img src='.stripslashes($row["pic_url"]).' height=400 width=300>
            </a>';
            
            echo "</td>";
            $j = $j +1;
          
        }}
        echo "</table>";
        $result->free();
        $db->close();

      ?>
    </div>
<div class="footer">footer</div>
</body>
</html>
