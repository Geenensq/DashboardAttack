
    $(document).ready(function(){
        $("#testjson").submit(function(){
            currentPassword = $(this).find("input[name=currentPassword]").val();
            newPassword = $(this).find("input[name=newPassword]").val();
            newPasswordConfirmation = $(this).find("input[name=newPasswordConfirmation]").val();
            url = $(this).attr("action");
            $.post(url , {currentPassword:currentPassword , newPassword:newPassword , newPasswordConfirmation:newPasswordConfirmation} , function(data){

                if(data.confirm == "success"){
                    
                    $("#panel").fadeOut();
                    PasswordSuccesChange();
                    $('#flip').removeAttr("disabled");
               
                } else if (data.errorPasswordConfirm == "error"){
                    
                    PasswordErrorConfirm();

                } else if (data.errorPasswordActuel == "error"){

                    PasswordError();
                }
                
            }, "json");

            return false;
        });
    });

