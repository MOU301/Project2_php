<?php 
 session_start(); 
include "config/config.php";
include "helpers/helper.php";
spl_autoload_register(function($class_name){
    include "lib/".$class_name.".php";
});
?>