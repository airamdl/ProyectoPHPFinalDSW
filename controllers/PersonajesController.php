<?php

namespace Controllers;

use MVC\Router;
use Model\Personaje;

class PersonajeController {
    public static function index(Router $router) {
        session_start();
        if (!isset($_SESSION['adminlogged'])) {
            header('Location: login_admin');
        }
        $personajes = Personaje::all();
        $router->render('operaciones/index', ['personajes' => $personajes]);
    }

    public static function crear(Router $router) {
        $errores = Personaje::getErrores();
        $personaje = new Personaje;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $personaje = new Personaje($_POST['personaje']);
            
            // Validar
            $errores = $personaje->validar();
            if (empty($errores)) {
                // Guardar en la base de datos
                $resultado = $personaje->crear();
                if ($resultado) {
                    header('Location: ../admin?resultado=1');
                }
            }
        }
        
        $router->render('operaciones/crear', [
            'errores' => $errores,
            'personaje' => $personaje
        ]);
    }

    public static function actualizar(Router $router) {
        $id = $_GET['id'];
        $personaje = Personaje::find($id);
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $personaje->sincronizar($_POST['personaje']);
            $errores = $personaje->validar();
            
            if (empty($errores)) {
                $resultado = $personaje->guardar();
                if ($resultado) {
                    header('Location: ../admin?resultado=2');
                }
            }
        }
        
        $router->render('operaciones/actualizar', [
            'personaje' => $personaje,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $personaje = Personaje::find($id);
            $resultado = $personaje->eliminar();
            
            if ($resultado) {
                header('Location: ../admin?resultado=3');
            }
        }
    }
}