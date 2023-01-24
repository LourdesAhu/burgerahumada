<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestames = false;

    protected $fillable = [
        'idpostulacion','nombre', 'apellido', 'celular', 'correo', 'curriculum',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            nombre,
            apellido,
            celular,
            correo,
            curriculum
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum
        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE postulaciones SET
            nombre= '$this->nombre',
            apellido= '$this->apellido',
            correo= '$this->celular',
            correo= '$this->correo',
            curriculum= '$this->curriculum',
            WHERE idpostulacion=?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum,
            $this->idpostulacion]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM postulaciones WHERE 
        idpostulacion=?";
        $affected = DB::delete($sql, [$this->idpostulacion]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idpostulacion
                nombre,
                apellido,
                celular,
                correo,
                curriculum
                FROM postulaciones ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idpostulacion)
    {
        $sql = "SELECT
            idpostulacion
            nombre,
            apellido,
            celular,
            correo,
            curriculum
            FROM postulaciones WHERE idpostulacion = $idpostulacion";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->celular = $lstRetorno[0]->celular;
            $this->correo = $lstRetorno[0]->correo;
            $this->curriculum = $lstRetorno[0]->curriculum;
            return $this;
        }
        return null;
    }


}
