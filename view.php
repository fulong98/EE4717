<html>
    <head>
        <title><?php echo $_GET['id']?> </title>
    </head>
    <body>
        <div>
        <?php 
            @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

            if (mysqli_connect_errno()) {
               echo 'Error: Could not connect to database.  Please try again later.';
               exit;
            }
          
            $query = "select * from movies";
            
            $result = $db->query($query);
          
            $num_results = $result->num_rows;
            for ($i=0; $i <$num_results; $i++) {
                $row = $result->fetch_assoc();
                if ($row["name"]==$_GET['id'])
                {
                    echo "<p> Movie: ";
                    echo htmlspecialchars(stripslashes($row['name']))."</p>";
                    echo "<p>".$row["details"];
                    echo '<br /><img src='.stripslashes($row["pic_url"]).' height=400 width=300>';
                }
            }
        ?>
        <div>
            <form>
                <input type="date" name="date" required>
                <select name="time" id="time">
                    <option value="1200">12:00pm</option>
                    <option value="1400">2:00pm</option>
                    <option value="1600">4:00pm</option>
                    <option value="1800">6:00pm</option>
                    <option value="2000">8:00pm</option>
                    <option value="2200">10:00pm</option>
                </select>
            </form>
        </div>
        <button>Add to cart</button>
        </div>
        
    </body>
</html>