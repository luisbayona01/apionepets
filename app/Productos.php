<?php  
      namespace App;
      use Illuminate\Database\Eloquent\Model;
     
     class Productos extends Model {

    public $timestamps = false;
    protected $table ='productos';  
    protected $primaryKey = 'idproductos';
    protected $fillable = [
        'codigo','nombre','descripcion','imagen','precio','id_franquicia','stock','id_categoriap'
    ];

   }