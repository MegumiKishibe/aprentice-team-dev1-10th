<?php
Class SignoutController{
    public function logout(){
        $_SESSION = [];
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }

}