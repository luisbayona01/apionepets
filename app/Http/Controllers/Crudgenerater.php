<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Crudgenerater extends Controller
{   
    public  function  showTables(){

    $tables = DB::select('SHOW TABLES');
      return $tables;
     /*foreach ($tables as $table) {
    foreach ($table as $key => $value)
        echo $value."<br>";
      }*/
    }

  public   function describTable(){


      
 $table='ordenes_de_compra';
  $columns = DB::select("SHOW COLUMNS FROM ". $table);
     //return  $columns; 
     $primaryKey="";
     $fillable="";
     foreach ($columns as  $column) {
        if($column->Key!="PRI"){
             $fillable.="'".$column->Field."',";

           }
         if($column->Key=="PRI")  
            {
           
         $primaryKey.="'".$column->Field."'";
           }
           
       }
    //echo $fillable."<br>";
    //echo $primaryKey."<br>";
   //echo 
       $ColumnSchema=substr($fillable, 0, -1);
  $this->generarM($table,$primaryKey,$ColumnSchema);
  $this->generarC($table,$primaryKey,$ColumnSchema);
    } 
  

   public   function  generarM($table,$primaryKey,$ColumnSchema){
    
     $tabla= ucwords($table);
      //$ColumnSchema;

     $simbolo='$';
      $fh = fopen(base_path()."/app/".$tabla.".php", 'w') or die("Se produjo un error al crear el archivo");    
      
      $texto="<?php  
      namespace App;
      use Illuminate\Database\Eloquent\Model;
     
     class ".$tabla." extends Model {

    public ".$simbolo."timestamps = false;
    protected ".$simbolo."table ='".$table."';  
    protected ".$simbolo."primaryKey = ".$primaryKey.";
    protected ".$simbolo."fillable = [
        ".$ColumnSchema."
    ];

   }";

    fwrite($fh, $texto) or die("No se pudo escribir en el archivo");
     fclose($fh);
     
   

   }
  

    public   function  generarC($table,$primaryKey,$ColumnSchema){
    
     $tabla= ucwords($table);
      //$ColumnSchema;

     $simbolo='$';
     $campos=explode(",",$ColumnSchema);
    
      $fh = fopen(dirname(__FILE__)."/".$tabla."Controller.php", 'w') or die("Se produjo un error al crear el archivo");    
      
      $texto="<?php  
      namespace App\Http\Controllers;
      use Illuminate\Http\Request;
      use App\ ".$tabla.";
      class ".$tabla."Controller extends Controller {
    
       public function show() {
         ".$simbolo.$table." = ".$tabla."::all();
        return ".$simbolo.$table.";
        }

      public function  add(Request ".$simbolo."request){
          ".$simbolo.$table."= new ".$tabla."();
         ".$simbolo."respuesta;
    ";
      
     foreach ($campos as $campo) {
      $camposin=str_replace("'","",$campo);
   
      $texto.= $simbolo.$camposin."=".$simbolo."request->input(".$campo.");\n";

       }  
    
     foreach ($campos as  $value) {
        $camposin=str_replace("'","",$value);
        $texto.=$simbolo.$table."->".$camposin."=".$simbolo.$camposin.";\n";
    
     }
       
      $texto.="if (".$simbolo.$table."->save()) {

               ".$simbolo."respuesta = 'operacion  exitosa';
            }";   



      $texto.=" ".$simbolo."respuesta;  
        }\n"; 
               
       
     $texto.="public function showedit(Request ".$simbolo."request){
     ".$simbolo."id=".$simbolo."request->input('id');
     ".$simbolo.$table." = ".$tabla."::find(".$simbolo."id);
     }\n"; 
     
     $texto.="public function edit(Request ".$simbolo."request){ 
        ".$simbolo."id=".$simbolo."request->input('id');
      "; 
             
    foreach ($campos as $valores) {
      $camposin=str_replace("'","",$valores);
   
      $texto.= $simbolo.$camposin."=".$simbolo."request->input(".$valores.");\n";

       }  
        
     $texto.=$simbolo.$table." = ".$tabla."::find(".$simbolo."id);";
      
        foreach ($campos as  $values) {
        $camposin=str_replace("'","",$values);
        $texto.=$simbolo.$table."->".$camposin."=".$simbolo.$camposin.";\n";
    
     }
       
      $texto.="if (".$simbolo.$table."->save()) {

               ".$simbolo."respuesta = 'operacion  exitosa';
            }";   



      $texto.=" ".$simbolo."respuesta;  
        }\n"; 

        $texto.="public function delete(Request ".$simbolo."request){
     ".$simbolo."id=".$simbolo."request->input('id');
     ".$simbolo.$table." = ".$tabla."::findOrFail(".$simbolo."id);
     ".$simbolo.$table."->delete();

     }"; 


     $texto.="}";
  


    fwrite($fh, $texto) or die("No se pudo escribir en el archivo");
    fclose($fh);
     
   

   }



}
