<?php  
      namespace App\Http\Controllers;
      use Illuminate\Http\Request;
      use Illuminate\Support\Facades\DB;
      use App\ Productos;
      class ProductosController extends Controller {
    
       public function show() {
         $productos = Productos::all();
        return $productos;
        }


       public  function categoriaproductos(){

        $cproductos= DB::table('categoriproducto')->select('idcategoria','valor')->get();
         return  $cproductos; 
       }
       public function productosClientes(){
 
       $cproductos= DB::table('productos')->select('idproductos','codigo','nombre','descripcion','imagen','precio','id_categoriap')->get();
         return  $cproductos;
        }


        public  function Clientedistribuidor(Request $request){
        $distribuidor=$request->input('distribuidor');
        $Clientedistribuidor=DB::table('clientenegocio')->where('Udistribuidor',$distribuidor)->get();
        return $Clientedistribuidor;

        } 




      public function  add(Request $request){
          $productos= new Productos();
         $respuesta;
    $codigo=$request->input('codigo');
$nombre=$request->input('nombre');
$descripcion=$request->input('descripcion');
$imagen=$request->input('imagen');
$precio=$request->input('precio');
$id_franquicia=$request->input('id_franquicia');
$stock=$request->input('stock');
$id_categoriap=$request->input('id_categoriap');
$productos->codigo=$codigo;
$productos->nombre=$nombre;
$productos->descripcion=$descripcion;
$productos->imagen=$imagen;
$productos->precio=$precio;
$productos->id_franquicia=$id_franquicia;
$productos->stock=$stock;
$productos->id_categoriap=$id_categoriap;
if ($productos->save()) {

               $respuesta = 'operacion  exitosa';
            } $respuesta;  
        }
public function showedit(Request $request){
     $id=$request->input('id');
     $productos = Productos::find($id);
     }
public function edit(Request $request){ 
        $id=$request->input('id');
      $codigo=$request->input('codigo');
$nombre=$request->input('nombre');
$descripcion=$request->input('descripcion');
$imagen=$request->input('imagen');
$precio=$request->input('precio');
$id_franquicia=$request->input('id_franquicia');
$stock=$request->input('stock');
$id_categoriap=$request->input('id_categoriap');
$productos = Productos::find($id);$productos->codigo=$codigo;
$productos->nombre=$nombre;
$productos->descripcion=$descripcion;
$productos->imagen=$imagen;
$productos->precio=$precio;
$productos->id_franquicia=$id_franquicia;
$productos->stock=$stock;
$productos->id_categoriap=$id_categoriap;
if ($productos->save()) {

               $respuesta = 'operacion  exitosa';
            } $respuesta;  
        }
public function delete(Request $request){
     $id=$request->input('id');
     $productos = Productos::findOrFail($id);
     $productos->delete();

     }}