<?php
// $movie = ;
// $starting_date=;
include_once 'db.php';
echo $_GET['movie']."<br>";
echo $_GET['starting_date']."<br>";
echo $_GET['ending_date']."<br>";
// echo $_GET['locations']."<br>";
$loc_str = '';
foreach ($_GET['locations'] as $selectedOption)
    $loc_str= $loc_str ." $selectedOption".';';
echo $loc_str."<br>";
echo $_GET['cast']."<br>";
echo $_GET['director']."<br>";
echo $_GET['genre']."<br>";
echo $_GET['running_time']."<br>";
echo $_GET['pic_url']."<br>";
echo $_GET['trailer_url']."<br>";
$detail = '{"Cast":"'.$_GET['cast'].'","Director":"'.$_GET['director'].'","Genre":"'.$_GET['genre'].'","Running Time":"'.$_GET['running_time'].'"}';
$query = "INSERT INTO movies (name,starting_date,ending_date,location,details,pic_url,trailer_url)
VALUES ('".$_GET['movie']."','".$_GET['starting_date']."','".$_GET['ending_date']."','".$loc_str."','".$detail."','".$_GET['pic_url']."','".$_GET['trailer_url']."')";

$period = new DatePeriod(
    new DateTime($_GET['starting_date']),
    new DateInterval('P1D'),
    new DateTime($_GET['ending_date'])
);
// var_dump($period);
// foreach ($period as $key => $value) {
//     echo $value->format('Y-m-d').'<br>';
// }

        
$res = mysqli_query($db, $query);
if($res) {
    echo json_encode($res);
    $times = array("1200","1400","1600","1800","2000","2200");
    foreach ($period as $key => $value){
        foreach ($times as $time){
            foreach ($_GET['locations'] as $location){
                echo $value->format('Y-m-d').' '.$time.' '.$location.'<br>';
                $query_new = "INSERT INTO seatingPlan (movie,time,seat_map,date,location)
                VALUES ('".$_GET['movie']."','".$time."','000000000000000000000000000000000000000000000000','".$value->format('Y-m-d')."','".$location."')";
                // echo $query_new;
                $res1 = mysqli_query($db, $query_new);
            }
        }
    }
    
    // echo json_encode($res1);
    


    //MUST CHANGE THIS TO OWN LOCATION!!
    // header("Location: http://192.168.56.2/f32ee/EE4717/insert_movie.html");
    exit();
    } else {
    echo "Error: " . $sql . "" . mysqli_error($dbCon);
    }
    
?>