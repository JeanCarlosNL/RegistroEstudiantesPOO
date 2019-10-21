<?php

class Estudiante{

    public $ID;
    public $nombre;
    public $apellido;
    public $carrera;
    public $materiasFav;
    public $status;
    public $foto;

    function __construct($ID,$nombre,$apellido,$carrera,$materiasFav,$status)
    {
        
        $this->ID = $ID;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->carrera = $carrera;
        $this->materiasFav = $materiasFav;
        $this->status = $status;

    }

    public function getTextCompany(){

        $utilities = new Utilities();

        if($this->company != 0 && $this->company !=null){
            return $utilities->company[$this->company];
        }

        return "";      

    }

    public function getMaterias(){       

        if( !empty($this->materiasFav) && $this->materiasFav !=null){
            return implode(",",$this->materiasFav);
        }

        return "";      

    }
   
}