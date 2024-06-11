

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add/delete table rows, save to db</title>

</head>
<body>
    <?php

        include('connection.php');

        mysqli_select_db($con, 'user_companies');


        //creating the query to fetch data from DB
        $sql = "SELECT c_name, c_website, c_ph_no, c_address, c_city, c_state, c_country FROM $user";
        
        //running the query and storing the result
        $result = mysqli_query($con, $sql);

        //getting the number of rows
        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        //printing the rows
        if ($count > 0) {
            while ($row = $rows) {
                echo "<tr><td>" . $row["c_name"] . "</td><td>" . $row["c_website"] . "</td><td>" . $row["c_ph_no"] . "</td><td>" . $row["c_address"] . "</td><td>" . $row["c_city"] . "</td><td>" . $row["c_state"] . "</td><td>" . $row["c_country"] . "</td></tr>";
            }

            echo "</table>";

        } else {
            echo "0 results.";
        }

        //remove this if the connection closes during testing
        mysqli_close(con);
    ?>

    <form method='post'>
                <input type='button' name='add' value='Add row' />
                <input type='button' name='del' value='Delete row' />
                <input type='button' name='save' value='Save to db' />
            </form>

            <table id='dataTable'>
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Company Name</th>
                        <th>Website</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody><!-- dynamically generated content --></tbody>
            </table>


        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.4/af-2.3.7/cr-1.5.5/r-2.2.9/rr-1.2.8/sc-2.0.5/sp-1.4.0/sl-1.3.4/datatables.min.js"></script>

    </body>
</html>