<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WabiSabi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php if(isset($_SESSION['phoneNum'])){?>
        <header>
            <div class=navigation>
                <div class=logo>
                    <h1>WabiSabi</h1>
                </div>    
                    <nav class=nav>
                        <a href="./adminPage.php"><button>Admin</button></a>
                        <a href="./logout.php">Logout</a>
                    </nav> 
            </div> 
            
            
        </header>

        <?php include("./bookingBranch.php"); ?>

        

    <?php }else{ ?>
        <header>
            <div class=navigation>
                <div class=logo>
                    <h1>WabiSabi</h1>
                </div>    
                    <nav class=nav>
                        <a href="./adminPage.php"><button>Admin</button></a>
                        
                    </nav> 
            </div>            
        </header>
        
       

        <?php include("./signup.php"); ?>

        

       
    <?php } ?>

    
    
   
   
  

   


         