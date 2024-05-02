<?php

namespace Model;

/**
 * Clase Admin que extiende de ActiveRecord y representa a los administradores del sistema.
 */
class Admin extends ActiveRecord {
   
    // Base DE DATOS
    protected static $tabla = 'Admin';
    protected static $columnasDB = ['id', 'usuario', 'password'];
  
    /** @var int|null Identificador del administrador. */
    public $id;
    
    /** @var string Nombre de usuario del administrador. */
    public $usuario;
    
    /** @var string Contraseña del administrador. */
    public $password;
    
    /** @var bool Estado de autenticación del administrador. */
    public $autenticado;

    /**
     * Constructor de la clase Admin.
     *
     * @param array $args Arreglo opcional con los datos del administrador.
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    /**
     * Validar los datos del administrador.
     *
     * @return array Arreglo con mensajes de error, si los hay.
     */
    public function validar() {
        if(!$this->usuario) {
            self::$errores[] = "El usuario del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    /**
     * Verificar si el usuario existe en la base de datos.
     *
     * @return object|null Objeto del usuario si existe, o null si no existe.
     */
    public function existeUsuario() {
        try{
            $query = "SELECT * FROM " . self::$tabla . " WHERE usuario like '{$this->usuario}';";
            $resultado = self::$db->query($query);
            if(!$resultado->rowCount()) {
                self::$errores[] = 'El Usuario No Existe';
                return false;
            }
            return $resultado;
        }catch(Exception $e){
            echo 'Error: ', $e->getMessage(), "\n";
            return false;
        }
    }

    /**
     * Comprobar si la contraseña proporcionada coincide con la del usuario.
     *
     * @param object $usuario Objeto del usuario con información de la contraseña.
     * @return void
     */
    public function comprobarPassword($usuario) {
        if (!$usuario) {
            self::$errores[] = 'El Usuario No Existe';
            return false;
        }
        $autenticado = password_verify($_POST['password'], $usuario->password);
        
        if(!$autenticado) {
            self::$errores[] = 'El Password es Incorrecto';
            return false;
        } else{               
            return true;       
        }
    }

    /**
     * Autenticar al administrador y crear una sesión.
     *
     * @return void
     */
    public function autenticar() {
         // El usuario está autenticado
         session_start();

         // Llenar el arreglo de la sesión
         $_SESSION['usuario'] = $this->usuario;
         $_SESSION['login'] = true;
         $_SESSION['adminlogged'] = true;
        header('Location: admin');
    }

    /**
     * Buscar un usuario por su nombre de usuario.
     *
     * @param string $user Nombre de usuario a buscar.
     * @return object|null Objeto del usuario si se encuentra, o null si no se encuentra.
     */
    public static function findByUser($user){
        $query = "SELECT * FROM " . static::$tabla  ." WHERE usuario = :usuario";
        $parametros = [':usuario' => $user];

        $resultado = self::consultarSQL($query, $parametros);
    
        return array_shift($resultado);
    }
}