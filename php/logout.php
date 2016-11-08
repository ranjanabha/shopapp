<?php
  
try{
    session_start();
    $_SESSION['shopid']="";
    session_unset();
    session_destroy();
    header("Location: ../pages/login.html");
}catch(Exception $e){
   header("Location: ../pages/login.html"); 
}
   



?>