<?php
    include("dbh_ink.php");
    // creating a sql query
    $sql = 'select * from restaurant_branch';
    // make query & get results
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
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h4>Restaurant Details are</h4>
        <br>
        <br>
        <div class="Table">     
            <table>
                    <tr><th>Branch Name</th><th>Description</th><th>Phone Number</th></tr>
                    <?php foreach($res as $i) {?>
                        <tr>
                                <td><?php echo $i['branch_name']; ?></td>
                                <td><?php echo $i['branch_description'];?></td>
                                <td><?php echo $i['phoneNum'];?></td>
                        </tr> 
                    <?php } ?> 
            </table>
            <a href="./resBranch.php"><button>ADD New Restaurant Branch</button></a>
        </div>
        <br> 
    </body>
</html>