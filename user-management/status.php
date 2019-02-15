<?php

function loggedIn(){
    if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in']){
        return true;
    }
    else{
        return false;
    }
}
?>