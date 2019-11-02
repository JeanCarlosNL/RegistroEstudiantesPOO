<?php 
include '../functions/methods.php';
include '../helpers/layout.php';
require_once 'estudiantes.php';

$layout = new layout(true,false,false);
$methods = new methods;


/* Seccion Editar */

session_start();

$estudiantes = $_SESSION['estudiantes'];

$elemento = [];

if(isset($_GET['ID'])==true){

  $editID = $_GET['ID'];

  $elemento = $methods->filtro($estudiantes,'ID', $_GET['ID'])[0];

  $indexElemento = $methods->getIndex($estudiantes,'ID', $_GET['ID']);

}

if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['carrera']) && isset($_POST['status']) && isset($_POST['materiasFav'])){

  $materias = explode(",", $_POST['materiasFav']);

  $actualizarEstudiante = new estudiante($_GET['ID'], $_POST['nombre'], $_POST['apellidos'], $_POST['carrera'],$materias,$_POST['status']);
  
  if ($_FILES['foto']) {

    if ($_FILES['foto']['error'] == 4) {
        $actualizarEstudiante->foto = $elemento->foto;
    } else {
      $typeReplace = str_replace("image/", "", $_FILES["foto"]["type"]);
      $type =  $_FILES["foto"]["type"];
      $size =  $_FILES["foto"]["size"];
      $tmpname = $_FILES["foto"]["tmp_name"];
      $directory = "images";
      $name = 'images/'.$editID.'.'.$typeReplace;
  
      if(!file_exists('images')){
        mkdir('images',007,true);
        if(file_exists('images')){
             move_uploaded_file($tmpname,$name);
             $actualizarEstudiante->foto=$name;
        }
    }else{
        move_uploaded_file($tmpname,$name);
        $actualizarEstudiante->foto=$name;
    }
  }
}

  $estudiantes[$indexElemento] = $actualizarEstudiante;
  $_SESSION ['estudiantes'] = $estudiantes;
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
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="page-top">

  <?php $layout->mostrarHeader();?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido a la pantalla de edicion</h1>
      <p class="lead">Forma parte de la familia mas grande de profesionales</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Edicion del Estudiantes</h2>
          <p class="lead">Actualiza la informacion del estudiante seleccionado:</p>
          <form method="POST" enctype="multipart/form-data" action ="editar.php?ID=<?php echo $elemento->ID ?>">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nombre" class="lead">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Indroduza su nombre" value="<?php echo $elemento->nombre ?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="apellidos" class="lead">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Introduzca su apellido" value= "<?php echo $elemento->apellido?>" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="carrera" class="lead">Carrera</label>
                  <select id="carrera" name="carrera" class="form-control">

                      <?php foreach ($methods->carreras as $id => $texto) : ?>
                                        <?php if ($texto == $elemento->carrera) : ?>
                                            <option selected value="<?php echo $texto; ?>"><?php echo $texto; ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $texto; ?>"><?php echo $texto; ?></option>
                                        <?php endif; ?>

                     <?php endforeach; ?>
                  </select>
                 </div>

                 <div class="form-group col-md-12">
                      <label for="materiasFav">Materias Favoritas</label>
                      <textarea name="materiasFav" id="materiasFav" class="form-control" placeholder="Escriba las materias favoritas"> <?php echo $elemento->getMaterias()?> </textarea>
                      <small>Colocar las materias favoritas separados por comas</small>
                 
                 </div>

                 <div class=" form-group col-md-6">
                        <div class="form-group">

                            <label for="foto">Foto de perfil</label>
                            <input name="foto" type="file" class="form-control" id="foto" accept="image/*"/>

                        </div>
                    </div>

                 <div class="form-group col-md-7">
                
                 <label for="" class="lead"> Estado del estudiante</label>
                 <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="statusA" value="Activo"  <?php if($elemento->status=="Activo") echo "checked";?>>
                    <label class="form-check-label lead" for="statusA">
                      Activo
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="statusI" value="Inactivo"<?php if($elemento->status=="Inactivo") echo "checked";?>>
                    <label class="form-check-label lead" for="statusI">
                      Inactivo
                    </label>
                  </div>
                 </div>
                 
               </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

 <?php $layout->mostrarFooter(); ?>
 
	</body>
</html>