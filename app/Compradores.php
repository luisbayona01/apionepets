<?php  
      namespace App;
      use Illuminate\Database\Eloquent\Model;
     
     class Compradores extends Model {

    public $timestamps = false;
    protected $table ='compradores';  
    protected $primaryKey = 'idcompradores';
    protected $fillable = [
        'razon_social','idpropietario','nit'
    ];

   }