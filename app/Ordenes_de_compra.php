<?php  
      namespace App;
      use Illuminate\Database\Eloquent\Model;
     
     class Ordenes_de_compra extends Model {

    public $timestamps = false;
    protected $table ='ordenes_de_compra';  
    protected $primaryKey = 'idordenes_de_compra';
    protected $fillable = [
        'id_producto','compradores','estado','valorTotal','cantidad','fecha'
    ];

   }