<?php  
      namespace App\Http\Controllers;
      use Illuminate\Http\Request;
      use Illuminate\Support\Facades\DB;
      use App\Usuarios;
      use App\Compradores;

      class UsuariosController extends Controller {
    
       public function show() {
         $usuarios = Usuarios::all();
        return $usuarios;
        }
      
       public  function ciudades(){

        $ciudades= DB::table('ciudad')->select('idciudad','valor')->where('id_depto', '16')->get();
         return $ciudades; 
       }


        public  function localidad(Request $request){
          
         
        $idpto=$request->input('id_depto');  
        $localidad= DB::table('localidad')->select('idlocalidad','valor')->where('id_ciudad',$idpto)->get();
         return $localidad; 
       }

 
     public  function barrio(Request $request){
          
        $idpto=$request->input('id_localidad');  
        $barrio= DB::table('barrio')->select('idbarrio','valor')->where('id_localidad',$idpto)->get();
         return $barrio; 
       }


      public function  addCliente(Request $request){
            
          $tokener = bin2hex(openssl_random_pseudo_bytes (64));
          $response="";


            $usuarios= new Usuarios();
            $respuesta;
            $cnit=$request->input('nit');
            $crazon_social=$request->input('razonSocial');
            $codigo="";
            $nombres=$request->input('NombreP');
            $apellidos=$request->input('ApellidosP');
            $email=$request->input('email');
            $direccion=$request->input('Direccion');
            $password=$request->input('identificacion');
            $id_barrio=$request->input('barrio');
            $tipo_usuario='3';
            $telefono=$request->input('Telefono');
            $identtificacion=$request->input('identificacion');
            $token=$tokener;
            $usuarios->codigo=$codigo;
            $usuarios->nombres=$nombres;
            $usuarios->apellidos=$apellidos;
            $usuarios->email=$email;
            $usuarios->direccion=$direccion;
            $usuarios->password=$password;
            $usuarios->id_barrio=$id_barrio;
            $usuarios->tipo_usuario=$tipo_usuario;
            $usuarios->telefono=$telefono;
            $usuarios->identtificacion=$identtificacion;
            $usuarios->token=$token;
            if ($usuarios->save()) {
                  $iduser=$usuarios->idusuarios;
                  $response=$this->guardarcomp($iduser,$cnit,$crazon_social);
                  } 
                       return  $response;  
        }
     public function showedit(Request $request){
       $id=$request->input('id');
       $usuarios = Usuarios::find($id);
       }
  public function edit(Request $request){ 
      $id=$request->input('id');
      $codigo=$request->input('codigo');
      $nombres=$request->input('nombres');
      $apellidos=$request->input('apellidos');
      $email=$request->input('email');
      $direccion=$request->input('direccion');
      $password=$request->input('password');
      $id_barrio=$request->input('id_barrio');
      $tipo_usuario=$request->input('tipo_usuario');
      $telefono=$request->input('telefono');
      $identtificacion=$request->input('identtificacion');
      $token=$request->input('token');
      $usuarios = Usuarios::find($id);$usuarios->codigo=$codigo;
      $usuarios->nombres=$nombres;
      $usuarios->apellidos=$apellidos;
      $usuarios->email=$email;
      $usuarios->direccion=$direccion;
      $usuarios->password=$password;
      $usuarios->id_barrio=$id_barrio;
      $usuarios->tipo_usuario=$tipo_usuario;
      $usuarios->telefono=$telefono;
      $usuarios->identtificacion=$identtificacion;
      $usuarios->token=$token;
      if ($usuarios->save()) {
     
                  $respuesta[] = 'operacion  exitosa';
                  } 
                 return  $respuesta;  
              }
public function delete(Request $request){
     $id=$request->input('id');
     $usuarios = Usuarios::findOrFail($id);
     $usuarios->delete();

     }

   public   function guardarcomp($iduser,$cnit,$crazon_social){
   $respuesta= array();
   $Compradores=new Compradores();
   $Compradores->razon_social=$crazon_social;
   $Compradores->idpropietario=$iduser;
   $Compradores->nit=$cnit;
   if($Compradores->save()){
    $respuesta[] = 'operacion exitosa';;
    } 
     //var_dump($respuesta); 
   return  $respuesta;
   }

   public function consultaventasDia(Request $request){
    $distribuidor=$request->input('distribuidor');
    $contadores_clientesventas= DB::table('contadores_clientesventas')->select('countador_ventas')->where('Udistribuidor',$distribuidor )->get();
         return $contadores_clientesventas; 
   }

   public function consultaventaspesos(Request $request){
    $distribuidor=$request->input('distribuidor');
    $totalventasdia= DB::table('totalventasdia')->select('totalventas')->where('Udistribuidor',$distribuidor )->get();
         return $totalventasdia; 
   }

 public function autenticar(Request $request){

  $identificacion=$request->input('Username');
  $password=$request->input('Password');
  $state=$request->input('state');
  switch ($state) {
    case '0':
     $login=DB::table('login')->where([['identtificacion', '=',$identificacion],['password', '=', $password],['tipo_usuario', '=','2']])->get();
       break;
    case '1':
    $login=DB::table('login')->where([['identtificacion', '=',$identificacion],['password', '=', $password],['tipo_usuario', '=','1']])->get();
      break;


  }
 return $login; 

 }
   public  function  consultaClientes(){
    
    $Clientes=DB::table('clientes')->get();
    return  $Clientes;
   }
    
   }