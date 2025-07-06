<?php 
namespace App\controllers;

use App\Router;
class RegisterController{

    public function create(Router $router){
        $router->db->userSchema();
        echo "Register Page";
    }
    public function store(){
        echo "data store";
    }
}
?>