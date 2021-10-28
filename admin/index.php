<?php
    include_once '../php/db.php';
    function getSeatingDetail($seating_map){
        $booked_counter = 0;
        $seating_array = str_split($seating_map);
        foreach ($seating_array as $char) {
            if ($char==1){
                $booked_counter = $booked_counter +1;
            }
           }
        return $booked_counter;
    }
?>

<html>
    <head>
        <title>Admin Page</title>
    </head>
    <link rel="stylesheet" href="../css/mainlayout.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <script>
        function getMovie(){
            var movieListSelector = document.getElementById('movieList');
            var movie = movieListSelector.options[movieListSelector.selectedIndex].value.trim();
            var date = document.getElementById('date').value;
            const url = 'index.php?id='+movie+'&date='+date;
            // console.log(date);
            window.open(url,"_self");
        }

    </script>
    <body>
        <div class="header">
            <div class="container">

                <div class="nav-bar">
                    <div class="nav-menu-item" class="active">
                        <a href="insert_movie.html" class="active">Insert Movie</a>
                    </div>
                <div class="nav-menu-item">
                    <a href="index.php">Movie Detail</a>
                </div>
            </div>
        </div>
        <div id='querySection'>

            <?php 
                

                $query = "select * from movies";
                $result = $db->query($query);
                $num_results = $result->num_rows;
                echo '<select id="movieList">';
                while($row = $result->fetch_assoc()){
                    if ($row['name']==$_REQUEST['id']){
                        echo '<option value="'.$row['name'].'" selected="selected">'.$row['name'].'</option>';
                    }
                    else{
                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                    
                }
                echo '</select>';

            ?>
            <input  type="date" name="date" id='date' required value=<?php echo (isset($_REQUEST['date'])?$_REQUEST['date']:date('Y-m-d')); ?>>
            <button onclick=getMovie()>Fetch Movie Report</button>
        
        </div>
        <div id='display_query_section'>
            <table id="myTable">
                <tr>
                    <th style="width:15%;">Movie</th>
                    <th style="width:15%;">Location</th>
                    <th style="width:15%;">Time</th>
                    <th style="width:15%;">Date</th>
                    <th style="width:25%;">Seating Details</th>
                    <th style="width:15%;">Total Revenue</th>
                </tr>
            <?php
                if(isset($_REQUEST['id'])){
                    $query = "select * from seatingPlan WHERE movie='{$_REQUEST['id']}' AND date='{$_REQUEST['date']}'";
                    // echo $query;
                    $result = $db->query($query);
                    if($result->num_rows>0){
                        while($row = $result->fetch_assoc()){
                            // var_dump($row);
                            $booked_seats = getSeatingDetail($row['seat_map']);
                            echo '<tr>';
                            echo '<td>'.$row['movie'].'</td>';
                            echo '<td>'.$row['location'].'</td>';
                            echo '<td>'.$row['time'].'</td>';
                            echo '<td>'.$row['date'].'</td>';
                            echo '<td>Booked:  '.$booked_seats.'<br>Available:  '.(48-(int)$booked_seats).'/48</td>';
                            echo '<td>$'.((int)$booked_seats*10).'</td>';
                            echo '</tr>';
                            
                        }
                    }
                    else{
                        echo '<td colspan="6">Please choose the correct date!</td>';
                    }
                }
                
            ?>
            </table>
        </div>
        
    </body>
</html>