<?php 

namespace Controllers;

use MVC\Router;
use Model\Admin;

class AdminLoginController {
    public static function login( Router $router) {
        
        $errores = [];
        session_start();
        if (isset($_SESSION['adminlogged'])) {
            if($_SESSION['adminlogged'])header('Location: admin');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin([
                'usuario' => $_POST['usuario'] ?? null,
                'password' => $_POST['password'] ?? null 
            ]);
    
            $errores = $auth->validar();
    
            if (empty($errores)) {
                $resultado = $auth->existeUsuario();
                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    $usuario = $resultado->fetchObject();
                    if ($usuario) {
                        // Verificación de password para Admins regulares
                        $autenticado = $auth->comprobarPassword($usuario);
                        if($autenticado){
                            $user = Admin::find($usuario->id);

                            $user->autenticar();
                        } else{ 
                            $errores = Admin::getErrores();
                        }
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }      

        $router->render('auth/login_admin', [
            'errores' => $errores
        ]);
        
    }

    public static function logout(Router $router) {
        session_start();
        session_destroy();
        header('Location: login_admin');
        exit;
    }
}