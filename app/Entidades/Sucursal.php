<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestames = false;

    protected $fillable = [
        'idsucursal','telefono', 'direccion', 'linkmapa',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            telefono,
            direccion,
            linkmapa
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmapa
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE sucursales SET
            telefono= '$this->telefono',
            direccion= '$this->direccion',
            linkmapa= '$this->linkmapa',
            WHERE idsucursal=?";
        $affected = DB::update($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmapa,
            $this->idsucursal]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM sucursales WHERE 
        idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idsucursal
                telefono,
                direccion,
                linkmapa
                FROM sucursales ORDER BY telefono";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idsucursal)
    {
        $sql = "SELECT
            idsucursal
            telefono,
            direccion,
            linkmapa
            FROM sucursales WHERE idsucursal = $idsucursal";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmapa = $lstRetorno[0]->linkmapa;
            return $this;
        }
        return null;
    }


}
