<?php
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "accounts";
    $portnumber = "3308";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname, $portnumber);

        if(mysqli_connect_error()){
            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        } else{
            $email=mysqli_real_escape_string($conn,$_POST["email"]);
	        $password=mysqli_real_escape_string($conn,$_POST["pass"]);

            $sql="SELECT Id FROM register WHERE email='$email' AND pass='$password'";

            $result=mysqli_query($conn,$sql);
	        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	                
	        $count=mysqli_num_rows($result);
	        if($count==1){
	            $_SESSION['login_user']=$email;
                echo "valid login";
	                	
			} else {
			    echo "invalid login";
			}
        }


?>