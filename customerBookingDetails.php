
<?php
     session_start();
    require_once("./dbh_ink.php");

    if(isset($_SESSION['phoneNum'])){
        
    $customer_id= $_SESSION["phoneNum"];
   
    $sql="Select restaurant_branch.branch_name,  bookings.res_date, bookings.res_time, bookings.partySize from bookings JOIN restaurant_branch ON bookings.branch_id=restaurant_branch.branch_id and bookings.cust_phone=?;";

    

    $stmt=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$customer_id);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $res=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        header("location: ./newPage.php?error=notLoggedIn");
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bookings Details </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="Table">
        <table>
                <tr>
                <th>Restaurant Name</th><th> Date</th> <th>Time</th>  <th>Party Size</th></tr>
                <?php foreach($res as $i) { ?>
                <tr> 
                    <td>
                    <?php echo $i['branch_name'] ?>
                    </td>
                    
                    <td>
                            <?php echo $i['res_date'] ?>
                    </td>
                        
                    <td>
                    <?php echo $i['res_time'] ?>
                    </td>
                
                    <td>
                    <?php echo $i['partySize'] ?>
                    </td>
            

                </tr>
    
    
    

                

                <?php } ?>
        </table>        
    </div>        
    
    

    
</body>
</html>