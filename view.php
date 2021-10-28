<?php 
session_start();
require_once('php/db.php');

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    
}
$movie = $_REQUEST['id'];
$time = $_REQUEST['time'];
$date = $_REQUEST['date'];
$location = $_REQUEST['location'];
if (isset($_REQUEST['location'])){
    // fetch seating map from database for seat map showing
    $query = "select * from seatingPlan WHERE movie='{$movie}' AND date='{$date}' AND time='{$time}' AND location='{$location}'";
    $result = $db->query($query);
    if ($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $seatingmap =  $row['seat_map'];

          }
    }
    
}
if (isset($_POST) and count($_POST)>0){
    // add ticket to cart
    $tmp = array('movie'=>$_POST['movie'],'date'=>$_POST['date'],
    'time'=>$_POST['time'],'location'=>$_POST['location'],
    'selected_seats'=>$_POST['selected_seats'],'seating_map'=>$seatingmap);
    // var_dump($_POST);
    if (strlen($_POST['selected_seats'])>3){
    array_push($_SESSION['cart'],$tmp);}
    unset($_POST);
    unset($tmp);
    header('Location:http://192.168.56.2/f32ee/EE4717/cart.php');
    exit;
}



?>

<html>
    <head>
        <title><?php echo $_GET['id']?> </title>
        <link rel="stylesheet" href="css/mainlayout.css" />
        <link rel="stylesheet" href="css/view.css" />
        <script>
        function getSeatingPlan(){
            movie = document.getElementById('movie').value;
            date = document.getElementById('date').value;
            time = document.getElementById('time').value;
            var select = document.getElementById('location');
            var location = select.options[select.selectedIndex].value.trim();
            const url = 'view.php?id='+movie+'&date='+date+'&time='+time+'&location='+location;
            window.open(url,"_blank");
        }
    </script>
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
                <a href="cart.php">Checkout Cart</a>
            </div>
            </div>
        </div>
        </div>
        <div class="divider"></div>
        <div class="page-container">
        <?php 
            $query = "select * from movies WHERE name='{$_GET['id']}'";
            $result = $db->query($query);
            $num_results = $result->num_rows;
            for ($i=0; $i <$num_results; $i++) {
                $row = $result->fetch_assoc();
                $movie_details = json_decode($row["details"]);
                $movie_name=  $row['name'];
            }
        ?>
        
        <div class="movie-details-container">
            <div class="image-container">
                <?php echo '<br /><img src='.stripslashes($row["pic_url"]).' width=100%; height=auto;>';?>
            </div>
            <div class="movie-details">
                <h1 class="movie-title"><?php echo $movie_name?></h1>
                <table>
                    <tr>
                        <th>Genre:</th>
                        <td><?php echo $movie_details->Genre?></td>
                    </tr>
                    <tr>
                        <th>Runtime:</th>
                        <td><?php 
                        
                        echo $movie_details->{'Running Time'}?></td>
                    </tr>
                    <tr>
                        <th>Directed By:</th>
                        <td><?php echo $movie_details->Director?></td>
                    </tr>
                    <tr>
                        <th>Cast:</th>
                        <td><?php echo $movie_details->Cast?></td>
                    </tr>
                </table>
        <!-- Ticket Booking -->
        <h3>Book Movie Tickets</h3>
            <div class='form'>
                <form action='view.php?id=<?php echo $movie_name;?>' method='post'>

                        <input name='movie' id='movie' value=<?php echo $movie_name;?> style='display:None;'>
                        <input  type="date" name="date" id='date' required style="padding: 10px;" value=<?php echo $date; ?>>
                        <select name="time" id="time" required>
                            <option value="1200" <?php echo ($_REQUEST['time']=='1200'?"selected='selected'":"")?>>12:00pm</option>
                            <option value="1400" <?php echo ($_REQUEST['time']=='1400'?"selected='selected'":"")?>>2:00pm</option>
                            <option value="1600" <?php echo ($_REQUEST['time']=='1600'?"selected='selected'":"")?>>4:00pm</option>
                            <option value="1800" <?php echo ($_REQUEST['time']=='1800'?"selected='selected'":"")?>>6:00pm</option>
                            <option value="2000" <?php echo ($_REQUEST['time']=='2000'?"selected='selected'":"")?>>8:00pm</option>
                            <option value="2200" <?php echo ($_REQUEST['time']=='2200'?"selected='selected'":"")?>> 10:00pm</option>
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
                                    $v = trim($v);
                                    if (isset($_REQUEST['location']) and $v==$_REQUEST['location']){
                                        echo "<option value='{$v}' selected='selected'>{$v}</option>";
                                    }
                                    else{
                                        echo "<option value='{$v}'>{$v}</option>";
                                    }
                                    
                                }
                            }
                            echo "</select>";
                        ?>
                        <input type='text' value=<?php echo ($seatingmap[0]=='0' ? '0':'occupied'); ?> >
                        <button onclick='getSeatingPlan()'>Fetch</button>

            <div class="ticket-booking-container">
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
                <div class="screen">Screen</div>
                <div class="row" style="padding-left: 17px;">
                    <div class="seat-alphabet">1</div>
                    <div class="seat-alphabet">2</div>
                    <div class="seat-alphabet">3</div>
                    <div class="seat-alphabet">4</div>
                    <div class="seat-alphabet">5</div>
                    <div class="seat-alphabet">6</div>
                    <div class="seat-alphabet">7</div>
                    <div class="seat-alphabet">8</div>
                </div>
                

                <div class="row">
                    A &nbsp;
                    <div class="seat <?php echo ($seatingmap[0]=='0' ? '0':'occupied'); ?>" id='A1'></div>
                    <div class="seat <?php echo ($seatingmap[1]=='0' ? '0':'occupied'); ?>" id='A2'></div>
                    <div class="seat <?php echo ($seatingmap[2]=='0' ? '0':'occupied'); ?>" id='A3'></div>
                    <div class="seat <?php echo ($seatingmap[3]=='0' ? '0':'occupied'); ?>" id='A4'></div>
                    <div class="seat <?php echo ($seatingmap[4]=='0' ? '0':'occupied'); ?>" id='A5'></div>
                    <div class="seat <?php echo ($seatingmap[5]=='0' ? '0':'occupied'); ?>" id='A6' ></div>
                    <div class="seat <?php echo ($seatingmap[6]=='0' ? '0':'occupied'); ?>" id='A7'></div>
                    <div class="seat <?php echo ($seatingmap[7]=='0' ? '0':'occupied'); ?>" id='A8'></div>
                </div>

                <div class="row">
                    B &nbsp;
                    <div class="seat <?php echo ($seatingmap[8]=='0' ? '0':'occupied'); ?>" id='B1'></div>
                    <div class="seat <?php echo ($seatingmap[9]=='0' ? '0':'occupied'); ?>" id='B2'></div>
                    <div class="seat <?php echo ($seatingmap[10]=='0' ? '0':'occupied'); ?>" id='B3'></div>
                    <div class="seat <?php echo ($seatingmap[11]=='0' ? '0':'occupied'); ?>" id='B4'></div>
                    <div class="seat <?php echo ($seatingmap[12]=='0' ? '0':'occupied'); ?>" id='B5'></div>
                    <div class="seat <?php echo ($seatingmap[13]=='0' ? '0':'occupied'); ?>" id='B6'></div>
                    <div class="seat <?php echo ($seatingmap[14]=='0' ? '0':'occupied'); ?>" id='B7'></div>
                    <div class="seat <?php echo ($seatingmap[15]=='0' ? '0':'occupied'); ?>" id='B8'></div>
                </div>

                <div class="row">
                    C &nbsp;
                    <div class="seat <?php echo ($seatingmap[16]=='0' ? '0':'occupied'); ?>" id='C1'></div>
                    <div class="seat <?php echo ($seatingmap[17]=='0' ? '0':'occupied'); ?>" id='C2'></div>
                    <div class="seat <?php echo ($seatingmap[18]=='0' ? '0':'occupied'); ?>" id='C3'></div>
                    <div class="seat <?php echo ($seatingmap[19]=='0' ? '0':'occupied'); ?>" id='C4'></div>
                    <div class="seat <?php echo ($seatingmap[20]=='0' ? '0':'occupied'); ?>" id='C5'></div>
                    <div class="seat <?php echo ($seatingmap[21]=='0' ? '0':'occupied'); ?>" id='C6'></div>
                    <div class="seat <?php echo ($seatingmap[22]=='0' ? '0':'occupied'); ?>" id='C7'></div>
                    <div class="seat <?php echo ($seatingmap[23]=='0' ? '0':'occupied'); ?>" id='C8'></div>
                </div>

                <div class="row">
                    D &nbsp;
                    <div class="seat <?php echo ($seatingmap[24]=='0' ? '0':'occupied'); ?>" id='D1'></div>
                    <div class="seat <?php echo ($seatingmap[25]=='0' ? '0':'occupied'); ?>" id='D2'></div>
                    <div class="seat <?php echo ($seatingmap[26]=='0' ? '0':'occupied'); ?>" id='D3'></div>
                    <div class="seat <?php echo ($seatingmap[27]=='0' ? '0':'occupied'); ?>" id='D4'></div>
                    <div class="seat <?php echo ($seatingmap[28]=='0' ? '0':'occupied'); ?>" id='D5'></div>
                    <div class="seat <?php echo ($seatingmap[29]=='0' ? '0':'occupied'); ?>" id='D6'></div>
                    <div class="seat <?php echo ($seatingmap[30]=='0' ? '0':'occupied'); ?>" id='D7'></div>
                    <div class="seat <?php echo ($seatingmap[31]=='0' ? '0':'occupied'); ?>" id='D8'></div>
                </div>

                <div class="row">
                    E &nbsp;
                    <div class="seat <?php echo ($seatingmap[32]=='0' ? '0':'occupied'); ?>" id='E1'></div>
                    <div class="seat <?php echo ($seatingmap[33]=='0' ? '0':'occupied'); ?>" id='E2'></div>
                    <div class="seat <?php echo ($seatingmap[34]=='0' ? '0':'occupied'); ?>" id='E3'></div>
                    <div class="seat <?php echo ($seatingmap[35]=='0' ? '0':'occupied'); ?>" id='E4'></div>
                    <div class="seat <?php echo ($seatingmap[36]=='0' ? '0':'occupied'); ?>" id='E5'></div>
                    <div class="seat <?php echo ($seatingmap[37]=='0' ? '0':'occupied'); ?>" id='E6'></div>
                    <div class="seat <?php echo ($seatingmap[38]=='0' ? '0':'occupied'); ?>" id='E7'></div>
                    <div class="seat <?php echo ($seatingmap[39]=='0' ? '0':'occupied'); ?>" id='E8'></div>
                </div>
                <div class="row">
                    F &nbsp;
                    <div class="seat <?php echo ($seatingmap[40]=='0' ? '0':'occupied'); ?>" id='F1'></div>
                    <div class="seat <?php echo ($seatingmap[41]=='0' ? '0':'occupied'); ?>" id='F2'></div>
                    <div class="seat <?php echo ($seatingmap[42]=='0' ? '0':'occupied'); ?>" id='F3'></div>
                    <div class="seat <?php echo ($seatingmap[43]=='0' ? '0':'occupied'); ?>" id='F4'></div>
                    <div class="seat <?php echo ($seatingmap[44]=='0' ? '0':'occupied'); ?>" id='F5'></div>
                    <div class="seat <?php echo ($seatingmap[45]=='0' ? '0':'occupied'); ?>" id='F6'></div>
                    <div class="seat <?php echo ($seatingmap[46]=='0' ? '0':'occupied'); ?>" id='F7'></div>
                    <div class="seat <?php echo ($seatingmap[47]=='0' ? '0':'occupied'); ?>" id='F8'></div>
                </div>
                </div>

                <p class="text">
                You have selected <span id="count">0</span> seats for a price of $<span
                    id="price"
                    >0</span
                ><br><br/>Selected Seats: <input id='selected_seats' name='selected_seats' required readonly >
                <br/>
                <input class="add-cart" type='Submit' value="Add To Cart">
                </p>

                <script src="js/script.js" type="text/javascript"></script>
                
            </div>
            </form>
            </div>
        </div>
          </div>
        </div>
     <div class="footer">&copy;2021 EECinema Pte Ltd. All rights reserved.</div>
     
    </body>
    
</html>