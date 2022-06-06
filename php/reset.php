<?php
    session_start();
if(isset($_POST["submit"])){
    $email =  $_POST["email"];
    $newpassword =  $_POST["password"];

    resetPassword($email, $newpassword);
}

function resetPassword($email, $newpassword){
    //open file and check if the email exist inside
    //if it does, replace the password
          $email = strtolower($email);

        if(($fhandle = fopen("../storage/users.csv", "r")) !== FALSE && ($fh = fopen("../storage/users.temp.csv", "w")) !== FALSE) {
                while(($data = fgetcsv($fhandle)) !== FALSE) {
                    if($data[1] == $email) {
                        fputcsv($fh, [$data[0], $data[1], $newpassword]);
                        $reply = "Password upadated Successfully";
                    } else {
                        fputcsv($fh, [$data[0], $data[1], $data[2]]);
                    }
                }
                if(!isset($reply)) {
                    $reply = "User does not exist";
                }
            fclose($fhandle);
            fclose($fh);
            rename("../storage/users.temp.csv", "../storage/users.csv");
        }
        return $reply;
    }
    if(isset($_POST['submit'])){
        $email = $_POST["email"];
        $password = $_POST["password"];   
         echo resetPassword($email, $password);
    } else {
        header("Location: ../forms/resetpassword.html");
    }
            




























//         if(($fhandle = fopen("../storage/users.csv", "a")) !== FALSE  && ($fopen = fopen("../storage/users.temp.csv", "w")) !== FALSE) {
//             while (($data = fgetcsv(fopen("../storage/users.csv", "a"))) !== FALSE) {
//                     $num = count($data);
//                        $array1 = array();
//                     for($i = 0; $i< $num; $i++){
//                         $array1[] = $data[$i];
                            
//                     } 
//                     if ($data[0] == $_SESSION['valid_user'] && $data[1] == $_POST['email']) {
//                         $data[2] = $newpassword;
//     //                      $form_data = array(
//     //                     "username" => $_SESSION['valid_user'],
//     //                     "email" => $email,
//     //                     "password" => $newpassword,
//     // ); 
//                          fputcsv($fhandle, $data[2]);
//                         echo "You have Successfully Updated your Password";
                    
                       
//                     }else{
                                     
//                                                  echo $data[2];
// echo "User does not exist" . "<br>";
 
//                     }
//                          fclose($f_open);
//                         fclose($fhandle);

//                     }
//                     //   if (in_array($email, $array1)){
                    //     $array1[2] = $newpassword;
                     

//                     //   }
//                 }
// }





?>
