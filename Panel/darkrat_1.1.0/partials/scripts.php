  <!-- JavaScript files-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/popper.js/umd/popper.min.js"> </script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="assets/vendor/chart.js/Chart.min.js"></script>
  <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="assets/js/jquery.tablesorter.min.js"></script>
  <!--    <script src="assets/js/charts-home.js"></script>-->
  <script src="assets/js/front.js"></script> 
  <script src="assets/js/table.js"></script> 
  <script src="assets/js/datatables.js"></script> 
  <script src="assets/js/toastr.min.js"></script> 
  <script src="assets/js/base64js.min.js"></script> 
  <script   src="assets/ThirdParty/jquery-ui-min.js"  ></script>
  <script type="text/javascript" src="assets/ThirdParty/jsonFormer/jsonFormer.jquery.js"></script>
  <script src="assets/jqvmap/jquery.vmap.js"></script>
  <script src="assets/jqvmap/jquery.vmap.world.js"></script>


  <?php

    if(isset($_GET["p"])){
      if(file_exists("pages/".$_GET["p"].".php")){
          include('assets/darkrat/'.$_GET["p"].'.php');
      }
    }else{
      include("assets/darkrat/dashboard.php");
    }

  ?>


  </body>
</html>