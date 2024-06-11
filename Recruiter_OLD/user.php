<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <title>User Companies</title>
</head>
<body>
    <h1><center> Login successful </center></h1>

    <?php

        include ('connection.php');

        //getting the username via the session variable username 
        $user = $_SESSION['username'];
    
    ?>

    <h1><center> Welcome <?php echo "$user"; ?> </center></h1>

    <?php

        
        //Checking if the table is already present i.e. if the user is first time or already existing
        $existence_check = "SELECT '$user' FROM information_schema.tables WHERE table_schema = 'user_companies'";

        //running query to store result
        $existence_result = mysqli_query($con, $existence_check);

        //checking the number of rows returned
        $existence_number = mysqli_num_rows($existence_result);

        if($existence_number == 1) {

            echo "Welcome Back.";

            
            

        } else {
            
            echo "Welcome recruiter for the first time.";
            //international phone number support in next update

            mysqli_select_db($con, 'user_companies');

            $user_companies_table_create = "CREATE TABLE $user (
                                    c_id int PRIMARY KEY UNIQUE AUTO_INCREMENT,
                                    c_name varchar(255) NOT NULL,
                                    c_website varchar(255),
                                    c_ph_no varchar(10),
                                    c_address varchar(255),
                                    c_city varchar(255),
                                    c_state varchar(255),
                                    c_country varchar(255),
                                    c_industry varchar(255)
            )";

            //run the user companies table creating query
            mysqli_query($con, $user_companies_table_create);
            echo "Here's your database";

        }

    
    
    ?>


<table id="companyTable">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Website</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Anant Singh</td>
                <td>www.mukullr.com</td>
                <td>8618899847</td>
                <td>Rashtrapati Bhavan</td>
                <td>New Delhi</td>
                <td>Delhi</td>
                <td>India</td>
            </tr>
        </tbody>
    </table>

    <script>
        function dataTable() {

        $(document).ready( function () {
            $('#companyTable').DataTable();
        } );
        }

    </script>

    <form action="addcompany.php" method="POST">
    <input type="submit" value="Add Company" 
         name="addbtn" id="frm1_addbtn" />
</form>

</body>
</html>