<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
</head>
<body>

    <div id = "frm">  
        <h1>Add company to your database</h1>  
        <form name="f1" action = "addcompany.php" onsubmit = "return validation()" method = "POST">  
        <p>  
            <label> Company Name: </label>  
            <input type = "text" id ="cname" name  = "cname" />  
        </p>  
        <p>  
            <label> Company Website: </label>  
            <input type = "text" id ="cwebsite" name  = "cwebsite" />  
        </p>
        <p>  
            <label> Company Phone Number: </label>  
            <input type = "text" id ="cphno" name  = "cphno" />  
        </p>
        <p>  
            <label> Company Address: </label>  
            <input type = "text" id ="caddress" name  = "caddress" />  
        </p>
        <p>  
            <label> Company City: </label>  
            <input type = "text" id ="ccity" name  = "ccity" />  
        </p>
        <p>  
            <label> Company State: </label>  
            <input type = "text" id ="cstate" name  = "cstate" />  
        </p>
        <p>  
            <label> Company Country: </label>  
            <input type = "text" id ="ccountry" name  = "ccountry" />  
        </p>
        <label for="cars">Industry:</label>
            <select id="cindustry" name="cindustry">
                <option value="account">Account</option>
                <option value="it">IT</option>
                <option value="sales">Sales</option>
                <option value="healthcare">Health Care</option>
            </select>   
        <p>     
            <input type =  "submit" id = "btn" value = "Add This Company" />  
        </p>  
        </form>  
    </div>

    <?php
    
        include ('connection.php');

        $cname = $_POST['cname'];
        $cwebsite = $_POST['cwebsite'];
        $cphno = $_POST['cphno'];
        $caddress = $_POST['caddress'];
        $ccity = $_POST['ccity'];
        $cstate = $_POST['cstate'];
        $ccountry = $_POST['ccountry'];
        $cindustry = $_POST['cindustry'];


        mysqli_select_db ($con, $user);

        //checking if even 1 row with same username exists
        $existence_check = "SELECT * FROM $user WHERE c_name = 'cname'";
        //running query to store result
        $existence_result = mysqli_query($con, $existence_check);
        //checking the number of rows returned
        $existence_number = mysqli_num_rows($existence_result);
        
        if($existence_number == 1) {
            echo "Company record already exists";
        } else {
            
            //Inserting the username and  password values in the table
            $insert_data = "INSERT INTO $user (c_name, c_website, c_ph_no, c_address, c_city, c_state, c_country, c_industry)
                        VALUES ('$cname','$cwebsite','$cphno','$caddress','$ccity','$cstate','$ccountry','$cindustry',)";

            //Executing MYSQL Query for entering user data into table
            mysqli_query($con, $insert_data);
            echo "Company added Successfully.";
        }
    
    
    ?>

    <script>  
        function validation()  
        {  
            var name=document.f1.cname.value;  
              
            if(cname.length=="") {  
                alert("Company name field are empty");  
                return false;  
            }                            
        }  
    </script>

</body>
</html>