<script>



var barOptions_stacked = {
    tooltips: {
        enabled: false
    },
    hover :{
        animationDuration:0
    },
    scales: {
        xAxes: [{
            ticks: {
                beginAtZero:true,
                fontFamily: "'Muli', sans-serif",
                fontSize:11
            },
            scaleLabel:{
                display:false
            },
            gridLines: {
            }, 
            stacked: true
        }],
        yAxes: [{
            gridLines: {
                display:false,
                color: "#623c9b",
                zeroLineColor: "#2c054c",
                zeroLineWidth: 0
            },
            ticks: {
                fontFamily: "'Muli', sans-serif",
                fontSize:11
            },
            stacked: true
        }]
    },
    legend:{
        display:false
    },
    
    animation: {
        onComplete: function () {
            var chartInstance = this.chart;
            var ctx = chartInstance.ctx;
            ctx.textAlign = "left";
            ctx.font = "9px Muli";
            ctx.fillStyle = "#fff";

            Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                Chart.helpers.each(meta.data.forEach(function (bar, index) {
                    data = dataset.data[index];
                    if(i==0){
                        ctx.fillText(data, 50, bar._model.y+4);
                    } else {
                        ctx.fillText(data, bar._model.x-25, bar._model.y+4);
                    }
                }),this)
            }),this);
        }
    },
    pointLabelFontFamily : "Quadon Extra Bold",
    scaleFontFamily : "Quadon Extra Bold",
};


function calculate(pointspossible,pointsgiven){
        var pPos = parseInt(pointspossible); 
        var pEarned = parseInt(pointsgiven);
        var perc="";
        if(isNaN(pPos) || isNaN(pEarned)){
            perc=" ";
        }else{
        perc = ((pEarned/pPos) * 100).toFixed(3);
        }

       return perc;
    }


    $.ajax({url: "<?php echo  $APIURL;?>?get=botstats&username=<?php echo $USERNAME;?>", success: function(result){
      //console.log(result);
      $(".dashtext-1").html(result.online);
      $(".dashtext-2").html(result.total- result.online);
      $(".dashtext-3").html(result.dead);
      $(".dashtext-4").html(result.total);


      $(".dashbg-1").width(calculate(result.total,result.online)+"%");
      $(".dashbg-2").width(calculate(result.total,result.total- result.online)+"%");
      $(".dashbg-3").width(calculate(result.total,result.dead)+"%");
      $(".dashbg-4").width(calculate(result.total,result.total)+"%");
      //console.log(calculate(result.total,result.total));






        //Privileges
        var ctx = document.getElementById("barChartPrivileges");
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["User","Admin"],
                
                datasets: [{
                    data: [result.botPrivileges.User, result.botPrivileges.Admin],
                    backgroundColor: "#623c9b",
                    hoverBackgroundColor: "rgb(68, 7, 117)"
                }]
            },
            options: barOptions_stacked,
        });
        //System Chart
            var PIECHARTEXMPLE    = $('#systemPieChart');
            var pieChartExample = new Chart(PIECHARTEXMPLE, {
                type: 'pie',
                options: {
                    legend: {
                        display: true,
                        position: "left"
                    }
                },
                data: {
                    labels: [
                        result.top5operatingsystems[0].system,
                        result.top5operatingsystems[1].system,
                        result.top5operatingsystems[2].system,
                        result.top5operatingsystems[3].system,
                        result.top5operatingsystems[4].system,
                    ],
                    datasets: [
                        {
                            data: [
                                result.top5operatingsystems[0].count,
                                result.top5operatingsystems[1].count,
                                result.top5operatingsystems[2].count,
                                result.top5operatingsystems[3].count,
                                result.top5operatingsystems[4].count,
                             ],
                            borderWidth: 0,
                            backgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ],
                            hoverBackgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ]
                        }]
                    }
            });
            var pieChartExample = {
                responsive: true
            };
        //Country Chart
            var PIECHARTEXMPLE    = $('#countryPieChart');
            var pieChartExample = new Chart(PIECHARTEXMPLE, {
                type: 'pie',
                options: {
                    legend: {
                        display: true,
                        position: "left"
                    }
                },
                data: {
                    labels: [
                        result.top5countries[0].counrty,
                        result.top5countries[1].counrty,
                        result.top5countries[2].counrty,
                        result.top5countries[3].counrty,
                        result.top5countries[4].counrty,
                    ],
                    datasets: [
                        {
                            data: [
                                result.top5countries[0].count,
                                result.top5countries[1].count,
                                result.top5countries[2].count,
                                result.top5countries[3].count,
                                result.top5countries[4].count,
                             ],
                            borderWidth: 0,
                            backgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ],
                            hoverBackgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ]
                        }]
                    }
            });
            var pieChartExample = {
                responsive: true
            };
        //GPU Chart
        var PIECHARTEXMPLE1    = $('#gpubrandsPieChart');
            var pieChartExample = new Chart(PIECHARTEXMPLE1, {
                type: 'pie',
                options: {
                    legend: {
                        display: true,
                        position: "left"
                    }
                },
                data: {
                    labels: [
                        "AMD",
                        "NVIDIA",
                        "ONBOARD"
                    ],
                    datasets: [
                        {
                            data: [
                                result.gpuBrands["AMD"],
                                result.gpuBrands["NVIDIA"],
                                result.gpuBrands["ONBOARD"],
                             ],
                            borderWidth: 0,
                            backgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ],
                            hoverBackgroundColor: [
                                '#723ac3',
                                "#864DD9",
                                "#9762e6",
                                "#a678eb",
                                "#623c9b",
                            ]
                        }]
                    }
            });
            var pieChartExample = {
                responsive: true
            };
    
    }});





var gdpData;
$.get( "<?php echo  $APIURL;?>?get=wordmap&username=<?php echo $USERNAME;?>")
  .done(function( data ) {
     gdpData =  data;
     
  var max = 0,
        min = Number.MAX_VALUE,
        cc,
        startColor = [255, 199, 248],
        endColor = [75, 2, 107],
        colors = {},
        hex;

    //find maximum and minimum values
    for (cc in gdpData)
    {
        if (parseFloat(gdpData[cc]) > max)
        {
            max = parseFloat(gdpData[cc]);
        }
        if (parseFloat(gdpData[cc]) < min)
        {
            min = parseFloat(gdpData[cc]);
        }
    }

    //set colors according to values of GDP
    for (cc in gdpData)
    {
        if (gdpData[cc] > 0)
        {
            colors[cc] = '#';
            for (var i = 0; i<3; i++)
            {
                hex = Math.round(startColor[i]
                    + (endColor[i]
                    - startColor[i])
                    * (gdpData[cc] / (max - min))).toString(16);

                if (hex.length == 1)
                {
                    hex = '0'+hex;
                }

                colors[cc] += (hex.length == 1 ? '0' : '') + hex;
            }
        }
    }
    
    //initialize JQVMap
    jQuery('#vmap').vectorMap(
    {
        colors: colors,
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: "transparent",
        onLabelShow: function (event, label, code) {
                    if(gdpData[code] == null){
                        gdpData[code] = 0;
                    }
                    label.append("<br>"+gdpData[code]+' Total');
        },
    });
  });







  
    

</script>
