<html lang="en">
  <head>
    <title>EEE Cinema</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/mainlayout.css" />
    <link rel="stylesheet" href="css/showtimes.css" />
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
            <a href="index.php">Movies</a>
          </div>
          <div class="nav-menu-item">
            <a href="showtimes.php" class="active">Showtimes</a>
          </div>
          <div class="checkout-cart">
            <a href="cart.php">Checkout Cart</a>
          </div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <!-- main container -->
    <div class="page-container">
      <div class="showtimes-container">
        <h1>Movies Showtimes</h1>
        <p>Check out the different movie showtimes today!</p>
        <select id="mylist" onchange="myFunction()" class='form-control' style="padding: 10px; width: 40%; margin-bottom: 40px;">
        <option value="" selected disabled hidden>Filter By Movie Names</option>
        <?php
          
          @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

          if (mysqli_connect_errno()) {
              echo 'Error: Could not connect to database.  Please try again later.';
              exit;
          }
          $query = "SELECT * from movies";
          $result = $db->query($query);
          $num_results = $result->num_rows;
          $current_date = date("Y-m-d");          
          for ($i=0; $i <$num_results; $i++) {
            $row = $result->fetch_assoc();
            if ($row['starting_date']<$current_date){
              echo "<option>".$row['name']."</option>";
            }
          }
        ?>
        </select>
        <table id='myTable'>
          <tr class="header">
            <th style="width:40%;">Movie Name</th>
            <th style="width:30%;">Locations</th>
            <th style="width:30%;">Showtimes</th>
          </tr>
        <?php
        $query = "SELECT * from movies";
        $movieResult = $db->query($query);
        $num_results = $movieResult->num_rows; 
          $j = 0;
          $current_date = date("Y-m-d");          
          for ($i=0; $i <$num_results; $i++) {
            $row = $movieResult->fetch_assoc();
            if ($row['starting_date']<$current_date){
              
              echo "<tr><td>";
              echo '<a href="view.php?id='.$row["name"].'"" style="color:#fff;">';
              echo "<p>";
              echo $row['name']."</p></a>";
              echo "<td>";
              $location = explode(';',$row['location']);
              for ($k=0; $k <= count($location); $k++) {
                echo $location[$k];
              }
              echo "</td><td><p>12:00pm, 2:00pm, 4:00pm, 6:00pm, 8:00pm, 10:00pm,</p></td></tr>";
              $j = $j +1;
            }
          }
          
          $result->free();
          $db->close();
        ?>
        </table>
      </div>
    </div>
    <div class="footer">&copy;2021 EECinema Pte Ltd. All rights reserved.</div>
  </body>
  <script src="js/filterShowtimes.js"></script>
</html>
