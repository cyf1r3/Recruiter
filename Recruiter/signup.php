<?php      
    
    include ('connection.php');

    //getting the username and password from signup page using post method
    $username = $_POST['user'];  
    $password = $_POST['pass'];   

    //checking if even 1 row with same username exists
    $existence_check = "SELECT * FROM recruiters WHERE USERNAME = '$username'";
    //running query to store result
    $existence_result = mysqli_query($con, $existence_check);
    //checking the number of rows returned
    $existence_number = mysqli_num_rows($existence_result);

    if($existence_number == 1) {
        echo "Username already exists";
        header('location:index.html');
    } else {

        //Inserting the username and  password values in the table
        $insert_data = "INSERT INTO recruiters (username, password)
                        VALUES ('$username', '$password')";

        //Executing MYSQL Query for entering user data into table
        mysqli_query($con, $insert_data);
        header('location:index.html');
    }
?>