<?php
namespace Model;

class Personaje extends ActiveRecord {
    protected static $tabla = 'personaje';
    protected static $columnasDB = ['id', 'nombre', 'rol', 'procedencia', 'recurso', 'tipoGolpe'];

    public $id;
    public $nombre;
    public $rol;
    public $procedencia;
    public $recurso;
    public $tipoGolpe;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->rol = $args['rol'] ?? '';
        $this->procedencia = $args['procedencia'] ?? '';
        $this->recurso = $args['recurso'] ?? '';
        $this->tipoGolpe = $args['tipoGolpe'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre.";
        }

        if (!$this->rol) {
            self::$errores[] = 'Debes añadir un rol.';
        }

        if (!$this->procedencia) {
            self::$errores[] = 'Debes añadir una procedencia.';
        }

        if (!$this->recurso) {
            self::$errores[] = 'Debes añadir un recurso.';
        }

        if (!$this->tipoGolpe) {
            self::$errores[] = 'Debes añadir un tipo de golpe.';
        }

        return self::$errores;
    }
    public static function getPersonajes() {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$idPersonaje})";
        $resultados = self::consultarSQL($query);
        return $resultados;
    }
}