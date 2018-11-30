<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tiendas;
use Laracasts\Flash\Flash;
use App\compras;
use App\productos;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\categorias;
use App\subcategorias;

class CargaMasivaController extends Controller
{
    public function carga_masiva_compras()
    {
        $consulta=tiendas::where('estado',0)->select('id','slug')->get();
        // dd($consulta);
        return view('CargaMasiva.cargamasiva_compras',compact('consulta'));
    }

    public function subir_carga_masiva_compras(Request $request)
    {
      //Contador de fallas y exitos de registros
      $GLOBALS['correct'] = 0;
      $GLOBALS['bad'] = 0;
      $GLOBALS['failed_compras'] = [];
      $GLOBALS['cont'] = 0;

           $data = request()->validate([
              'excel'         => 'required|file',
              'tienda'        => 'required',
           ]);

        $extensions = array("csv","xlsx","xls");

        $result = array($request->file('excel')->getClientOriginalExtension());

        if(!in_array($result[0],$extensions)){//Validar que el archivo sea de tipo excel
          Flash::error("<strong><i class='fa fa-times'></i> El archivo debe de ser de tipo excel (.csv, .xlsx, .xls)</strong>");
          return redirect()->route("carga_masiva_compras");
         }
       
        Excel::selectSheetsByIndex(0)->load($request->file('excel'), function($reader) use($request) {
        
          $excel = $reader->get();
          
          //iteración de registros
          $reader->each(function($row) use($request) {
            
             //Nueva compra 
             $compra = [ 
             'id_proveedor'     => $row->id_proveedor,
             'codigo_producto'    => $row->codigo_producto,
             'numero_factura'     => $row->numero_factura,
             'forma_pago'       => $row->forma_pago,
             'fecha'        => $row->fecha,
             'fecha_vencimiento'  => $row->fecha_vencimiento,
             'cantidad'       => $row->cantidad,
             'costo_und'      => $row->costo_und,
             'compra_total'     => $row->compra_total,
             'iva_compra'       => $row->iva_compra,
             'total_compra'     => $row->total_compra,
             'iva'          => $row->iva,
             'id_tienda'      => $row->id_tienda,
             'id_user'        => $row->id_user,
             'id_producto'      => $row->id_producto,
             'created_at'       => date('Y-m-d H:i:s'),
             'updated_at'       => date('Y-m-d H:i:s'),
             'estado'         => $row->estado,
             'precio_detal'     => $row->precio_detal,
             'precio_mayor'     => $row->precio_mayor,
             'oferta'         => $row->oferta,
             'descuento_oferta'   => $row->descuento_oferta,
             'configuraciones'    => $row->configuraciones,
             'aplicar_iva'      => $row->aplicar_iva
            ];
             
              //Buscar el producto
              $producto = productos::where([['codigo', '=', $row->codigo_producto],['id_tienda', '=', $request->tienda]])->first();

              if(!empty($producto)){ //Si el producto existe en esa tienda se registra la compra
                $compra['id_producto'] = $producto->id;
              //Registrar la compra en la BD
              $compra_save = DB::table('compras')->insert($compra);

              if(!empty($compra_save)){
               //Contar la cantidad de usuarios que si se crearon correctamente
                   $GLOBALS['correct']++;
              }else{
                //Contar la cantidad de usuarios que no se crearon por algun error
                $GLOBALS['bad']++;
                //Añadir los codigos de productos que fallaron
                $GLOBALS['failed_compras'][$GLOBALS['cont']] = $row->codigo_producto;
              }
             }else{
                //Contar la cantidad de usuarios que no se crearon por algun error
                $GLOBALS['bad']++;
                    //Añadir los codigos de productos que fallaron
                    $GLOBALS['failed_compras'][$GLOBALS['cont']] = ['codigo' => $row->codigo_producto, 'fila' => $GLOBALS['cont'] + 1];
              }
         $GLOBALS['cont']++;
          });
   
      });
        
       
      Flash::info('<p><i class="fa fa-info-circle"></i> Se realizaron <b style="font-size: 20px;">'. $GLOBALS['correct'] .'</b> registros exitosos y <b style="font-size: 20px;">'. $GLOBALS['bad'] .'</b> registros fallidos.<br> <em>>>Total de registros procesados: <b style="font-size: 18px;">'
        . ($GLOBALS['correct'] + $GLOBALS['bad']) . '</b></em></p>');
      
      $failed_compras = $GLOBALS['failed_compras'];
      
      $message = "<p><strong><i class='fa fa-times'></i> DETALLE DE REGISTROS FALLIDOS:</strong></p>";
      $message .= "<table border='1'><thead><tr><th class='text-center' style='padding: 10px;'>CODIGO PRODUCTO</th><th class='text-center'>Nº FILA EXCEL</th></tr></thead><tbody>";
      foreach($failed_compras as $fail){
          $message .= "<tr><td class='text-center'><b>". $fail['codigo'] ."</b></td><td class='text-center'><b>". $fail['fila'] ."</b></td></tr>";
      }
      $message .= "</tbody></table>";
      
      Flash::error($message);
        
      return redirect()->route('carga_masiva_compras');

    }

      public function carga_masiva_productos()
    {

        $consulta=tiendas::where('estado',0)->select('id','slug')->get();
        // dd($consulta);
        return view('CargaMasiva.cargamasiva_productos',compact('consulta'));
    }

     public function subir_carga_masiva_productos(Request $request)
    {
        //Contador de fallas y exitos de registros
        $GLOBALS['correct'] = 0;
        $GLOBALS['bad'] = 0;
        $GLOBALS['failed_productos'] = [];
        $GLOBALS['cont'] = 0;

           $data = request()->validate([
              'excel'         => 'required|file',
              'tienda'        => 'required',
           ]);

        $extensions = array("csv","xlsx","xls");

        $result = array($request->file('excel')->getClientOriginalExtension());

        if(!in_array($result[0],$extensions)){//Validar que el archivo sea de tipo excel
          Flash::error("<strong><i class='fa fa-times'></i> El archivo debe de ser de tipo excel (.csv, .xlsx, .xls)</strong>");
          return redirect()->route("carga_masiva_productos");
         }
       
        Excel::selectSheetsByIndex(0)->load($request->file('excel'), function($reader) use($request) {
        
          $excel = $reader->get();

          
          //iteración de registros
          $reader->each(function($row) use($request) {
            
             //Nuevo producto 
             $producto = [ 
                'id_tienda'           => $request->tienda,
                'id_categoria'        => $row->id_categoria,
                'id_subcategoria'     => $row->id_subcategoria,
                'titulo'              => $row->titulo,
                'codigo'              => $row->codigo, 
                'descripcion'         => $row->descripcion,
                'descuentoOferta'     => 0,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
                'id_configuraciones'  => $row->id_configuraciones,
                'aplicar_iva'         => 1,
                'cant_recibida'       => 0,
                'cant_enviada'        => 0
            ];
             
              //Buscar categoria y subcategoria del producto
              $search_category = DB::table('categorias')->where([['id','=', $row->id_categoria],['id_tienda','=', $request->tienda]])->first();
              $search_subcategory = DB::table('subcategorias')->where([['id','=',$row->id_subcategoria],['id_tienda','=', $request->tienda]])->first();
              $search_producto = DB::table('productos')->where([['codigo', '=', $row->codigo],['id_tienda','=', $request->tienda]])->first();

              if(!empty($search_category) && !empty($search_subcategory) && empty($search_producto)){ //Si el producto no existe en esa tienda, la categoria pertenece a la tienda y la subcategoria tambien, se registra el producto
              
              //Registrar el producto en la BD
              $producto_save = DB::table('productos')->insert($producto);

              if(!empty($producto_save)){
               //Contar la cantidad de usuarios que si se crearon correctamente
                   $GLOBALS['correct']++;
              }else{
                //Contar la cantidad de usuarios que no se crearon por algun error
                $GLOBALS['bad']++;
                //Añadir los codigos de productos que fallaron
               $GLOBALS['failed_productos'][$GLOBALS['cont']] = $row->codigo;
              }
             }else{
                    //Contar la cantidad de usuarios que no se crearon por algun error
                    $GLOBALS['bad']++;
                    //Añadir los codigos de productos que fallaron
                    $GLOBALS['failed_productos'][$GLOBALS['cont']] = ['codigo' => $row->codigo, 'fila' => $GLOBALS['cont'] + 1];
              }
         $GLOBALS['cont']++;
          });
   
      });
        
       
      Flash::info('<p><i class="fa fa-info-circle"></i> Se realizaron <b style="font-size: 20px;">'. $GLOBALS['correct'] .'</b> registros exitosos y <b style="font-size: 20px;">'. $GLOBALS['bad'] .'</b> registros fallidos.<br> <em>>>Total de registros procesados: <b style="font-size: 18px;">'
        . ($GLOBALS['correct'] + $GLOBALS['bad']) . '</b></em></p>');
      
      $failed_productos = $GLOBALS['failed_productos'];
      
      $message = "<p><strong><i class='fa fa-times'></i> DETALLE DE REGISTROS FALLIDOS:</strong><br><small>>> Estos registros fallidos se pueden dar porque ya existe un producto con esa referencia en la tienda seleccionada o porque el ID de categoria y subcategoria no existan en esa tienda.</small></p>";
      $message .= "<table border='1'><thead><tr><th class='text-center' style='padding: 10px;'>CODIGO PRODUCTO</th><th class='text-center'>Nº FILA EXCEL</th></tr></thead><tbody>";
      foreach($failed_productos as $fail){
          $message .= "<tr><td class='text-center'><b>". $fail['codigo'] ."</b></td><td class='text-center'><b>". $fail['fila'] ."</b></td></tr>";
      }
      $message .= "</tbody></table>";

      if($GLOBALS['failed_productos']){

      Flash::error($message);
      
      }
        
      return redirect()->route('carga_masiva_productos');

    }


}
