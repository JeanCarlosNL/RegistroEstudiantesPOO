<?php 
include '../functions/methods.php';
include '../helpers/layout.php';
require_once 'estudiantes.php';

$layout = new layout(true,false,true);
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

  $actualizarEstudiante = new estudiante($_GET['ID'], $_POST['nombre'], $_POST['apellidos'], $_POST['carrera'],$materias,$_POST['status'], );

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
      <h1>Bienvenido a los detalles de estudiantes</h1>
      <p class="lead">Forma parte de la familia mas grande de profesionales</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Detalles del estudiante <?php echo $elemento->nombre;?></h2>
            <div class="card" style="width: 21rem;">
               <div class="card-body">
               <img width="250px" height="250px" src="<?php echo $elemento->foto;?>"/>
               </div>
               <hr>
            
                <div class="card-body">
                    <h5 class="card-title">Nombre y Apellido</h5>
                    <p class="card-text"><?php echo $elemento->nombre,' ', $elemento->apellido;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Estatus actual</h5>
                    <p class="card-text"><?php echo $elemento->status;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Carrera</h5>
                    <p class="card-text"><?php echo $elemento->carrera;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Materias Favoritas</h5>
                    <p class="card-text"><?php echo $elemento->getMaterias()?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <a href="editar.php?ID=<?php echo $elemento->ID ?>" class="card-link">Editar al estudiante</a>
                </div>
             </div>  
          
        </div>
      </div>
    </div>
  </section>

 <?php $layout->mostrarFooter(); ?>
 
	</body>
</html>