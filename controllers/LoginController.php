<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['iniciar'])) {
                $usuarioBuscado = $_POST['usuario'];
                $contrasena = $_POST['password'];
                $usuarioEncontrado = Usuario::findByUsername($usuarioBuscado);
           
                if ($usuarioEncontrado) {
                    // El usuario existe, comprobamos la contraseña
                    $usuarioEncontrado->comprobarPassword($contrasena);
                    if ($usuarioEncontrado->autenticado) {
                        // El usuario está autenticado, realizamos la autenticación
                        $usuarioEncontrado->autenticar();
                    } else {
                        // La contraseña es incorrecta
                        $errores[] = 'La contraseña es incorrecta.';
                    }
                } else {
                    // Usuario no encontrado
                    $errores[] = 'Usuario no encontrado.';
                }
            } else if (isset($_POST['registrar'])) {
                $auth = new Usuario($_POST['Usuario']);
                Usuario::registrarUsuario($auth);
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]); 
    }

    public static function logout(Router $router) {
        session_start();
        session_abort();
        header('Location: login');
        exit;
    }
}