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

    <div class="Four" id="signup">
    <h1>Login</h2>
        <form action="login.php" method="post">
            <div class="Three" id="Phone" >
                <label>Phone Number</label>
                <input type="text" name="phoneNum" id="PhoneNum" placeholder="Enter phone number">
            </div>
            <br>
            <div class="Three" id="Password">
                <label>Password</label>
                <input type="password" name="password" id="Password" placeholder="Enter password">
            </div>
            <br>

            <input type="submit" name="LogIn" id="LogIn">

        </form>


    
    </div>

    
  

    
</body>
</html>

<?php
    if(isset($_GET['error'])){
        if($_GET['error']=="emptyField"){
            echo "<h4>All fields required.</h4>";
        }
        if($_GET['error']=="invalidPhone"){
            echo "<h4>Phone Number can have only digits.</h4>";
        }
        if($_GET['error']=="invalidNum"){
            echo "<h4>Phone Number not registered. Please sign in.</h4>";
        }
        if($_GET['error']=="wrongPassword"){
            echo "<h4>Wrong Password.</h4>";
        }
        if($_GET['error']=="invalidPhoneLen"){
            echo "<h4>Phone number should have 10 digits. Please do not add +91 at the start.</h4>";
        }
        if($_GET['error']=="stmtInvalid"){
            echo "<h4>Wrong sql query.</h4>";
        }
        if($_GET['error']=="invalidlogin"){
            echo "<h4>To book a table please sign up. Already, have an account? Login. </h4>";
        }
        
    }



    if(isset($_POST['LogIn'])){
        require_once("./dbh_ink.php");

        $phone= mysqli_real_escape_string($conn, $_POST['phoneNum']);
        $password= mysqli_real_escape_string($conn, $_POST['password']);

       
        if(!empty($phone)){

            if(!preg_match("/^[0-9]*$/", $phone)){ 
                header("location:./login.php?error=invalidPhone"); 
                exit();
            }
    
    
            //checking phone number is 10 digits long
            if(strlen($phone)==10){
                
                $sql="select * from customer where phoneNum=?;";

                $stmt= mysqli_stmt_init($conn);//Initialisze a statement suitable for statement preapred by mysqli_stmt_prepare() 
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    //prepare a statement 
                    header("location: ./login.php?error=stmtInvalid");
                    exit();
                }
                

                mysqli_stmt_bind_param($stmt,"s",$phone);//binding the parameters to be sent. Here we want to send parameter phone.

                mysqli_stmt_execute($stmt);//execute stmt prepared statement 

                $result= mysqli_stmt_get_result($stmt);//fetching data from the prepared statement
                $loginres= mysqli_fetch_assoc($result);
               

                if(empty($loginres['phoneNum'])){
                    //user does not exist
                     header("location: ./login.php?error=invalidNum");
                     exit();
                 }
                 else{
                    $pswd= $loginres['cust_password'];
                    //the user is valid and now we are checking for the correct password.
                    if(!empty($password)){
                        
                        if($pswd != $password){
                            header("location: ./login.php?error=wrongPassword");
                            exit();
                        }else{

                            session_start();
                            $_SESSION["phoneNum"]=$loginres["phoneNum"];
                            
                            header("location: ./index.php");
                             exit();
                        }
                        
            
                    }else{
                        header("location: ./login.php?error=emptyField");
                        exit();
                    }
                    
                }
                mysqli_stmt_close($stmt);
            }else{
                    header("location:./login.php?error=invalidPhoneLen");
                    exit();
                }    


        }else{
            header("location: ./login.php?error=emptyField");
            exit();
        }

        
       
       
    }


?>