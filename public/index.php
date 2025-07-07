<?php 
require_once "../vendor/autoload.php";

use App\controllers\ProfileController;
use App\Router;
use App\controllers\RegisterController;
use App\controllers\SessionController;

$router = new Router();

$router->get("/", [RegisterController::class, "create"]);
$router->get("/register", [RegisterController::class, "create"]);
$router->post("/register", [RegisterController::class, "store"]);
$router->get('/login', [SessionController::class, 'create']);
$router->post('/login', [SessionController::class, 'store']);

$router->get('/profile/user', [ProfileController::class, 'create']);
$router->resolve();
?>