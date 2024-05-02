<?php 
namespace Model;
use Exception;

class Usuario extends ActiveRecord {

    // Base de Datos
    protected static $tabla = 'usuario';
    protected static $columnasDB = [
        'id',
        'usuario',
        'password'
    ];
    
    public $id;
    public $usuario;
    public $password;
    public $autenticado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {

        if (!$this->usuario) {
            self::$errores[] = "El nombre de usuario es obligatorio";
        }
    
        if (!$this->password) {
            self::$errores[] = "La contraseña es obligatoria";
        }
    
        return self::$errores;
    }

    public function existeUsuario() {
        try{
            $query = "SELECT * FROM " . self::$tabla . " WHERE usuario = '" . $this->usuario . "' LIMIT 1";
            $resultado = self::$db->query($query);
            if(!$resultado->rowCount()) {
            self::$errores[] = 'El Usuario No Existe';
            return false;
            }
            return $resultado;
        } catch(Exception $e){
            echo 'Error: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function noExisteUsuario() {
        try{
            $query = "SELECT * FROM " . self::$tabla . " WHERE usuario = '{$this->usuario}';";
        
            $resultado = self::$db->query($query);
            if($resultado->rowCount()) {
                self::$errores[] = 'El Usuario Ya Existe';
                return false;
            }
            return true;
        }catch(Exception $e){
            echo 'Error: ', $e->getMessage(), "\n";
            return false;
        }
    }
    public function comprobarPassword($password) {
        $this->autenticado = password_verify($password, $this->password);
        if(! $this->autenticado) {
            self::$errores[] = 'La contraseña es Incorrecta';
            return false;
        } else{               
            return true;       
        }
    }

    public function autenticar() {
         // El usuario esta autenticado
         session_start();
         // Llenar el arreglo de la sesión
         $_SESSION['usuario'] = $this->usuario;
         $_SESSION['login'] = true;

        header('Location: ./');
    }

    public static function findByUsername($username) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE usuario = '" . $username . "'";
        $resultado = self::consultarSQL($query);
    
        return array_shift($resultado);
    }
    public static function registrarUsuario($usuario) {

    // Validar los datos del usuario
    $errores = $usuario->validar();
    if (!empty($errores)) {
        return $errores;
    }

    // Verificar si el usuario ya está registrado
    if (self::findByUsername($usuario->usuario)) {
        self::$errores[] = 'El nombre de usuario ya está registrado';
        return self::$errores;
    }

    // Encriptar la contraseña
    $usuario->password = password_hash($usuario->password, PASSWORD_DEFAULT);

    // Guardar el usuario en la base de datos
    $resultado = $usuario->guardar();

    if ($resultado) {
        return true;
    } else {
        self::$errores[] = 'Error al registrar el usuario';
        return self::$errores;
    }
    }
}