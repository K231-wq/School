<?php 

namespace App\controllers;

use App\Router;

session_start();
class ProfileController{

    public function index(){

    }
    public function create(Router $router){
        $user = $_SESSION['User'] ?? null;
        if(!$user){
            header("Refresh: 3; url=/login");
        }
        $router->view("profile/userProfile", [
            "user" => $user,
        ]);
    }
    public function store(){

    }
}
?>