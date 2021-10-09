<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ordenes_de_compra;
use Illuminate\Support\Facades\DB;
class Ordenes_de_compraController extends Controller
{
    
    public  function showOC(Request $request){
         
         if($request->input('fecha')){
         $ldate=$request->input('fecha'); 
         }else{
           date_default_timezone_set('America/Bogota');
           $ldate = date('Y/m/d'); 
         }
        

        $compradores=$request->input('comprador');
        $ordenesCompra= DB::table('pre_factura')->select('idordenes_de_compra','codigo','nombre','cantidad','valortotal','valor_unitario')->where([['compradores', '=',$compradores],['fecha', '=', $ldate],] )->get();
         
         return $ordenesCompra; 
    } 

     public   function  aprobar_ocompra(Request $request){
          $respuesta=array();
         $ldate=$request->input('fecha'); 
         //$ldate="2020/08/23";
        $compradores=$request->input('comprador');
         //$compradores='5';
          $idscompra= array();
        $ordenesCompra= DB::table('pre_factura')->select('idordenes_de_compra')->where([['compradores', '=',$compradores],['fecha', '=', $ldate],] )->get();
          foreach ($ordenesCompra as  $ocp) {
            $idscompra[]=$ocp->idordenes_de_compra;
           
            }

            //print_r($idscompra);
            //die();
           $aprobar=DB::table('ordenes_de_compra')->whereIn('idordenes_de_compra',$idscompra)->update(['estado' => '1']);
           
           if ($aprobar) {
              $respuesta[] = 'operacion  exitosa';
         
           }
             
            return response()->json($respuesta);
            //count($respuesta);    


     } 

    public function addCompra(Request $request)
    {   date_default_timezone_set('America/Bogota');
        $now = new \DateTime();
        $ordenes_de_compra              = new Ordenes_de_compra();
        $respuesta                      = array();
        $id_producto                    = $request->input('idproducto');
        $compradores                    = $request->input('compradores');
        $estado                         = '0';
        $valorTotal                     = $request->input('valorTotal');
        $cantidad                       = $request->input('cantidad');
        $ordenes_de_compra->id_producto = $id_producto;
        $ordenes_de_compra->compradores = $compradores;
        $ordenes_de_compra->estado      = $estado;
        $ordenes_de_compra->valorTotal  = $valorTotal;
        $ordenes_de_compra->cantidad    = $cantidad;
        $ordenes_de_compra->fecha        =$now;
        if ($ordenes_de_compra->save()) {
            
            $respuesta[] = 'operacion  exitosa';
        }
        return $respuesta;
    }
    public function showedit(Request $request)
    {
        $id                = $request->input('id');
        $ordenes_de_compra = Ordenes_de_compra::find($id);
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');
      
     
        $precio=$request->input('precio');
        $cantidad                      = $request->input('cantidad');
        $ordenes_de_compra              = Ordenes_de_compra::find($id);
        $valorTotal=$precio* $cantidad;
        //$ordenes_de_compra->id_producto = $id_producto;
        //$ordenes_de_compra->compradores = $compradores;
        //$ordenes_de_compra->estado      = $estado;
        $ordenes_de_compra->valorTotal  = $valorTotal;
        $ordenes_de_compra->cantidad    = $cantidad;

        if ($ordenes_de_compra->save()) {
            
            $respuesta[] = 'operacion  exitosa';
        }
         return $respuesta;
    }
    public function delete(Request $request)
    {
        $id                = $request->input('id');
        $ordenes_de_compra = Ordenes_de_compra::findOrFail($id);
       
         if ( $ordenes_de_compra->delete()) {
            
            $respuesta[] = 'operacion  exitosa';
        }
         return $respuesta;
    }
}