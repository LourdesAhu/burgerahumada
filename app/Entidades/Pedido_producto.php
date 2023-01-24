<?php 

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_producto extends Model
{
    protected $table = 'pedidos_productos';
    public $timestames = false;

    protected $fillable = [
        'idpedidoproducto','fk_idproducto', 'fk_idpedido', 'cantidad', 'precio_unitario', 'total',
    ];
    protected $hidden = [

    ];

    
    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
            fk_idproducto,
            fk_idpedido,
            cantidad,
            precio_unitario,
            total
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idpedido,
            $this->cantidad,
            $this->precio_unitario,
            $this->total
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }


    public function guardar()
    {
        $sql = "UPDATE pedidos_productos SET
            fk_idproducto= '$this->fk_idproducto',
            fk_idpedido= '$this->fk_idpedido',
            cantidad= '$this->cantidad',
            precio_unitario= '$this->precio_unitario',
            total= '$this->total',
            WHERE idpedidoproducto=?";
        $affected = DB::update($sql, [
            $this->fk_idproducto,
            $this->fk_idpedido,
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
            $this->idpedidoproducto]);
    }


    public function eliminar()
    {
        $sql = "DELETE FROM pedidos_productos WHERE 
        idpedidoproducto=?";
        $affected = DB::delete($sql, [$this->idpedidoproducto]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idpedidoproducto
                fk_idproducto,
                fk_idpedido,
                cantidad,
                precio_unitario,
                total
                FROM pedidos_productos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idpedidoproducto)
    {
        $sql = "SELECT
                idpedidoproducto
                fk_idproducto,
                fk_idpedido,
                cantidad,
                precio_unitario,
                total
            FROM pedidos_productos WHERE idpedidoproducto = $idpedidoproducto";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
            $this->total = $lstRetorno[0]->total;
            return $this;
        }
        return null;
    }


}
