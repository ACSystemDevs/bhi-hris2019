function sync_records(){
    UIkit.modal.confirm('Are you sure you want to sync records at this time?', 
  function(){
    $.ajax({
      url: base_url + "Terminal-to-HRMIS-Sync/",
      type: "POST",
      success: function(){
            // modal = UIkit.modal.blockUI('Sync Successful!');
            // setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('An Error occured while syncing records!',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Sync Now'}
  });
}

function sync_time_terminal(){
  UIkit.modal.confirm('Are you sure you want to sync current time to Terminal', 
  function(){
    $.ajax({
      url: base_url + "Terminal-Time-Sync/",
      type: "POST",
      success: function(){
            modal = UIkit.modal.blockUI('Sync Successful!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('An Error occured while syncing records!',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Sync Now'}
  });
}