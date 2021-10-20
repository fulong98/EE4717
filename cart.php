<?php 
session_start();
if(!empty($_GET["action"])){
    switch($_GET["action"]){
        case "remove":
            if(!empty($_SESSION["cart"])) {
                foreach($_SESSION["cart"] as $k => $v) {
                        if($_GET["idx"] == $k)
                            unset($_SESSION["cart"][$k]);				
                        if(empty($_SESSION["cart"]))
                            unset($_SESSION["cart"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cart"]);
        break;
    }
    
}
?>
<html>
    <head>
        <title>Shopping Cart</title>
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
                <a href="showtimes.php">Showtimes</a>
            </div>
            <div class="checkout-cart">
                <a href="cart.php">Checkout Cart</a>
            </div>
            </div>
        </div>
        </div>
        <div style='height:800px;margin-top:100px;'>
            <?php session_start();
                if (!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array();
                }
                if (count($_POST)!=0){
                    if (!in_array($_POST,$_SESSION['cart'],false)){
                        array_push($_SESSION['cart'], $_POST);
                    }
                    
                }
                
                
             ?>
             <div id='cart-container'>
                <h1>Shopping Cart</h1>
                <?php 
                if (isset($_SESSION['cart']) and count($_SESSION['cart'])>0){
                    echo "<table border='1' cellpadding='10' cellspacing='2'>";
                    echo "<tr><td></td><td>Movie</td><td>Booking Details</td></tr>";
                    $ticket_num = 0;
                    foreach($_SESSION['cart'] as $i=>$row){
                        echo "<br>";
                        echo "<tr>";
                        echo "<td><a href='cart.php?action=remove&idx=$i'><img src='images/icon-delete.png' alt='Remove Item' /></a></td>";
                        echo "<td>".$row["movie"]."</td>";
                        echo "<td>".'<span>Date: '.$row["date"].'</span><br>'.
                        '<span>Time: '.$row['time'].'</span><br> '.
                        '<span>Location: '.$row['location'].'</span><br> '.
                        '<span>Selected Seat: '.$row['selected_seats']."</span></td>";
                        $ticket_num +=count(explode(",",$row['selected_seats']))-1;
                    }
                    echo "<tr><td></td><td>Total Price:</td><td>".($ticket_num*10)."</td></tr>";
                    echo "</table>";
                ?>
                <input type="button" onClick="parent.location='checkout.php'" value="Checkout"><br>
                <button><a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a></button>
                <?php } 
                else{
                    echo "<div>Your Cart is Empty</div>";
                }
                ?>
             </div>
        </div>
        <div class="footer">&copy;2021 EECinema Pte Ltd. All rights reserved.</div>
        
    </body>

</html>

