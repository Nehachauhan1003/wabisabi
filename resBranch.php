<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Branch Data</title>
    <link rel="stylesheet" href="./style.css">
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
                        <a href="./adminPage.php">Go to Home Page</a>
                    </nav> 
            </div>          
</header>

   
    <br>
    <br>
    <div class="One">
        
    <label class='Three'>Add Restaurant Branches:</label>
    <br>
    <br>
    <form action="resBranch.php" method="post">
        <div class="Three" >
            <label>Branch Name</label>
            <input type="text" name="Name" id="Branch_Name" placeholder="Enter branch name">
        </div>    
            <br>
        <div class="Three" >
            <label>Address</label>
            <input type="text" name="Address" id="Branch_address" placeholder="Enter address">
            <br>
        </div> 
        <br>   
        <div class="Three" >
            <label>Phone Number</label>
            <input type="text" name="PhoneNum" id="Branch_phone" placeholder="Enter phone number">
           
        </div>    
        <br>
            <input type="submit" name="submit" value="submit" class="btn">

    </form>

    </div>  

   

    
    
</body>
</html>

<?php 

   

   if(isset($_POST['submit'])){
       if(empty($_POST['Name'])){
           echo '<script>alert("All fields should be filled.")</script>';
       }
       
       if(empty( $_POST['Address']))
       {
            echo '<script>alert("All fields should be filled.")</script>';
       }
       if(empty( $_POST['PhoneNum'])){
            echo '<script>alert("All fields should be filled.")</script>';
       }


       $conn = mysqli_connect('localhost','root','','book');

       if(!($conn)){
           echo "Connection unsuccessful". mysqli_connect_error();
       }else{
           
       }

       $name= mysqli_real_escape_string($conn, $_POST['Name']);
       $address=mysqli_real_escape_string($conn, $_POST['Address']);
       $phoneNum=mysqli_real_escape_string($conn, $_POST['PhoneNum']); 

       $sql= "Insert into restaurant_branch (branch_name, address, phoneNum) values ('$name','$address','$phoneNum')";
       
       
       if(mysqli_query($conn, $sql)){

       }else{
           echo "Query error". mysqli_error($conn);
       }
   }

  
   


   


?>