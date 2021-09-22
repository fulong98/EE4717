<?php 
function get_movie_details(){
    @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }

    $query = "select * from movies";
    $result = $db->query($query);
    $movie = [];
    $num_results = $result->num_rows;
    for ($i=0; $i <$num_results; $i++) {
        $row = $result->fetch_assoc();
        $movie_detail_dict = json_decode(stripslashes($row['details']));
        // var_dump($movie_detail_dict);
        $movie[$row['name']] = $row['starting_date'];
         
      }
    $result->free();
    $db->close();
    return $movie;
}
function filter_movie_date($movie_array){
    $current_date = date("Y-m-d");
    $movie_available_now = [];
    $movie_coming_soon = [];
    foreach($movie_array as $movie_name => $movie_starting_date) {
        // echo "$movie_name = $movie_starting_date<br>";
        if ($current_date>$movie_starting_date){
            array_push($movie_available_now,$movie_name);
        }
        else{
            array_push($movie_coming_soon,$movie_name);
        }
      }
    $res = array("movie_available_now"=>$movie_available_now,"movie_coming_soon"=>$movie_coming_soon);
    // print_r($res) ;
    return $res;
}
$movie_list=get_movie_details();
$movie_filtered_time= filter_movie_date($movie_list);
print_r($movie_filtered_time) ;
?>