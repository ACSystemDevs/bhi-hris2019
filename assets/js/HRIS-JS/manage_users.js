
var manage_account_modal = UIkit.modal('#manage_user_account_admin');
var modify_password_modal = UIkit.modal('#modify_password_admin');
function modal_manage_user_account(user_id){
    $.ajax({
        url: base_url + "Get_UserAccount_Info_byID/" +  user_id ,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="modal_form_user_id"]').val(data.PK_user_ID);
            $('[name="modal_form_username"]').val(data.Username);
            manage_account_modal.show();
            },  
            error: function(jqXHR, textStatus, errorThrown){
              UIkit.modal.alert('Error Getting Data!');
            }
          });
}
function modal_modify_password(user_id){
    $.ajax({
        url: base_url + "Get_UserAccount_Info_byID/" +  user_id ,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="modal_form_user_id"]').val(data.PK_user_ID);
            $('[name="modal_form_username"]').val(data.Username);
            modify_password_modal.show();
            },
            error: function(jqXHR, textStatus, errorThrown){
              UIkit.modal.alert('Error Getting Data!');
            }
          });
}
function modal_mark_inactive(user_id){
    UIkit.modal.confirm('Are you sure you want to Deactivate this Account?', 
    function(){
      $.ajax({
        url: base_url + "Change_Account_Status_Inactive/" +  user_id,
        type: "POST",
        success: function(data){
              modal = UIkit.modal.blockUI('Account is now Inactive!');
              setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
            },
            error: function(jqXHR, textStatus, errorThrown){
              UIkit.modal.alert('Error on Approving Leave! Please try again sometime.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
                location.reload();
              });
            }
          });
    },{
      labels: {'Ok': 'Deactivate'}
    });
  }
function modal_mark_active(user_id){
    UIkit.modal.confirm('Are you sure you want to Activate this Account?', 
    function(){
      $.ajax({
        url: base_url + "Change_Account_Status_Active/" +  user_id,
        success: function(data){
              modal = UIkit.modal.blockUI('Account is now Active!');
              setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
            },
            error: function(jqXHR, textStatus, errorThrown){
              UIkit.modal.alert('Error on Approving Leave! Please try again sometime.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
                location.reload();
              });
            }
          });
    },{
      labels: {'Ok': 'Activate'}
    });
  }
