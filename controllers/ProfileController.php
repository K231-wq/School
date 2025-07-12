<?php 

namespace App\controllers;

use App\controllers\auth\Authentication;
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
        if(!str_starts_with($user['token'], 'Bearer ')){
            header("Refresh: 3; url=/login");
        }
        // var_dump($user);
        $token = str_replace('Bearer ', '', $user['token']);
        $payload = Authentication::verifyJWT($token);
        $router->view("profile/userProfile", [
            "user" => $payload,
        ]);
    }
    public function store(){

    }
    public function logout(){
        if(isset($_SESSION['User'])){
            unset($_SESSION['User']);
            session_unset();
            session_destroy();
            header("Location: /login");
        }
    }
}
?>