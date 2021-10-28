<html>
    <head><title>Update Seating Plan</title></head>
    <body>
        <?php
            session_start();
            require_once('db.php');
            function convertSeatingSeatintoNumber($row){
                $mySeats= explode(',', $row['selected_seats']);
                $mySeats = array_slice($mySeats, 0, count($mySeat)-1);
                // print_r($mySeats);
                $prefix_dict = array("A"=>0,"B"=>1,"C"=>2,"D"=>3,"E"=>4,"F"=>5);
                @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

                if (mysqli_connect_errno()) {
                echo 'Error: Could not connect to database.  Please try again later.';
                exit;
                }
                $query = "select * from seatingPlan WHERE movie='{$row['movie']}' AND date='{$row['date']}' AND time='{$row['time']}' AND location='{$row['location']}'";
                var_dump($db);
                $result = $db->query($query);
                echo $result->num_rows;
                if ($result->num_rows>0){
                    while($row = $result->fetch_assoc()) {
                        $seatingmap =  $row['seat_map'];

                    }
                }
                $seats_idx_string = $seatingmap;
                global $price;
                $price = 0;
                foreach($mySeats as $idx=>$key){
                    $temp = $prefix_dict[$key[0]]*8+$key[1];
                    $seats_idx_string[$temp-1]='1';
                    $price = $price + 10;

                }

                return $seats_idx_string;

            }

            foreach($_SESSION['cart'] as $idx=>$row){
                var_dump($row);
                // echo $row['selected_seats'];
                $seats_idx_string = convertSeatingSeatintoNumber($row);
                echo $seats_idx_string;
                echo '<br>'.$row['movie'].'<br>';
                // $sql = 'UPDATE seatingPlan SET seat_map='.$seats_idx_string.' WHERE movie='.($row["movie"]).' AND time='.$row['time'].' AND date='.$row['date'].' AND location='.$row['location'];
                $sql = 'UPDATE seatingPlan SET seat_map='."'$seats_idx_string'".' WHERE movie="'.$row['movie'].'"'
                .' AND time="'.$row['time'].'"'.' AND date="'.$row['date'].'"'.' AND location="'.$row['location'].'"';

                echo '<br>'.$sql."<br>";
                @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

                if (mysqli_connect_errno()) {
                echo 'Error: Could not connect to database.  Please try again later.';
                exit;
                }
                if ($db->query($sql) === TRUE) {
                    echo "Record updated successfully";
                    var_dump($_POST);
                    $seating_plan = json_encode($row['selected_seats']);
                    echo $seating_plan;
                    $movie_details = $row['movie'].'_'.$row['date'].'_'.$row['time'].'_'.$row['location'].'_'.$seating_plan;
                    $sql = "INSERT INTO confirmation_details (name, email, phone,address,order_id,price,movie_details)
                    VALUES ('".$row['movie']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['address']."','abc','".$price."','".$movie_details."');";
                    echo $sql;
                    echo $sql;
                    if ($db->query($sql) === TRUE) {
                        echo "Record updated successfully";}
                    else{
                        echo "Error updating record: " . $conn->error;
                    }
                    $to      = 'f32ee@localhost';
                    $subject = 'EEE Cinema Booking Detail';
                    $message = $movie_details;
                    $headers = 'From: f32ee@localhost' . "\r\n" .
                        'Reply-To: f32ee@localhost' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers,'-ff32ee@localhost');
                    echo ("mail sent to : ".$to);
                    echo "<script>alert('Booked successfully! Please check your email!')</script>";
                    unset($_SESSION["cart"]);
                    // header('Location:http://192.168.56.2/f32ee/EE4717/index.php');
                  } else {
                    echo "Error updating record: " . $conn->error;
                  }
            }
            
        ?>
    </body>
</html>