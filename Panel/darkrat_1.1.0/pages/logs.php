


<div class="page-content" style="padding-bottom: 70px;">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">All Bots</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="?p=dashboard">DarkRat</a></li>
            <li class="breadcrumb-item active">All Logs  </li>
          </ul>
        </div>



        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xs-24">
                <div class="btn-group" role="group" aria-label="Basic example">
                          <button onclick="clearLogs();" type="button" style="background: #9055A2;" class="btn btn-secondary">Clear Logs</button>
                          </div>
                          <hr>


                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab"  class="btn btn-secondary" href="#home">Log Timeline</a></li>
                        <li><a data-toggle="tab" class="btn btn-secondary" href="#menu1" class="active show">Log Table</a></li>

                      </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade  ">
                          <div id="timeline" class="col-md-12">

                          </div>
                        </div>
                        <div id="menu1" class="tab-pane fade in active show">
                 

                          <div class="table-responsive"> 
                              <table id="table" class="table table-striped table-sm tablesorter">
                                  <thead>
                                      <tr>
                                          <th >#</th>
                                          <th>USER</th>
                                          <th>IP</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                              </table>
                          </div>
                        </div>
             
                
                      </div>




                </div>






              </div>
            </div>
          </div>
        </section>





            </div>
