$(document).ready(function(){
	$('#upload_img_btn').on('click', function(e){
		// e.preventDefault();
		$('#upload_files2').trigger('click');  
		// return false;
	});
});
function incorrect(){
	var duration = 80;
	var offset = 30;
	// var mLeft = $('#logbox').css('marginLeft');
	$('#logbox').css('position','relative');
	$('#logbox').animate({left:('-='+ offset)}, duration,function(){
	   $(this).animate({left:('+=' + offset*2)}, duration, function(){
		  $(this).animate({left:('-=' + offset*2)}, duration, function(){
			   $(this).animate({left:('+='+ offset*2)}, duration, function(){
				   $(this).animate({left:('-='+ offset*2)}, duration, function(){
					   $(this).animate({left:('+='+ offset)}, duration);
				   });
			   });
		  });
	   });
	});
	// alert();
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function (e) {
			$('#profile_img').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

function clearData(){
	var parent = $("#addMpvrForm");
	parent.find("#quantxt").val(0);
	parent.find("#desigtxt").val("");
	parent.find("#ratetxt").val("");
	parent.find("#ventxt").val("");
	parent.find("#destxt").val("");
}

function addRecord(input){
	var parent = $(input).parents("#addMpvrForm");
	var quantxt = parent.find("#quantxt").val();
	var desigtxt = parent.find("#desigtxt").val();
	var ratetxt = parent.find("#ratetxt").val();
	var ventxt = parent.find("#ventxt").val();
	var destxt = parent.find("#destxt").val();
	var errBox = parent.find("#errBox");
	$(errBox).hide();
	// if(quantxt == "") && desigtxt == "" && ratetxt == "" && ventxt == ""){
	if((quantxt == "") || (desigtxt == "") || (ratetxt == "") || (ventxt == "") || (destxt == "")){
		$(errBox).show();
	}else{
		$('#addMpvrForm').foundation('reveal', 'close');	
		
		var $row = jQuery('#mpvrTbl tbody tr:first-child');
		var $columns = $row.find('td');
		var countColumn = 0;

		jQuery.each($columns, function(i, item) {
			countColumn++;
		});
		if(countColumn == 1){
			$("#mpvrTbl > tbody").empty();
		}
		$('#mpvrTbl > tbody:last-child').append("<tr><td>"+quantxt+"</td>"+
												"<td>"+desigtxt+"</td>"+
												"<td>"+destxt+"</td>"+
												"<td>"+ratetxt+"</td>"+
												"<td>"+ventxt+"</td>"+
												"</tr>");
	}	
}

function saveMpvrRecord(input){
	var parent = $(input).parents("#mpvrForm");
	var mForm = $('#mpvrFormInput').serialize();
	// alert(mForm);
}