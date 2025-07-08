<?php 
namespace App\controllers;

use App\controllers\auth\Authentication;
use App\Router;
class SessionController {
    public function create(Router $router){
        $router->view("/auth/login",[]);
    }
    public function store(Router $router){
        session_start();
        $errors = [];
        $messages = [];
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']) ?? null;

            $user = $router->db->getUser($email);
            if($user){
                if(password_verify($password, $user['password'])){
                    $token = Authentication::createJWT([
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $user['name']
                    ]);
                    $_SESSION['User'] = [
                        "token"=> "Bearer ".$token,
                    ];
                    $messages[] = "Successfully Login the account😍😍";
                }else{
                    $errors[] = "Invalid Password Credential!!😭😭";
                }
            }else{
                $errors[] = "Invalid Email Credentail! Please register an Account😭😭";
            }
        }
        $router->view('/auth/login', [
            'errors' => $errors,
            'messages' => $messages
        ]);
    }
}
?>