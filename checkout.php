<html>
    <head>
        <title>Shopping Cart</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/mainlayout.css" />
        <link rel="stylesheet" href="css/checkout.css" />
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
        <div class="cart-container">
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
             <div class="confirm-container">
                <h1>Confirm Your Purchase</h1>
                <?php 
                session_start();
                echo "<table border='1'>";
                echo "<tr><th>Movie</th><th>Booking Details</th></tr>";
                $ticket_num = 0;
                foreach($_SESSION['cart'] as $i=>$row){
                    echo "<br>";
                    echo "<tr>";
                    echo "<td>".$row["movie"]."</td>";
                    echo "<td>".'<span>Date: '.$row["date"].'</span><br>'.
                    '<span>Time: '.$row['time'].'</span><br> '.
                    '<span>Location: '.$row['location'].'</span><br> '.
                    '<span>Selected Seat: '.$row['selected_seats']."</span></td>";
                    $ticket_num +=count(explode(",",$row['selected_seats']))-1;
                }
                echo "<tr><td>Total Price:</td><td>$ ".($ticket_num*10).".00</td></tr>";
                echo "</table>";
                ?>
                <form action="php/update_seating_plan.php" method="post">
                <h2>Your Billing Details</h2>
                    <table class="form-table">
                        <tr><th>Name:</th><td><input type='text' name='name' required></td></tr>
                        <tr><th>Email:</th><td><input type='email' name='email' required></td></tr>
                        <tr><th>Phone:</th><td><input type='text' name='phone' required></td></tr>
                        <tr><th>Billing Address:</th><td><input type='text'  name='address' required></td></tr>
                    </table>
                    <input class="confirm-purchase" type="submit" value='Confirm'>
                </form>
             </div>
        </div>
        <div class="footer">&copy;2021 EECinema Pte Ltd. All rights reserved.</div>
        
    </body>

</html>

