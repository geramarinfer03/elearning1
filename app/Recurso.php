<?php

namespace elearning1;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'id_recurso','nombre', 'url', 'tipo_recurso', 'recurso_padre', 'visibl', 'secuencia', 'notas', 'estado', 'semana','rol'
    ];


    
    protected $table = "Recurso";
    protected $primaryKey = 'id_recurso';
    public $timestamps = false;

    public function semana(){

    	return $this->belongsTo(Semana::class,'semana');
    }
    
    public function rol(){

    	return $this->belongsTo(Rol::class,'rol');
    }

    public function extencion(){
        list($url, $exten) = explode(".", $this->url); 
        return $exten;
    }

    public function isvideo(){
        $ext = $this->extencion();

        if($ext == "3gp"  || $ext == "mp4" ||  $ext == "mpeg" ||  $ext == "webm" || 
            $ext == "flv" || $ext == "mkv" || $ext == "wmv"  || $ext == "avi"){
            return true;
        }
        return false;

    }

    public function isaudio(){

         $ext = $this->extencion();


        if($ext == "mp4a"  || $ext == "mpga" ||  $ext == "mp3" ||  $ext == "wav" || 
            $ext == "wma" || $ext == "aac" || $ext == "rip"  || $ext == "eol" || $ext == "oga"){

            return true;
        }
        return false;

    }

    public function isimage(){
        $ext = $this->extencion();

        if($ext == "bmp"  || $ext == "gif" ||  $ext == "jpeg" ||  $ext == "png" || 
            $ext == "svg" || $ext == "ico" || $ext == "pnm"  || $ext == "rgb" || $ext == "3ds"){
            return true;
        }
        return false;

    }

    /*public function tipo_recurso(){
    	return $this->belongsTo(Tipo_recurso::class,'tipo_recurso');
    }*/
}
