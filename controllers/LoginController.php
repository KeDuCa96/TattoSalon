<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
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
        $usuario = new Usuario($_POST);

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {

                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                        //Hash password
                    $usuario->hashPassword();

                    $usuario->crearToken();
                    
                    $mail = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $mail->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /mensaje');
                    }

                    //debuguear($usuario);
                }
            }

        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
}