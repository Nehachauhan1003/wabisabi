<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once("./header.php");?>

<?php
        if(isset($_GET['error'])){
            echo "<h4> Please Login to view details.</h4>";
        }
?>


<a href="./login.php">LogIn</a>
    
</body>
</html>

