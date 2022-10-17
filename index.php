<?php
  require_once('php/db.php');
?>
<html>
<head>
  <title>Cinema</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/mainlayout.css" />
  <link rel="stylesheet" href="css/home.css" />
  <script src="js/index.js"></script>
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
            <a href="showtimes.php">Showtimes</a>
          </div>
          <div class="checkout-cart">
            <a href="cart.php">Checkout Cart <?php echo (!empty($_SESSION['cart'])? count($_SESSION['cart']):'');?></a>
          </div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="main">
      <div class="slideshow-container">
        
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <img
            src="images/endofstorm.webp"
            alt="liverpool"
            style="width: 100%"
          />
        </div>
        <div class="mySlides fade">
          <img
            src="images/007-carousel.webp"
            alt="james-bond"
            style="width: 100%"
          />
        </div>
        <div class="mySlides fade">
          <img
            src="images/candyman.webp"
            alt="candyman-movie"
            style="width: 100%"
          />
        </div>
        <div class="mySlides fade">
          <img
            src="images/mylittlepony_new.webp"
            alt="mylittlepony"
            style="width: 100%"
          />
        </div>
        <div class="mySlides fade">
          <img src="images/dune.webp" alt="dune-movie" style="width: 100%" />
        </div>
      </div>
      <div class="divider"></div>
      <div class="movie-container">
        <?php

          include_once 'php/db.php';

          $query = "select * from movies";
          $result = $db->query($query);

          $num_results = $result->num_rows;

          // echo "<p>Number of movies found: ".$num_results."</p>";
          echo "<h1 class='text-header'>Available Now</h1>";
          $j = 0;
          $current_date = date("Y-m-d");
          for ($i=0; $i <$num_results; $i++) {
            $row = $result->fetch_assoc();
            if ($row['starting_date']<=$current_date){
              if ($j%3==0){
                  if ($j!=0){
                    echo "</div>";
                  }
                  echo "<div class='movie-row'>";
              }
              
              $movie_detail_dict = json_decode(stripslashes($row['details']));
              
              echo "<div class='movie'>";
              echo '
              <a href="view.php?id='.$row["name"].'"">
              <img src='.stripslashes($row["pic_url"]).' height=400 width=300>
              </a>';
              echo "<p class='movie-name'>";
              echo htmlspecialchars(stripslashes($row['name']))."</p>";
              echo "</div>";
              $j = $j +1;  
          }}
          echo "</div>";
          // Coming Soon
          $query = "select * from movies";
          $result = $db->query($query);

          $num_results = $result->num_rows;
          echo "<h1 class='text-header'>Coming Soon</h1>";
          $j = 0;
          $current_date = date("Y-m-d");
          for ($i=0; $i <$num_results; $i++) {
            $row = $result->fetch_assoc();
            if ($row['starting_date']>$current_date){
              if ($j%3==0){
                  if ($j!=0){
                    echo "</div>";
                  }
                  echo "<div class='movie-coming-row'>";
              }
              
              echo "<div class='movie'>";
              $movie_detail_dict = json_decode(stripslashes($row['details']));
              echo '
              <img src='.stripslashes($row["pic_url"]).' height=400 width=300>
              </a>';
              echo "<p class='movie-name'>";
              echo htmlspecialchars(stripslashes($row['name']))."</p>";
              echo "</div>";
              
              $j = $j +1;
            
          }}
          echo "</table>";
          $result->free();
          $db->close();

        ?>
        
      </div>
    </div>
    
    <div class="footer">&copy;2021 EECinema Pte Ltd. All rights reserved.</div>
    <script>
      showSlides(slideIndex);
    </script>
  </body>
</html>
