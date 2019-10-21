<?php

include 'helpers/layout.php';
include 'functions/methods.php';
require_once 'utilities/estudiantes.php';

$layout = new layout(false,false,false);
$method = new methods();

session_start();

/* Seccion Mostrar/Filtrar */
$_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();

$listaEstudiantes = $_SESSION['estudiantes'];

if(!empty($listaEstudiantes)){
     if(isset($_GET['Carrera']))
     {
      $listaEstudiantes = $method->filtro($listaEstudiantes,'carrera',$_GET['Carrera']);
     } 
}


if(isset($_GET['ID'])==true){

    $index = $_GET['ID'];

    unset($listaEstudiantes[$index]);

    $listaEstudiantes = array_values($listaEstudiantes);

    $_SESSION['estudiantes'] = $listaEstudiantes;

    header("Location:index.php");
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
  <link href="styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<script>
function confirmationDelete()
{
   var confirmation = confirm('Seguro que quiere eliminar a este estudiante?');
   if(confirmation==true){
    return true;
   }
     else{
       return false;
     }
}
</script>

</head>

<body id="page-top">
  
    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><i class="fa fa-id-card" aria-hidden="true"></i> ITLA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="utilities/guardar.php">Añadir</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Listado</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al listado de estudiantes</h1>
      <p class="lead">Forma parte de la familia mas grande de profesionales</p>
    </div>
  </header>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Listado de Estudiantes</h2>
          
          <div class="form-group col-md-12">
                  <label for="carrera" class="lead">Realizar Filtro</label>
                  <select id="carrera" name="carrera" class="form-control" onchange="location=this.value">
                  <?php if(empty($_GET["Carrera"])):?>
                    <option class="lead" value="index.php" selected>Todos</option>
                    <option class="lead" value="index.php?Carrera=Software" name="carrera">Software</option>
                    <option class="lead" value="index.php?Carrera=Multimedia" name="carrera">Multimedia</option>
                    <option class="lead" value="index.php?Carrera=Mecatronica" name="carrera">Mecatronica</a></option>
                    <option class="lead" value="index.php?Carrera=Seguridad" name="carrera">Seguridad</option>
                    <option class="lead" value="index.php?Carrera=Redes" name="carrera">Redes</option>
                   <?php else:?>
                    <option class="lead" value="index.php">Todos</option>
                    <option class="lead" value="index.php?Carrera=Software" name="carrera" <?php if($_GET["Carrera"]=="Software") echo "selected"?>>Software</option>
                    <option class="lead" value="index.php?Carrera=Multimedia" name="carrera" <?php if($_GET["Carrera"]=="Multimedia") echo "selected"?> >Multimedia</option>
                    <option class="lead" value="index.php?Carrera=Mecatronica" name="carrera" <?php if($_GET["Carrera"]=="Mecatronica") echo "selected"?> >Mecatronica</a></option>
                    <option class="lead" value="index.php?Carrera=Seguridad" name="carrera" <?php if($_GET["Carrera"]=="Seguridad") echo "selected"?> >Seguridad</option>
                    <option class="lead" value="index.php?Carrera=Redes" name="carrera" <?php if($_GET["Carrera"]=="Redes") echo "selected"?> >Redes</option>
                  <?php endif?>
                  </select>
                 </div>
          
          <table class="table table-striped table-dark">

          <?php if(empty($listaEstudiantes)):?>
          <thead>
    <tr>
      <th scope="col"><i class="fa fa-id-badge" aria-hidden="true"></i> ID</th>
      <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Nombre</th>
      <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Apellido</th>
      <th scope="col"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Carrea</th>
      <th scope="col"><i class="fa fa-bell" aria-hidden="true"></i><i class="fa fa-bell-slash" aria-hidden="true"></i> Status</th>
      <th scope="col"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</th>
    </tr>
  </thead>
  <tbody>
     <tr>
      <th colspan="6">No hay estudiantes registrados</th>
    </tr>

<?php else:?>

  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col"> Nombre</th>
      <th scope="col"> Apellido</th>
      <th scope="col"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Carrea</th>
      <th scope="col">Status</th>
      <th scope="col">Imagen</th>
      <th scope="col">Detalles</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach($listaEstudiantes as $estudiante): ?>
  <tr <?php if($estudiante->status =='Inactivo') echo "style='background-color:#B22222'";?>>
  
      <th scope="row"><?php echo $estudiante->ID?></th>
      <td><?php echo $estudiante->nombre?></td>
      <td><?php echo $estudiante->apellido?></td>
      <td><?php echo $estudiante->carrera?></td>
      <td><?php echo $estudiante->status?></td>
      <td style="text-align:center;"><img width="100px" height="90px" src="utilities/<?php echo $estudiante->foto?>"/></td>
      <td style="text-align:center;"><a href="utilities/detalles.php?ID=<?php echo $estudiante->ID?>" class="btn btn-sm btn-outline-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
      <td style="text-align:center;"><a href="utilities/editar.php?ID=<?php echo $estudiante->ID ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td style="text-align:center;"><a href="index.php?ID=<?php echo array_search($estudiante, $listaEstudiantes) ?>"class="btn btn-sm btn-outline-danger" onclick="return confirmationDelete()"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr>

<?php endforeach;?>
<?php endif;?>
  </tbody>
</table>
         
        </div>
      </div>
    </div>
  </section>
  
  <?php $layout->mostrarFooter();?>

</body>

</html>
