<?php  
      namespace App;
      use Illuminate\Database\Eloquent\Model;
     
     class Usuarios extends Model {

    public $timestamps = false;
    protected $table ='usuarios';  
    protected $primaryKey = 'idusuarios';
    protected $fillable = [
        'codigo','nombres','apellidos','email','direccion','password','id_barrio','tipo_usuario','telefono','identtificacion','token'
    ];

   }