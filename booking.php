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
    <div class=navigation>
                    <div class=logo>
                        <h1>WabiSabi</h1>
                    </div>    
                    <nav class=nav>
                        <a href="./index.php">Go to Home Page</a>
                    </nav> 
    </div> 
        
   <div class="One">
    
        <form action="booking.php" method="post">
      
        <div class='Three'>    
            <label>Date</label>
                <select name="date" id="date" placeholder="Select Date">
                            <option value="2021-01-30">30 January 2021</option>
                            <option value="2021-01-31">31 January 2021</option>
                            <option value="2021-02-01">01 February 2021</option>
                            <option value="2021-02-02">02 February 2021</option>
                            <option value="2021-02-03">03 February 2021</option>
                            <option value="2021-02-04">04 February 2021</option>
                            <option value="2021-02-05">05 February2021</option>
                            
                </select>
        </div>

        <br>

        <div class='Three'>   
            <label>Time</label>
                <select name="time" id="time" placeholder="Enter time">
                
                        <option value="17:00:00">5:00pm</option>
                        <option value="18:00:00">6:00pm</option>
                        <option value="19:00:00">7:00pm</option>
                        <option value="20:00:00">8:00pm</option>
                        <option value="21:00:00">9:00pm</option>
                        
                </select>
        </div>

        <br>  

        <div class="Three">
            <label>Enter PartySize:</label>
                <input type="text" name="partySize" id="partySize" placeholder="Enter number of people">  
            
        </div>
        
        <br>   
        
        <input type="submit" name="submit" value="submit">
        </form>

              
    </div>
   <div class='Three'>
        <a style='color:white', href="./index.php">Go to Home Page </a><br><br>
   </div>
   <br><br>
   
        


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
            

            if(empty($_POST['date'])){
              header("location: ./booking.php?error=emptyField"); 
              exit();  
            }

            if(empty($_POST['time'])){
               header("location: ./booking.php?error=emptyField"); 
               exit();  
            }

            if(empty($_POST['partySize'])){
                header("location: ./booking.php?error=emptyField");
                exit();
            }
            
            include('./dbh_ink.php');

            $branch_id=$_SESSION['branch_id'];
            $date=mysqli_real_escape_string($conn, $_POST['date']);
            $time=mysqli_real_escape_string($conn, $_POST['time']);
            $partySize=mysqli_real_escape_string($conn, $_POST['partySize']);
            $customer_id=$_SESSION['phoneNum'];

            $sql3="SELECT counter from date_time where branch_id='$branch_id' and res_date ='$date' and res_time='$time'; ";
            $result3= mysqli_query($conn, $sql3);
            $res3= mysqli_fetch_row($result3);

            if($res3[0] + $partySize <= 20){

                $sql2="UPDATE date_time set counter=counter+$partySize where branch_id='$branch_id' and res_date ='$date' and res_time='$time';";

                $result2= mysqli_query($conn, $sql2);
                
                $sql1= "SELECT date_time_id from date_time where branch_id='$branch_id' and res_date ='$date' and res_time='$time';";

                $result= mysqli_query($conn, $sql1);
                $res= mysqli_fetch_row($result);
     

                $sql="INSERT into booking ( date_time_id, partySize, cust_phone) values ( '$res[0]','$partySize','$customer_id' );";

                if(mysqli_query($conn, $sql)){
                    
                    echo "<div class='Three'>
                    <label style = 'font-size:medium'> Your booking for $date has been confirmed at $time for $partySize people</label>  
                    </div>";
                }else{
                    echo "Query error". mysqli_error($conn);
                }


            }else{
                echo '<script>alert("Sorry! Table not available. Please, Choose for another date or time.");</script>'; 
            }

          
          
           
           
        }else{
            header("location: ./login.php?error=invalidlogin");
            exit();
        }   
        
    }
    
 
?>


