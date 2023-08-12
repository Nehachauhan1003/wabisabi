<?php 
        require_once("./dbh_ink.php");

        $sql= "select customer.cust_name, customer.phoneNum from customer;";
        $result= mysqli_query($conn, $sql);
    // fetch the resulting row as an array
        $res= mysqli_fetch_all($result, MYSQLI_ASSOC);

            //free memory
        mysqli_free_result($result);

            //close connection
        mysqli_close($conn);
      
       



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
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
   

        <div class="Table" >
            <h4>Customer Details are:</h4>
            <table>
                        <tr><th>Name</th><th>Phone Number</th></tr>

                            <?php foreach($res as $i) {?>
                                <tr>
                                    <td><?php echo $i['cust_name'];?></td>
                                    <td><?php echo $i['phoneNum'];?></td>
                                </tr>
                            <?php } ?>    


            </table>


        </div>

    
</body>
</html>

