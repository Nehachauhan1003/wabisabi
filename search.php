<?php   session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>


<div class=navigation>
                <div class=logo>
                    <h1>WabiSabi</h1>
                </div>    
                    <nav class=nav>
                        <a href="./index.php">Go to Home Page</a>
                    </nav> 
            </div> 
    <meta charset="UTF-8">
    <title>Wabi Sabi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
   
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h1{
            margin-top: 15px;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();  
        });
    </script>
   
</head>
<body>
    <div class="Four">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-30">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Wabi Sabi Restaurants</h2>
                        
                        
                    </div>
                    <?php
                    // Include config file
                    include('./dbh_ink.php');
                    
                    $city=$_SESSION["address"];
                  
                    // Attempt select query execution
                    $sql = "SELECT * FROM restaurant_branch where city_id = '$city';";
                    
                    if($result = $conn->query($sql)){
                        
                        if($result->num_rows > 0){
                            
                            echo "<table>";
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                        echo "<th>Name</th>";
                                        echo "<th>About</th>";
                                        echo "<th>Phone</th>";
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array() ){
                                    echo "<tr>";
                                        echo "<td>" . $row['branch_name'] . "</td>";
                                        echo "<td>" . $row['branch_description'] . "</td>";
                                        echo "<td>" . $row['phoneNum'] . "</td>";
                                        
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                           
                           
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $conn->error;
                    }
                    $conn->close();
                    ?>
                    <br>
                    <form action="search.php" method="post">
                    <?php include("dbh_ink.php");
                                    $sql = "SELECT * FROM restaurant_branch where city_id = '$city';";
                                    $result1=mysqli_query($conn, $sql);
                                    $res1=mysqli_fetch_all($result1,MYSQLI_ASSOC);
                    ?>
                        <label>Select the </label>
                        <select name="CityBranch" id="CityBranch">
                                    
                                    <?php foreach($res1 as $i) { ?>
                                    <option value=<?php echo $i['branch_id']; ?>>
                                    <?php echo $i['branch_name'];?>
                                    </option>
                                    <?php } ?>    
                        </select>
                        <input type="submit" name="submit" value="Reserve">
                    </form>    
                   
                    <?php 
                        if(isset($_POST['submit'])){
                            $_SESSION['branch_id']= $_POST['CityBranch'];
                            header("location: ./booking.php");
                        }
                    ?>
                   
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


