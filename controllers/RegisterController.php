<?php 
namespace App\controllers;

use App\Router;
use App\helpers\RandomKeys;
class RegisterController{

    public function __construct(){
        session_start();
        if(isset($_SESSION['User'])){
            unset($_SESSION['User']);
            session_destroy();
        }
    }

    public function create(Router $router){
        $router->db->userSchema();
        $router->view("/auth/register", []);
    }
    public function store(Router $router){
        $errors = [];
        $messages = [];
        $user = [
            'name' => '',
            'email' => '',
            'imagePath' => '',
            'password' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $user['name'] = trim($_POST['name']) ?? null;
            $user['email'] = trim($_POST['email']) ?? null;
            $image = $_FILES['image'] ?? null;
            $password = trim($_POST['passwordConfirm']) ?? null;
            $user['password'] = password_hash($password, PASSWORD_DEFAULT);
            $imagePath = '';

            if(!is_dir(__DIR__.'/../public/images')){
                mkdir(__DIR__.'/../public/images');
            }

            $isUserExist = $router->db->getUser($user['email']);
            if(!$isUserExist){
                if($image && $image['tmp_name']){
                    $imagePath = 'images/'.RandomKeys::generate(8).'_'.$image['name'];
                    $absolutePath = __DIR__.'/../public/'.$imagePath;
                    move_uploaded_file($image['tmp_name'], $absolutePath);
                }
                $user['imagePath'] = $imagePath;
                $error = $router->db->createData($user);
                if ($error) {
                    $errors[] = $error;
                } else {
                    $messages[] = "Successfully User Account is created";
                }
            }else{
                $errors[] = "User has already register an Account!";
            }
            $router->view('/auth/register', [
                "errors" => $errors,
                "messages" => $messages 
            ]);
        }
    }

}
?>