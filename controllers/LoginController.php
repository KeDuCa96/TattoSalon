<?php
namespace Controllers;

use MVC\Router;

class LoginController{
    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function logout() {
        echo "from logout";
    }
    public static function olvidar(Router $router) {
        $router->render('auth/olvide-password', [

        ]);
    }
    public static function recuperar() {
        echo "from recuperar";
    }
    public static function crear(Router $router) {
        

        $router->render('auth/crear-cuenta', [

        ]);
    }
}