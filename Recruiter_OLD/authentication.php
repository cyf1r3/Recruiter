<?php
    include('connection.php');
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
        //to prevent from mysqli injection  
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);

        //setting the sql query
        $sql = "SELECT * FROM recruiters WHERE username = '$username' AND password = '$password';";

        //store the result of the query
        $result = mysqli_query($con, $sql);

        //to check if 1 row exists with the same data i.e. to check if the user exists in table in database
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
          
        if($count == 1){

            //redirect the user to his page upon successful registration
            $url = "user.php";
            redirect($url);

        }
        else{
            echo "<h1> Login failed. Invalid username or password.</h1>";
        }

        //Function for redirecting
        function redirect($url) {
            ob_start();
            
            //The location to redirect to
            header('Location: ' . $url);

            //Passing the username to the target page by setting the session variable username
            $_SESSION['username'] = $_POST['user'];
            ob_end_flush();
            die();
        }

?>