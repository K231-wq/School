<?php 
require_once "../vendor/autoload.php";

use App\Router;
use App\controllers\RegisterController;

$router = new Router();

$router->get("/", [RegisterController::class, "create"]);
$router->get("/store", [RegisterController::class, "store"]);

$router->resolve();
?>