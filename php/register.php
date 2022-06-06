<?php
 session_start();
if(isset($_POST['submit'])){
    $username = strtolower($_POST['fullname']);
    $email =  strtolower($_POST['email']) ;
    $password = $_POST['password'];

registerUser($username, $email, $password);

}
function registerUser($username, $email, $password){
    $filename ="../storage/users.csv";
    $fhandle = fopen($filename, "a"); 
    if(!$fhandle){
        echo "file can't be opened";
        die();
    }
    $no_row =count(file("../storage/users.csv"));
    if($no_row > 1){
        $no_row =($no_row - 1) + 1;
    }
    $form_data = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
    );
    fputcsv($fhandle, $form_data);
    fclose($fhandle);

}

// function registerUser($username, $email, $password){
//     //save data into the file
    
//     $output = "{$username} ,";
//     $output .= "{$email} ,";
//     $output .= "{$password} ";
//     $output .= "\n";

//     $filename ="../storage/users.csv";
//     $fhandle = fopen($filename, "a"); 
//     fwrite($fhandle,  $output); 
//     // echo "OKAY";
// }
echo "User Successfully registered";


