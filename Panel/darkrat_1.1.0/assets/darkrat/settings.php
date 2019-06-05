<script>

function dataToForm(type,SpawntoID,data){
    var div = document.createElement("div");
    div.setAttribute('id', 'created-spiderform-'+data.id);
    $(SpawntoID).append(div);
    $('#created-spiderform-'+data.id).jsonFormer({
        type: type,
        id: data.id,
        title: "Settings",
        jsonObject: data
    });
}


$("#updateAlgo").on('change', function () {
    $("#form-mining_algorithm").val($("#updateAlgo").val());
});

$(document).on('click', '.submitspiderform', function () {
    var id = $(this).attr('id');
    var form_data = $("."+id).serialize(); //Encode form elements for submission
    
	$.ajax({
		url : "<?php echo $APIURL;?>?edit="+$("."+id).data("spiderapitype")+"&username=<?php echo $USERNAME;?>",
        type: "POST",
        dataType: "json",
		data : form_data,
	}).done(function(response){ //
        console.log(response);
        toastr.success('Settings Updated!', response.message);
	}).fail(function(response){
        toastr.warning('Fuck We have a Error!');
    });
});

function MiningAlgoSelect(){
    $("#form-mining_algorithm").hide();
    var current = $("#form-mining_algorithm").val();
    $("#form-mining_algorithm").after( "<select id='updateAlgo'> <option value='cryptonight'>Cryptonight V2 (default) </option><option value='cryptonight-light'>Cryptonight- Light </option></select>"); 
}



$(function () {

            $.post('<?php echo $APIURL;?>?get=settings&username=<?php echo $USERNAME;?>', function(data) {
                //console.log(data.records[0]);
                dataToForm("settings","#settings",data.records[0]);
               // MiningAlgoSelect();
            });


});

</script>