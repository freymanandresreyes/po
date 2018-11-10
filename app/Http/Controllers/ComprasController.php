<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\compras;
USE App\proveedores;
use App\tiendas;
use App\User;
use App\cajamenor;
use App\entradamenor;
use App\salidamenor;
use App\consecutivos;
use App\controlcajas;
use App\productos;
use App\categorias;
use App\subcategorias;
use App\configuraciones;
use App\zonas;
use App\siyno;
use App\clasificacionproductos;

class ComprasController extends Controller
{
    // FUNCION PARA LA VISTA DE COMPRAS
    // SE ENVIAN LOS PROVEEDORES A UN SELECT
    public function compras(Request $request)
    {
        $zonas = zonas::all();
        $proveedores=proveedores::all();
        $userTienda = $request->user()->tienda;
        $consulta_tienda=tiendas::find($userTienda);
        $consulta_iva=configuraciones::where('tienda',$userTienda)->get();
        $siyno = siyno::all();
        $clasificaciones = clasificacionproductos::all();
        // dd($consulta_iva);
        // dd($consulta_iva[0]->iva);
        return view('compras.compras',compact('proveedores','consulta_tienda','consulta_iva', 'zonas','siyno','clasificaciones'));
    }
    // FIN DE LA FUNCION



    // FUNCION PARA VALIDAR SI EXISTE UN PROVEEDRO
    // Y PARA CREAR UN NUEVO PROVEEDOR
    public function crear_proveedor(Request $request)
    {
        $conteo=0;
        $consulta=proveedores::all();
        for ($i = 0; $i <= (count($consulta))-1; $i++) 
        {
          if($consulta[$i]['nombre']==$request->nombre || $consulta[$i]['nit']==$request->nit)
          {
            $respuesta=0;
            return response()->json($respuesta);
          }
        }
        
        $nuevo_proveedor= new proveedores;
        $nuevo_proveedor->nombre=$request->nombre;
        $nuevo_proveedor->nit=$request->nit;
        $nuevo_proveedor->direccion=$request->direccion;
        $nuevo_proveedor->telefono=$request->telefono;
        $nuevo_proveedor->save();
        $respuesta=1;
        return response()->json($nuevo_proveedor);
    }
    // FIN DE LA FUNCION



    public function buscar_producto_compra(Request $request)
    {
        $codigo = $request->codigo;
        $tienda = $request->tienda;
        
        $tienda_p=productos::where([['id_tienda',$tienda],['codigo',$codigo]])->first();

        if(!empty($tienda_p))
        {
          $tienda_p->categoriaProductos;
  
          $tienda_p->subcategoriaProductos; 

          return response()->json($tienda_p);
          } 
          else
         {
          $respuesta = 1;
          return response()->json($respuesta);
        }
    }
    


    // FUNCION PARA REGISTRAR UNA COMPRA
    public function crear_compra(Request $request)
    {
      $user = $request->user()->id;
      $iva=intval($request->iva);
      $tienda = $request->id_tienda;
      $proveedor = $request->id_proveedor;
      $datos = $request->datos;
      $numero_factura = $request->numero_factura;
      $forma_pago = $request->forma_pago;
      $fecha_inicio = $request->fecha;
      $fecha_fin = $request->fecha_vencimiento;
      $tipo = $request->tipo;
      
     
      if ($tipo == 1 || $tipo == "1") {//compras
        for ($i=0; $i < count($datos) ; $i++) { 
          $nueva_compra= new compras;
          $nueva_compra->id_proveedor= $proveedor;
          $nueva_compra->codigo_producto=$datos[$i][0];
          $nueva_compra->numero_factura=$numero_factura;
          $nueva_compra->forma_pago=$forma_pago;
          $nueva_compra->fecha= $fecha_inicio;
          $nueva_compra->fecha_vencimiento= $fecha_fin;
          $nueva_compra->cantidad=$datos[$i][4];
          //eliminamos los separadores de mil
          $valor_unidad = str_replace ('.', '', $datos[$i][3]);
          
          $nueva_compra->costo_und=$valor_unidad;
          $nueva_compra->id_producto=$datos[$i][1];
          // VARIABLE DONDE SACO EL VALOR DE LA COMPRA
          $compra_total= intval($datos[$i][4])*intval($valor_unidad);
          $iva_insertar=($compra_total*$iva)/100;
          // VARIABLE DONDE SACO EL VALOR DE LA COMPRA
          $nueva_compra->compra_total=$compra_total;
          $nueva_compra->iva_compra=$iva_insertar;
          $nueva_compra->total_compra=$compra_total+$iva_insertar;
          $nueva_compra->iva=$iva;
          $nueva_compra->id_tienda=$tienda;
          $nueva_compra->id_user=$user;
          $nueva_compra->estado=0;
          $nueva_compra->precio_detal = $datos[$i][5];
          $nueva_compra->precio_mayor = $datos[$i][6];
          $nueva_compra->oferta = $datos[$i][7];
          $nueva_compra->descuento_oferta = $datos[$i][8];
          $nueva_compra->configuraciones = $datos[$i][9];
          $nueva_compra->aplicar_iva = $datos[$i][10];
          $nueva_compra->save();
          // dd($nueva_compra);
        }
        return response()->json($nueva_compra);

      } elseif($tipo == 2 || $tipo == "2") {//traslado
        
        $c = consecutivos::where('id_tienda', $request->id_proveedor)
                            ->where('tag', 'TRAS')->get();
        $v = 0;
        foreach ($c as $value) {
          if($value->consecutivo > $v){
            $v = $value->consecutivo;
          }
        }

        $n = new consecutivos;
        $n->id_tienda = $request->id_proveedor;
        $n->tag = 'TRAS';
        $n->consecutivo = $v+1;
        $n->save();

        $consecutivo = "TRAS-".($v+1);
        for ($i=0; $i < count($datos) ; $i++) { 
          $nueva_compra= new compras;
          // $nueva_compra->id_proveedor= $proveedor;
          $nueva_compra->codigo_producto=$datos[$i][0];
          $nueva_compra->numero_factura=$consecutivo;
          $nueva_compra->forma_pago=$forma_pago;
          $nueva_compra->fecha= $fecha_inicio;
            $nueva_compra->fecha_vencimiento= $fecha_fin;
            $nueva_compra->cantidad=$datos[$i][4];
            //eliminamos los separadores de mil
            $valor_unidad = str_replace ('.', '', $datos[$i][3]);
            
            $nueva_compra->costo_und=$valor_unidad;
            $nueva_compra->id_producto=$datos[$i][1];
            // VARIABLE DONDE SACO EL VALOR DE LA COMPRA
            $compra_total= intval($datos[$i][4])*intval($valor_unidad);
            $iva_insertar=($compra_total*$iva)/100;
            // VARIABLE DONDE SACO EL VALOR DE LA COMPRA
            $nueva_compra->compra_total=$compra_total;
            $nueva_compra->iva_compra=$iva_insertar;
            $nueva_compra->total_compra=$compra_total+$iva_insertar;
            $nueva_compra->iva=$iva;
            $nueva_compra->id_tienda=$tienda;
            $nueva_compra->id_user=$user;
            $nueva_compra->estado=0;
            $nueva_compra->precio_detal = $datos[$i][5];
            $nueva_compra->precio_mayor = $datos[$i][6];
            $nueva_compra->oferta = $datos[$i][7];
            $nueva_compra->descuento_oferta = $datos[$i][8];
            $nueva_compra->configuraciones = $datos[$i][9];
            $nueva_compra->aplicar_iva = $datos[$i][10];
            $nueva_compra->save();

            $producto = $datos[$i][1];

            $act = productos::find($producto);
            $cantidad = intval($act->cantidad) - intval($datos[$i][4]);
            $can_salida = intval($act->cantidad_ventas) + intval($datos[$i][4]);
            $act->cantidad = $cantidad;
            $act->cantidad_ventas = $can_salida;
            $act->save();




            // dd($nueva_compra);
          }
          return response()->json($nueva_compra);
        }
        
    }

}
