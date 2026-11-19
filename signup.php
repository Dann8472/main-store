<?php
    //Get database conecttion
    include('settings/database.php');

/*
    Use this URL to in browser to register a new user:
    http://localhost/main-store/signup.php
*/

    //Get payload from frontend
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $ident_number = $_POST['idnumber'];
    $mobile_phone = $_POST['mphone'];
    $email = $_POST['email'];
    $passwd = MD5($_POST['pswd']); 
    $PHOTO_URL = 'photos/avatar_default.png';

    $sql_check_email = "SELECT * FROM users WHERE email = '$email' ";
    $res = pg_query($supa_conn, $sql_check_email);
    $total = pg_num_rows($res);
    if($total < 1){
   //Prepare query
    $sql = "
        INSERT INTO
        users (firstname, lastname, ident_number, email, password, url_photo, mobile_phone) 
        VALUES (
            '$first_name',
            '$last_name',
            '$ident_number', 
            '$email', 
            '$passwd',
            '$PHOTO_URL',
            '$mobile_phone'
        );
    ";

    //Execute query
    $res = pg_query($supa_conn, $sql);

    if ($res) {
        //echo "User has been created successfully !!! ";
        echo "<script>alert('User has been created successfully !!! ')</script>";
        header('refresh:0;url=signin.html');
    } else {
        echo "Error: User hasn't beei created successfully !!! ";
    }
} else{
    echo "<script>alert('User email already exists. Try again !!! ')</script>";
    header('refresh:0; url=signup.html');
}