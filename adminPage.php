<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<header>
            <div class=navigation>
                <div class=logo>
                    <h1>WabiSabi</h1>
                </div>    
                    <nav class=nav>
                        
                        <a href="./index.php"><button>Customer</button></a>
                        <a href="./bookingDetails.php">All Booking Details</a>
                        <a href="./customerDetails.php">Customer Details</a>
                    </nav> 
            </div>            
</header>
   

<?php include("./resDetail.php")?>

    
</body>
</html>