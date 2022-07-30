<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                    //Comprar usuarios
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                        //verificamos password
                    if($usuario->comprobarPassAndVerifi($auth->password)){
                        isSession();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                            //Redireccionamos
                        if($usuario->admin === "1"){
                                //Si es ususarui agrega el valor de admin
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no existe');
                }
            }
        } 

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        echo "from logout";
    }

    public static function olvidar(Router $router) {
 
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado === "1"){
                   $usuario->crearToken();
                   $usuario->guardar();

                        //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                        // Alertas
                   Usuario::setAlerta('exito', 'Revisa tu email');
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado!');
                }
            }  
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {

        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

            //Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // leer nuevo password y guardar
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = "";
                $usuario->password = $password->password; // De la istancia de password, le pasamos el password a la instancia de usuario ya que el objeto que usamos es de susario.
                $usuario->hashPassword();
                $usuario->token = "";

                $resultado = $usuario->guardar();
                if($resultado){
                        // Crear mensaje de exito
                    Usuario::setAlerta('exito', 'Password Actualizado Correctamente');
                                    
                        // Redireccionar al login tras 3 segundos
                    header('Refresh: 3; url=/');
                }
            }
        }


        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
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

    public static function confirmar(Router $router){
        
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        if(empty($usuario) || $usuario->token === '') {
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            $usuario->confirmado = "1";
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito', '¡Cuenta verificada correctamente!');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}