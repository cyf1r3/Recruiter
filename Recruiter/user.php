<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My companies</title>

    <!-- fetching jquery from server is preferred for speed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#companyTable').DataTable();
        });

    </script>
    <!-- Datatable plugins end here -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- jquery,bootstrap css, bootstrap script -->
</head>
<body>

    <?php  require_once 'process.php'; ?>

    <?php

        //getting the username via the session variable username 
        $user = $_SESSION['username'];

    ?>

    <h1><center> Welcome <?php echo "$user"; ?> </center></h1>
    <a href="logout.php" style="float:right"><button type="submit" class="btn btn-info" name="logout">Log Out</button></a>

    <?php

        
        $result = $mysqli->query("SELECT '$user' FROM information_schema.tables WHERE table_schema = 'user_companies' AND table_name='$user'") or die($mysqli->error());

        if($result->num_rows == 1) {

        //table is already present in DB


        } else {
            
            echo "Welcome recruiter for the first time.";

            //run the user companies table creating query
            $sql = "CREATE TABLE $user ( id INT AUTO_INCREMENT PRIMARY KEY, cname varchar(50) NOT NULL, website varchar(50), ph_no varchar(10), caddress varchar(50), city varchar(50), cstate varchar(50), country varchar(50), industry varchar(50))";
            $mysqli->query($sql) or die($mysqli->error);

            echo "Your database is ready to be used.";

        }

    ?>

    <?php

        if (isset($_SESSION['message'])):
    
    ?>

    <div class="alert alert-<? $_SESSION['msg_type']?>">

            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
    </div>

    <?php endif ?>

    <div class="container">

    <?php
    
        // $mysqli = new mysqli('localhost', 'root', '', 'user_companies') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM $user") or die(mysqli_error($mysqli));
    
    ?>

    <div class="row justify-content-center">
        <table class="table" id="companyTable">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Website</th>
                    <th>Phone No.</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Industry</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['cname']; ?></td>
                            <td><?php echo $row['website']; ?></td>
                            <td><?php echo $row['ph_no']; ?></td>
                            <td><?php echo $row['caddress']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['cstate']; ?></td>
                            <td><?php echo $row['country']; ?></td>
                            <td><?php echo $row['industry']; ?></td>
                            <td>
                            <a href="user.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- script for data table -->
    <script>
        function dataTable() {

        $(document).ready( function () {
            $('#companyTable').DataTable();
        } );
        }

    </script>

    <?php
    
        function pre_r( $array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="cname" class="form-control" 
                value="<?php echo $cname; ?>" placeholder="Enter company name">
        </div>
        <div class="form-group">
            <label>Company Website</label>
            <input type="text" name="website" class="form-control" 
                value="<?php echo $website; ?>" placeholder="Enter company website">
        </div>
        <div class="form-group">
            <label>Company Phone No.</label>
            <input type="text" name="ph_no" class="form-control" 
                value="<?php echo $ph_no; ?>" placeholder="Enter company phone no.">
        </div>
        <div class="form-group">
            <label>Company Address</label>
            <input type="text" name="caddress" class="form-control" 
                value="<?php echo $caddress; ?>" placeholder="Enter company address">
        </div>
        <div class="form-group">
            <label>Company City</label>
            <input type="text" name="city" class="form-control" 
                value="<?php echo $city; ?>" placeholder="Enter company city">
        </div>
        <div class="form-group">
            <label>Company State</label>
            <input type="text" name="cstate" class="form-control" 
                value="<?php echo $cstate; ?>" placeholder="Enter company state">
        </div>
        <div class="form-group">
            <label>Company Country</label>
            <input type="text" name="country" class="form-control" 
                value="<?php echo $country; ?>" placeholder="Enter company country">
        </div>
        <div class="form-group">
            <label for="industry">Industry:</label>
                <select id="industry" name="industry">
                    <option value="Account">Account</option>
                    <option value="IT">IT</option>
                    <option value="Sales">Sales</option>
                    <option value="Healthcare">Health Care</option>
                </select>   
                <?php echo $industry; ?>
        </div>
        <div class="form-group">
            <?php
                if ($update == true):
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
        </div>
    </form>
    </div>
    </div>

</body>
</html>