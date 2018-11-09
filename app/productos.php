<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
  //funciones para las relaciones
  public function categoriaProductos()
  {
      return $this->belongsTo('App\categorias','id_categoria','id');
  }

  public function siyno()
  {
      return $this->belongsTo('App\siyno','oferta','id');
  }

  public function clasificacion()
  {
      return $this->belongsTo('App\clasificacionproductos','id_configuraciones','id');
  }

  public function subcategoriaProductos()
  {
      return $this->belongsTo('App\subcategorias','id_subcategoria','id');
  }

  public function tiendaProductos()
  {
      return $this->belongsTo('App\tiendas','id_tienda','id');
  }

  public function separadosProductos()
    {
        return $this->hasMany('App\separados');
    }
  public function remisionesProducto()
    {
        return $this->hasMany('App\remisiones');
    }

 //metodos scope para buscar productos
    public function scopeCategoria($query, $valor){
      if($valor)
        return $query->where('id_categoria', 'LIKE', "%$valor%");
    }

    public function scopeSubcategoria($query, $valor){
      if($valor)
        return $query->where('id_subcategoria', 'LIKE', "%$valor%");
    }

    public function scopeTitulo($query, $valor){
      if($valor)
        return $query->where('titulo', 'LIKE', "%$valor%");
    }

}
