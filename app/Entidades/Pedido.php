<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestames = false;

    protected $fillable = [
        'idpedidos','fecha', 'descripcion', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            fecha,
            descripcion,
            total,
            fk_idsucursal,
            fk_idcliente,
            fk_idestado
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado
        ]);
        return $this->idpedidos = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE pedidos SET
            fecha= '$this->fecha',
            descripcion= '$this->descripcion',
            total= '$this->total',
            fk_idsucursal= '$this->fk_idsucursal',
            fk_idcliente= '$this->fk_idcliente',
            fk_idestado= '$this->fk_idestado',
            WHERE idpedidos=?";
        $affected = DB::update($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado,
            $this->idpedidos]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE 
        idpedidos=?";
        $affected = DB::delete($sql, [$this->idpedidos]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idpedidos
                fecha,
                descripcion,
                total,
                fk_idsucursal,
                fk_idcliente,
                fk_idestado 
                FROM pedidos ORDER BY fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idpedidos)
    {
        $sql = "SELECT
            idpedidos
            fecha,
            descripcion,
            total,
            fk_idsucursal,
            fk_idcliente,
            fk_idestado 
            FROM pedidos WHERE idpedidos = $idpedidos";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idpedidos = $lstRetorno[0]->idpedidos;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }


}
