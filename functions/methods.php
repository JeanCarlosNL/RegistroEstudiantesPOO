<?php

class methods
{

    public $carreras = [1=>"Software", 2=>"Multimedia", 3=>"Mecatronica", 4=>"Seguridad", 5=>"Redes"];

    public function filtro($lista,$propiedad,$value){
    
        $filtro=[];
    
        foreach($lista as $elemento){
              if($elemento->$propiedad == $value){
                array_push ($filtro,$elemento);
              } 
        }
    
        return $filtro;
    
    }
    
    public function ultimoElemento($lista){
    
        $contarLista=count($lista);
        $ultimoElemento = $lista[$contarLista-1];
        return $ultimoElemento;
    }
    
    public function getIndex($lista, $property, $value){
        $index = 0;
        $aux = 0;
    
        foreach($lista as $elemento){
            if($elemento->$property==$value){
                $index = $aux;
                break;
            }
            $aux++;
    
        }
        return $index;
    }

    public function CargarImagen($directory, $name, $tmpname, $type, $size){

        if(!file_exists('images')){
            mkdir('images',007,true);
            if(file_exists('images')){
                 move_uploaded_file($tmpname,$name);
            }
         }else{
            move_uploaded_file($tmpname,$name);
        }
      
        $newEstudiante->foto=$name;

        return $newEstudiante ;

    }
}


