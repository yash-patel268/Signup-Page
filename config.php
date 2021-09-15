<?php  
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    if(!empty($firstName) || !empty($lastName) || !empty($userName) || !empty($pass) || !empty($email)){
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "accounts";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

        if(mysqli_connect_error()){
            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        } else{
            $SELECT = "SELECT email From register Where email = ? Limit 1";
            $INSERT = "INSERT Into register(firstName, lastName, userName, pass, email) values(?,?,?,?,?)";

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->store_result();
            $rnum = $stmt -> num_rows;

            if($rnum==0){
                $stmt->close();

                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("sssss", $firstName, $lastName, $userName, $pass, $email);
                $stmt->execute();
                echo "New record inserted successfully";
            } else{
                echo "Someone already used that email";
            }
            $stmt->close();
            $conn->close();
        }
    } else{
        echo "All fields are required";
        die();
    }


?>