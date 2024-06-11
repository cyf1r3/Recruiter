<?php

    session_start();

    //Creating variables
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "user_companies";

    $mysqli = new mysqli($host, $username, $password, $database) or die(mysqli_error($mysqli));

    $cname = '';
    $website ='';
    $ph_no ='';
    $caddress ='';
    $city ='';
    $cstate ='';
    $country ='';
    $industry ='';
    $update = false;
    $id = 0;

    $user = $_SESSION['username'];

    if(isset($_POST['save'])) {
        $cname = $_POST['cname'];
        $website = $_POST['website'];
        $ph_no = $_POST['ph_no'];
        $caddress = $_POST['caddress'];
        $city = $_POST['city'];
        $cstate = $_POST['cstate'];
        $country = $_POST['country'];
        $industry = $_POST['industry'];

        $sql = "INSERT INTO $user (cname, website, ph_no, caddress, city, cstate, country, industry) VALUES('$cname' , '$website' , '$ph_no' , '$caddress' , '$city' , '$cstate' , '$country' , '$industry')";
        $mysqli->query($sql) or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: user.php");


    }

    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM $user WHERE id=$id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: user.php");

    }


    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM $user WHERE id=$id") or die($mysqli->error());

        if ($result->num_rows == 1) {
            $row = $result->fetch_array();
            $cname = $row['cname'];
            $website = $row['website'];
            $ph_no = $row['ph_no'];
            $caddress = $row['caddress'];
            $city = $row['city'];
            $cstate = $row['cstate'];
            $country = $row['country'];
            $industry = $row['industry'];
        }

    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $cname = $_POST['cname'];
        $website = $_POST['website'];
        $ph_no = $_POST['ph_no'];
        $caddress = $_POST['caddress'];
        $city = $_POST['city'];
        $cstate = $_POST['cstate'];
        $country = $_POST['country'];
        $industry = $_POST['industry'];

        $sql = "UPDATE $user SET cname='$cname', website='$website', ph_no='$ph_no', caddress='$caddress', city='$city', cstate='$cstate', country='$country', industry='$industry' WHERE id=$id";

        $mysqli->query($sql) or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg-type'] = "warning";

        header("location: user.php");
    }

?>