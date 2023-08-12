<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    
</head>
<body>



    <div class="One" >
        <h1>Sign Up</h1>

        <form action="signup.php" method="post">

        
            <div class="Three" id="Name">
            <label >Name:</label>
                <input type="text" name="cust_name" id="Cust_name" placeholder="Full Name">

            </div>
            <br>


            <div class="Three" id="Phone Number">
                <label>Phone Number:</label>
                <input type="text" name="cust_phone_num" id="Cust_phone_num" placeholder="Phone Number">

            
            </div>
            <br>


            <div class="Three" id="Password">
                <label>Password:</label>
                <input type="password" name="password" id="Password" placeholder="Password">

            
            </div>
            <br>

            <div class="Three" id="rPassword">
                <label>Confirm Password:</label>
                <input type="password" name="rpassword" id="rPassword" placeholder="Enter Password Again">

            
            </div>
            <br>


            <input type="submit" name="SignUp" id="SignUp">

        </form>
        <br>
    
        

            <h4>Already have an account?</h4>
            <button><a href="./login.php">LogIn?</a></button>

      

    </div>

    <a href="./index.php">Go to home page</a>
    <br>
    <a href="./login.php">Login</a>
    
</body>
</html>

<?php 
    if(isset($_GET['error'])){
        if($_GET['error']=="emptyField"){
            echo '<script> alert("All fields should be filled.");</script>';
        }
        if($_GET['error']=="invalidPhone"){
            echo '<script> alert("Phone number should only have digits");</script>';
           
        }
        if($_GET['error']=="invalidPhoneLen"){
        echo '<script> alert("Phone Number should have exactly 10 digits.");</script>';
           
        }
        if($_GET['error']=="invalidSql"){
            echo '<script> alert("Invalid Sql query.");</script>'; 
          
        }
       
    }
?>

<?php




if(isset($_POST['SignUp'])){
    
    require_once("./dbh_ink.php");
    //validating the login credentials.
    $name= mysqli_real_escape_string($conn, $_POST['cust_name']);
    $phone=mysqli_real_escape_string($conn,$_POST['cust_phone_num']);
    $password=mysqli_real_escape_string ($conn, $_POST['password']);
    $rpassword=mysqli_real_escape_string ($conn, $_POST['rpassword']);

   
    

    if(empty($name)){
        header("location:./signup.php?error=emptyField");
        exit();
        
    }else{

        if(!empty($phone)){//checking if phone number already exist

            //syntax of regex: preg_match("/blablabla/", $variable)

            if(!preg_match("/^[0-9]*$/", $phone)){ 
                header("location:./signup.php?error=invalidPhone"); 
                exit();
            }


            //checking phone number is 10 digits long
            if(strlen($phone)==10){
                
                $sql="Select phoneNum from customer where phoneNum= ?";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("location: ./signup.php?error=invalidSql");
                    exit();
                }
                
                mysqli_stmt_bind_param($stmt, "s",$phone);//bind the parameters to be sent to the sql query. Here we have used condition of phone number so send $phone
                mysqli_stmt_execute($stmt);//execute a prepared query
                
                $reSql= mysqli_stmt_get_result($stmt);
                $result= mysqli_fetch_assoc($reSql);//fetch the data from the resql in form of an  Associative array
                if(!empty($result['phoneNum'])){
                    echo "<h4> Phone Number already exist. Please use another phone number or try to log in</h4>";
                }else{
                    if(empty($password) || empty($rpassword)){
                        echo '<script> alert("Password is required.");</script>';
                    }else if( $password != $rpassword){
                        echo '<script> alert("Passwords do not match.");</script>';
                    }else{
                                        
                        $sql1= "Insert into customer (cust_name, phoneNum, cust_password) values ('$name','$phone','$password')";
                        if(mysqli_query($conn, $sql1)){
                           header("location: ./login.php");
                        }else{
                            echo "Query Error :". mysqli_error($conn);
                        }
                    }
                }

                        

               
                       
            }else{
            
                header("location:./signup.php?error=invalidPhoneLen");
                exit();
            }    
        }else{
                
            header("location:./signup.php?error=emptyField");
            exit();
        }

       

    }    
    




  


   mysqli_close($conn);
   
   
}


?>