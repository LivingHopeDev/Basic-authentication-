<?php
session_start();
if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
 
loginUser($email, $password);

}

function loginUser($email, $password){
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */


        if(($fhandle = fopen("../storage/users.csv", "r")) !== FALSE){
             while (($data = fgetcsv($fhandle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                       $array1 = array();
                    for($i = 0; $i< $num; $i++){
                        $array1[] = $data[$i];
                            
                    } 
                   //  print_r ($array1);
                     
                    if (in_array($email, $array1) && in_array($password,$array1)){
                       // redirect user to the login page
                           $_SESSION["valid_user"] =  $array1[0];

                        Header("Location: ../dashboard.php");                    
                    }elseif(!feof($fhandle) || (!in_array($email, $array1) && !in_array($password,$array1) )){
                            echo '<script>alert("Invalid Username or Password");
                                     window.location="../forms/login.html";
                                  </script>';
                        }
                }
        }else{
            echo "file name or path doesn't exist";
              }
              fclose($fhandle);
}

?>

