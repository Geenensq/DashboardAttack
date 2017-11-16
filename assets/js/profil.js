    
    $(document).ready(function(){
    $("#flip").click(function(){

        
        $("#panel").slideDown("slow");
        $(this).attr("disabled", true);

    });
    
    $("#cancelChange").click(function(){

    	$("#panel").fadeOut();
    	$('#flip').removeAttr("disabled");
    });




    });
