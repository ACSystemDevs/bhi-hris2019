function  confirm_save_changes(user_id){
    UIkit.modal.confirm('Are you sure to save this changes?', 
    function(){
      $.ajax({
        url: base_url + "Update-UserAccount/" +  user_id ,
        type: "POST",
        success: function(data){
              modal = UIkit.modal.blockUI('Changes has been made!');
              setTimeout(function(){ modal.hide(location.reload()) }, 2500)();
            },
            error: function(jqXHR, textStatus, errorThrown){
              UIkit.modal.alert('Error on Approving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
                location.reload();
              });
            }
          });
    },{
      labels: {'Ok': 'Yes'}
    });
}