<?php 
session_start();
require_once('php/db.php');

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if (isset($_POST) and count($_POST)>0){
    $tmp = array('movie'=>$_POST['movie'],'date'=>$_POST['date'],
    'time'=>$_POST['time'],'location'=>$_POST['location'],
    'selected_seats'=>$_POST['selected_seats']);
    array_push($_SESSION['cart'],$tmp);
    header("Location: ".$_SERVER['PHP_SELF']."?id={$_GET['id']}");
    exit;
}


?>

<html>
    <head>
        <title><?php echo $_GET['id']?> </title>
        <link rel="stylesheet" href="css/mainlayout.css" />

        <link rel="stylesheet" href="css/view.css" />
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
        <?php 

            $query = "select * from movies WHERE name='{$_GET['id']}'";
            $result = $db->query($query);
            $num_results = $result->num_rows;
            for ($i=0; $i <$num_results; $i++) {
                $row = $result->fetch_assoc();
                echo "<p> Movie: ";
                echo htmlspecialchars(stripslashes($row['name']))."</p>";
                echo "<p>".$row["details"];
                echo '<br /><img src='.stripslashes($row["pic_url"]).' height=400 width=300>';
                $movie_name=  $row['name'];  
            }
        ?>
            <div class='form'>
                <form action='view.php?id=<?php echo $movie_name;?>' method='post'>
                    <input name='movie' id='movie' value=<?php echo $movie_name;?> style='display:None;'>
                    <input type="date" name="date" required>
                    <select name="time" id="time" required>
                        <option value="1200">12:00pm</option>
                        <option value="1400">2:00pm</option>
                        <option value="1600">4:00pm</option>
                        <option value="1800">6:00pm</option>
                        <option value="2000">8:00pm</option>
                        <option value="2200">10:00pm</option>
                    </select>
                    <?php 
                        $sql = "SELECT location FROM movies WHERE name='".$movie_name."'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $locations =  $row['location'];
                        }}
                        $locations = explode(';',$locations);
                        echo "<select name='location' id='location' required>";
                        foreach($locations as $k=>$v){
                            
                            if ($v!=""){
                                // echo $v;
                                echo "<option value='{$v}'>{$v}</option>";
                            }
                            
                        }
                        echo "</select>";
                    ?>
                
        
            <div class="movie-container">
                <ul class="showcase">
                <li>
                    <div class="seat"></div>
                    <small>N/A</small>
                </li>
                <li>
                    <div class="seat selected"></div>
                    <small>Selected</small>
                </li>
                <li>
                    <div class="seat occupied"></div>
                    <small>Occupied</small>
                </li>
                </ul>

                <div class="seat-container">
                <div class="screen"></div>

                <div class="row">
                    <div class="seat" id='A1'></div>
                    <div class="seat" id='A2'></div>
                    <div class="seat" id='A3'></div>
                    <div class="seat" id='A4'></div>
                    <div class="seat" id='A5'></div>
                    <div class="seat" id='A6'></div>
                    <div class="seat" id='A7'></div>
                    <div class="seat" id='A8'></div>
                </div>

                <div class="row">
                    <div class="seat" id='B1'></div>
                    <div class="seat" id='B2'></div>
                    <div class="seat occupied" id='B3'></div>
                    <div class="seat occupied" id='B4'></div>
                    <div class="seat" id='B5'></div>
                    <div class="seat" id='B6' ></div>
                    <div class="seat" id='B7'></div>
                    <div class="seat" id='B8'></div>
                </div>

                <div class="row">
                    <div class="seat" id='C1'></div>
                    <div class="seat" id='C2'></div>
                    <div class="seat" id='C3'></div>
                    <div class="seat" id='C4'></div>
                    <div class="seat" id='C5'></div>
                    <div class="seat" id='C6'></div>
                    <div class="seat occupied" id='C7'></div>
                    <div class="seat occupied" id='C8'></div>
                </div>

                <div class="row">
                    <div class="seat" id='D1'></div>
                    <div class="seat" id='D2'></div>
                    <div class="seat" id='D3'></div>
                    <div class="seat" id='D4'></div>
                    <div class="seat" id='D5'></div>
                    <div class="seat" id='D6'></div>
                    <div class="seat" id='D7'></div>
                    <div class="seat" id='D8'></div>
                </div>

                <div class="row">
                    <div class="seat" id='E1'></div>
                    <div class="seat" id='E2'></div>
                    <div class="seat" id='E3'></div>
                    <div class="seat" id='E4'></div>
                    <div class="seat" id='E5'></div>
                    <div class="seat" id='E6'></div>
                    <div class="seat" id='E7'></div>
                    <div class="seat" id='E8'></div>
                </div>

                <div class="row">
                    <div class="seat" id='F1'></div>
                    <div class="seat" id='F2'></div>
                    <div class="seat" id='F3'></div>
                    <div class="seat" id='F4'></div>
                    <div class="seat" id='F5'></div>
                    <div class="seat" id='F6'></div>
                    <div class="seat" id='F7'></div>
                    <div class="seat" id='F8'></div>
                </div>
                </div>

                <p class="text">
                You have selected <span id="count">0</span> seats for a price of $<span
                    id="price"
                    >0</span
                ><br>Selected Seats:<input id='selected_seats' name='selected_seats' required>
                
                </p>

                <script src="js/script.js" type="text/javascript"></script>
                <input type='Submit' value="Add To Cart">
            </div>
            </form>
            </div>
        
    </body>
</html>