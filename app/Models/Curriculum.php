<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = "curriculum";

    protected $fillable =['name','surname','surname2','phone','email','born_date','medium_mark','experience','formation','skills','image'];

    function getPdf() {
      //Ruta de la web, desde public
      return url('storage/pdf') . '/' . $this->id . '.pdf';
    }

    function isPdf() {
        //Ruta desde la raiz del sistema de archivos del sistema.
        return file_exists(storage_path('app/public/pdf') . '/' . $this->id . '.pdf');
    }

    function getPath(){
        if($this->image == null){
            $path = url('assets/img/sinPDF.jpg');
        }else{
            $path = url('storage/' . $this->image);
        }
        return $path;
    }
}
