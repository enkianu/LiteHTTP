<script>

$(function () {
    getLogs();
});

function getLogs(){
    $.post('<?php echo $APIURL;?>?get=plogs', function(data) {
        buildTable(data.records,["id","ipaddress","username","action","date"]);
        buildLogs(data.records);
    });
}
function clearLogs(){
    $.post('<?php echo $APIURL;?>?edit=clearlogs&username=<?php echo $USERNAME;?>', function(data) {
        toastr.success('Logs Cleared');
        setTimeout(function(){     $("#table tbody").empty() }, 500);
    
    });
}

function buildTable(data,showItems){
    var tbody = $("<tbody />"),tr;
    $.each(data,function(_,obj) {
        tr = $("<tr />");
        $.each(obj,function(_,text) {
            console.log(_);
            console.log(showItems);
            if(showItems.indexOf(_) != -1){
                if(_ == "date"){
                    tr.append("<td>"+timeSince(obj.date)+"</td>")        
               }else{
                    tr.append("<td>"+text+"</td>")        
                }
            }
        
        });
        tr.appendTo(tbody);
    });
    tbody.appendTo("#table"); // only DOM insertion   
}


function buildLogs(data){
    var tbody = $("<div class='main-timeline' />"),tr;
    $.each(data,function(_,obj) {
       
        console.log( obj.username);
        tr = $(' <a href="#" class="timeline"> <!-- <div class="timeline-icon"> \
        <i class="fa fa-cloud"></i>\
        </div> --> \
        <div class="timeline-content"> <h3 class="title">'+obj.username+'</h3> \
        <p class="description"> User: '+obj.username+'       <br> '+obj.action+'  <br> '+timeSince(obj.date)+' ago</p>\
         </div> </a>')        
        tr.appendTo(tbody);
    });
    tbody.appendTo("#timeline"); // only DOM insertion   
}

</script>


