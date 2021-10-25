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
$query = "INSERT INTO movies (name,starting_date,ending_date,location,details,pic_url,trailer_url)
VALUES ('".$_GET['movie']."','".$_GET['starting_date']."','".$_GET['ending_date']."','".$loc_str."','','".$_GET['pic_url']."','".$_GET['trailer_url']."')";

$res = mysqli_query($db, $query);
if($res) {
    echo json_encode($res);
    //MUST CHANGE THIS TO OWN LOCATION!!
    header("Location: http://192.168.56.2/f32ee/Exercises/EE4717/insert_movie.html");
    exit();
    } else {
    echo "Error: " . $sql . "" . mysqli_error($dbCon);
    }
    
?>