<?php

class layout

{
    private $validation;
    private $directory; 
    private $detalles;
    function __construct($isPage,$validation,$details)
    {
        $this->directory = ($isPage) ? "../" : "";
        $this->validation = ($validation) ? "guardar.php" : "#about";
        $this->detalles = $details;
    }

    function validationPag(){
      
      $detal= $this->detalles;
      $pagina;

      if(isset($_GET['ID']) && $detal==false) {
        
        $pagina = "Editar";
        
      }else{
        $pagina = "Añadir";
      }  

      if($detal==true){
        $pagina = "Detalles";
      }

      return $pagina;

    }


    public function mostrarHeader(){

        $header=<<<EOF
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
                  <a class="nav-link js-scroll-trigger" href="../index.php">Volver al listado</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="{$this->validation}">{$this->validationPag()}</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
EOF;

      echo $header;

    }

    public function mostrarFooter(){

        $footer = <<<EOF
        <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{$this->directory} styles/vendor/jquery/jquery.min.js"></script>
<script src="{$this->directory} styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="{$this->directory} styles/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="{$this->directory} styles/js/scrolling-nav.js"></script>

EOF;

   echo $footer;


    }




}


















?>
