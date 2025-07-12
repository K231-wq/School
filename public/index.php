<?php 
require_once "../vendor/autoload.php";

use App\controllers\ProfileController;
use App\Router;
use App\controllers\RegisterController;
use App\controllers\SessionController;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();

// $router->get("/", [RegisterController::class, "create"]);
$router->get("/register", [RegisterController::class, "create"]);
$router->post("/register", [RegisterController::class, "store"]);
$router->get('/login', [SessionController::class, 'create']);
$router->post('/login', [SessionController::class, 'store']);

$router->get('/profile/user', [ProfileController::class, 'create']);
$router->get('/logout', [ProfileController::class, 'logout']);
$router->resolve();
?>