var view_modal = UIkit.modal("#view_request_modal");
var approve_modal = UIkit.modal("#approve_modal");
var disapprove_modal = UIkit.modal("#disapprove_modal");
var add_leave_modal = UIkit.modal('#add_leave_modal');
var edit_leave_modal = UIkit.modal('#edit_leave_modal');
var add_time_att_modal = UIkit.modal('#add_time_att_modal');
function formatDate(date) {
    var monthNames = [
      "January", "February", "March",
      "April", "May", "June", "July",
      "August", "September", "October",
      "November", "December"
    ];
  
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
  
    return  monthNames[monthIndex]+ ' '  + day  + ', ' + year;
  }

function modal_view_leave_details(department_id){
    $.ajax({
    url: base_url + "View_Leave_Request_byID/" +  department_id ,
    type: "GET",
    dataType: "JSON",
    success: function(data){
        var no_data = 'No Data Provided';
        var date_filed = formatDate(new Date(data.Leave_Date_Filed));
        var inclusive_date = formatDate(new Date(data.Leave_Date_Start))+' to ' +formatDate(new Date(data.Leave_Date_End));
        var emp_wname = data.emp_LName +', '+ data.emp_FName+' '+ data.emp_MName.substr(0,1)+'.';
        $('#ajax_date_filed').text(date_filed);
        $('#ajax_emp_wname').text(emp_wname);
        $('#ajax_inclusive_date').text(inclusive_date);
        $('#ajax_no_of_days').text(data.Leave_no_days);
        if(!data.Leave_Address){
          $('#ajax_leave_address').text(no_data);
        }else{
          $('#ajax_leave_address').text(data.Leave_Address);
        }
        if(!data.Leave_Reason){
          $('#ajax_leave_reason').text(no_data);
        }else{
          $('#ajax_leave_reason').text(data.Leave_Reason);
        }

        if(data.Leave_Status == 'Pending'){
          var leave_status = 'Pending';
        }else if(data.Leave_Status == 'Recommended'){
          var leave_status = 'Recommended';
        }else if(data.Leave_Status == 'Approved'){
          var leave_status = 'Approved';
        }else if(data.Leave_Status == 'Noted'){
          var leave_status = 'Noted';
        }else if(data.Leave_Status == 'Disapproved_Head'){
          var leave_status = 'Disapproved by Supervisor';
        }else if(data.Leave_Status == 'Disapproved_HR'){
          var leave_status = 'Disapproved by HR';
        }else if(data.Leave_Status == 'Disapproved_Pres'){
          var leave_status = 'Disapproved by President';
        }
        $('#ajax_leave_status').text(leave_status);
        view_modal.show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          UIkit.modal.alert('Error Getting Data!');
        }
      });
}

function modal_leave_approve(request_id, employee_code, leave_id){
  UIkit.modal.confirm('Are you sure you want to Approve this leave?', 
  function(){
    $.ajax({
      url: base_url + "Admin_Approve_Leave_Request_byID/" +  request_id + "/" + employee_code + "/" + leave_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Approved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Approving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Approve'}
  });
}

function modal_leave_disapprove_noted(request_id, employee_code, leave_id){
  UIkit.modal.confirm('Are you sure you want to Disapprove this leave? ', 
  function(){
    $.ajax({
      url: base_url + "Admin_Disapprove_Noted_Leave_Request_byID/" +  request_id + "/" + employee_code + "/" + leave_id ,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Dispproved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Disapproving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Disapprove'}
  });
}
function modal_leave_disapprove(request_id){
  UIkit.modal.confirm('Are you sure you want to Disapprove this leave? ', 
  function(){
    $.ajax({
      url: base_url + "Admin_Disapprove_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Dispproved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Disapproving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Disapprove'}
  });
}
function modal_prompt_add_leave(){
        add_leave_modal.show();
}

function modal_prompt_edit_leave(emp_leave_ID){
  
  $.ajax({
  url: base_url + "View_Leave_Credit_byID/" +  emp_leave_ID,
  type: "GET",
  dataType: "JSON",
  success: function(data){
    console.log(data);
    $('[name="edit_leave_type"]').val(data.leave_type);
    $('[name="edit_leave_days"]').val(data.emp_leave_credit);
    $('[name="edit_leave_year"]').val(data.credit_year);
    $('[name="emp_leave_id"]').val(data.PK_emp_leave_ID);
    $('[name="days_consumed"]').val(data.days_consumed);
    $('[name="remaining_days"]').val(data.remaining_days);
    edit_leave_modal.show();
      },
      error: function(jqXHR, textStatus, errorThrown){
        UIkit.modal.alert('Error Getting Data!');
      }
    });
}

function modal_leave_approve_section(request_id){
  UIkit.modal.confirm('Are you sure you want to Approve this leave?', 
  function(){
    $.ajax({
      url: base_url + "Section_Approve_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Approved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Approving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Approve'}
  });
}
function modal_leave_disapprove_section(request_id){
  UIkit.modal.confirm('Are you sure you want to Disapprove this leave? ', 
  function(){
    $.ajax({
      url: base_url + "Section_Disapprove_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Dispproved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Disapproving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Disapprove'}
  });
}
function modal_leave_approve_hr(request_id){
  UIkit.modal.confirm('Are you sure you want to Approve this leave?', 
  function(){
    $.ajax({
      url: base_url + "HR_Approve_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Approved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Approving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Approve'}
  });
}
function modal_leave_disapprove_hr(request_id){
  UIkit.modal.confirm('Are you sure you want to Disapprove this leave? ', 
  function(){
    $.ajax({
      url: base_url + "HR_Disapprove_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Dispproved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Disapproving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Disapprove'}
  });
}

function modal_leave_approve_oic(request_id){
  UIkit.modal.confirm('Are you sure you want to Approve this leave?', 
  function(){
    $.ajax({
      url: base_url + "OIC_Approve_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Approved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Approving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Approve'}
  });
}
function modal_leave_disapprove_oic(request_id){
  UIkit.modal.confirm('Are you sure you want to Disapprove this leave? ', 
  function(){
    $.ajax({
      url: base_url + "OIC_Disapprove_Leave_Request_byID/" +  request_id,
      type: "POST",
      success: function(data){
            modal = UIkit.modal.blockUI('Leave Request Dispproved!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Disapproving Leave! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Disapprove'}
  });
}

function add_time_att(){
  add_time_att_modal.show();
}

function save_time_att(employee_code){
  UIkit.modal.confirm('Are you sure you want to Add new record? ',
  function(){
    var form = $('#att_new_record_form');
    $.ajax({
      url: base_url + "Create-New-Attendance-Record/" +  employee_code,
      type: "POST",
      data: form,
      success: function(data){
            modal = UIkit.modal.blockUI('Record Added!');
            setTimeout(function(){ modal.hide(location.reload()) }, 1500)();
          },
          error: function(jqXHR, textStatus, errorThrown){
            UIkit.modal.alert('Error on Adding Record! Please try again sometime or call MIS.',{labels: {'Ok': 'Close'}}).on('hide.uk.modal', function() {
              location.reload();
            });
          }
        });
  },{
    labels: {'Ok': 'Proceed'}
  });
}