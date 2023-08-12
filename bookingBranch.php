<?php   session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>
<body>

    
   

   
    <div class="One">
        <h2>Book Your Table:</h2>
        <br>
        <form action="bookingBranch.php" method="post">

            <div class='Three'>
                <label> Select City:</label>

                <?php 
                    require_once("./dbh_ink.php");
                    $sql="Select * from restaurant_city ;";
                    $result=mysqli_query($conn, $sql);
                    $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
                ?> 
                <select name="Name" id="Name">

                    <?php foreach($res as $i) { ?>
                        <option value=<?php echo $i['city_id']; ?>><?php echo $i['city_name'];?>
                        </option>
                        
                    <?php } ?>    
                </select>
            </div>
           
            <br>

            <input type="submit" name="submit" value="submit">
        
        
        
        </form>

              
    </div>
   
        


 </body> 

<?php 
 
            if(isset($_GET['error'])){
                if($_GET['error']="emptyField"){
                    echo '<script>alert("All fields required.");</script>'; 
                }        
            }
?> 

<?php


 if(isset($_POST['submit'])){

        if(isset($_SESSION['phoneNum'])){
            if(empty($_POST['Name'])){
              header("location: ./bookingBranch.php?error=emptyField");
              exit();  
            }else{
                session_start();
                $_SESSION["address"]= $_POST['Name'];
                header("location: ./search.php");
            }
        }else{
            header("location: ./login.php?error=invalidlogin");
            exit();
        }   
        
    }
    
 
?>