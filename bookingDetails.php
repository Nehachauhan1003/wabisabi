<?php

session_start();

include('./dbh_ink.php');

 $sql="SELECT RS.branch_name from restaurant_branch RS, date_time DT, customer C, booking B  where C.phoneNum=B.cust_phone and B.date_time_id=DT.date_time_id and RS.branch_id=DT.branch_id;";
// // this gives restaurant name corresponding to the branch_id. 
// //here we cannot use "select restaurant_branch.branch_name from restaurant_branch where branch_id in (select branch_id from bookings)"
 $result= mysqli_query($conn, $sql);// Fetch query from database
 $res= mysqli_fetch_all($result, MYSQLI_ASSOC);//  fetch the resulting row as an array Like: Array ( [0] => Array ( [branch_name] => WabiSabi1 [res_date] => 2020-12-01 [res_time] => 18:00:00 [partySize] => 20 ) [1] => Array ( [branch_name] => WabiSabi1 [res_date] => 2020-12-17 [res_time] => 21:00:00 [partySize] => 12 ) )

$sql1="select customer.cust_name, booking.partySize from booking JOIN customer ON booking.cust_phone= customer.phoneNum";
$result1= mysqli_query($conn, $sql1);
$res1= mysqli_fetch_all($result1, MYSQLI_ASSOC);

$sql3="select date_time.res_date, date_time.res_time from date_time JOIN booking ON booking.date_time_id= date_time.date_time_id;";
$result3= mysqli_query($conn, $sql3);// Fetch query from database
$res3= mysqli_fetch_all($result3, MYSQLI_ASSOC);




$n=count($res1);

//free memory
//mysqli_free_result($result);
mysqli_free_result($result1);

//close connection
mysqli_close($conn);





?>

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
                        <a href="./adminPage.php">Go to Home Page</a>
                    </nav> 
            </div> 

<div class="TableOne" >
    <table>
            <tr><th>Customer Name</th><th>Restaurant Name</th><th>Date</th><th>Time</th><th>Party Size</th><th></th></tr>
                     <?php for($i=0;$i<$n;$i++){?>
                            <tr>
                                    <?php $arr1=$res1[$i];$arr3=$res3[$i];$arr=$res[$i]; ?>
                                    <td><?php echo $arr1['cust_name'];?></td> 
                                    <td><?php echo $arr['branch_name'];?></td>
                                    <td><?php echo $arr3['res_date'];?></td> 
                                    <td><?php echo $arr3['res_time'];?></td>  
                                    <td><?php echo $arr1['partySize'];?></td> 
                                    
                                    
                                </tr>


                            
                    <?php } ?>   
                    
    </table> 

</div>


    
</body>
</html>