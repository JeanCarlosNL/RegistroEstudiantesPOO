<?php
include '../helpers/layout.php';
include '../functions/methods.php';
include 'estudiantes.php';

$layout = new layout(true,false,false);
$methods = new methods();

var_dump($methods->carreras);

session_start();

/*Seccion Guardar */

if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['carrera']) && isset($_POST['status']) && isset($_POST['materiasFav'])){

  $estudiantes = $_SESSION['estudiantes'];
  $estudianteID=1;

  if(!empty($estudiantes)){

    $ultimo = $methods->ultimoElemento($estudiantes);
    $estudianteID = $ultimo->ID + 1;

  }

  $materias=explode(",",$_POST['materiasFav']);

  $nuevoEstudiante= new Estudiante($estudianteID, $_POST['nombre'], $_POST['apellidos'], $_POST['carrera'],$materias,$_POST['status']);
 
  if ($_FILES['foto']) {

    $typeReplace = str_replace("image/", "", $_FILES["foto"]["type"]);
    $type =  $_FILES["foto"]["type"];
    $size =  $_FILES["foto"]["size"];
    $tmpname = $_FILES["foto"]["tmp_name"];
    $directory = "../utilities";
    $name = 'images/'.$estudianteID.'.'.$typeReplace;

    if(!file_exists('images')){
      mkdir('images',007,true);
      if(file_exists('images')){
           move_uploaded_file($tmpname,$name);
      }
  }else{
      move_uploaded_file($tmpname,$name);
  }

  $nuevoEstudiante->foto=$name;


    $isSuccess = $methods->CargarImagen($directory, $name, $tmpname, $type, $size);

    if ($isSuccess) {
        $nuevoEstudiante->foto = $name;
    }
}

  array_push($estudiantes,$nuevoEstudiante);
  $_SESSION['estudiantes']=$estudiantes;
	
   header("Location:../index.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de Estudiantes</title>

  <!-- Bootstrap core CSS -->
  <link href="../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../styles/css/scrolling-nav.css" rel="stylesheet">
S
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php $layout->mostrarHeader();?>

<header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al registro de estudiantes</h1>
      <p class="lead">Forma parte de la familia mas grande de profesionales</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Registro de Estudiantes</h2>
          <p class="lead">Realiza el registro de estudiantes colocando los siguientes datos:</p>

          <form method="POST" enctype="multipart/form-data" action ="guardar.php">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nombre" class="lead">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Indroduza su nombre" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="apellidos" class="lead">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Introduzca su apellido" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="carrera" class="lead">Carrera</label>
                  <select id="carrera" name="carrera" class="form-control">
                    <option selected>Seleccione...</option>
                    <option class="lead" value="Software" name="carrera">Software</option>
                    <option class="lead" value="Multimedia" name="carrera">Multimedia</option>
                    <option class="lead" value="Mecatronica" name="carrera">Mecatronica</option>
                    <option class="lead" value="Seguridad" name="carrera">seguridad</option>
                    <option class="lead" value="Redes" name="carrera">Redes</option>
                  </select>
                 </div>
                 <div class="form-group col-md-12">
                      <label for="materiasFav">Materias Favoritas</label>
                      <textarea name="materiasFav" id="materiasFav" class="form-control" placeholder="Escriba las materias favoritas" required></textarea>
                      <small>Colocar las materias favoritas separados por comas</small>
                 
                 </div>

                 <div class=" form-group col-md-5">
                        <div class="form-group">

                            <label for="foto">Foto de perfil</label>
                            <input name="foto" type="file" class="form-control" id="foto" accept="image/*"  required/>

                        </div>
                    </div>


                 <div class="form-group">
                    <div class="form-check" hidden>
                    <input class="form-check-input" type="radio" name="status" id="statusA" value="Activo" checked>
                    <label class="form-check-label lead" for="statusA">
                      Activo
                    </label>
                  </div>
                  <div class="form-check" hidden> 
                    <input class="form-check-input" type="radio" name="status" id="statusI" value="Inactivo">
                    <label class="form-check-label lead" for="statusI">
                      Inactivo
                    </label>
                  </div>
                 </div>
               </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php $layout->mostrarFooter();?>
    
</body>
</html>