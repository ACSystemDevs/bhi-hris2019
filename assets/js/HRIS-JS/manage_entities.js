function edit_department(department_id){
    $.ajax({
    url: base_url + "Get_Department_Info_byID/" +  department_id ,
    type: "GET",
    dataType: "JSON",
    success: function(data){
        console.log(data);
        document.getElementById("edit_department_form").action = base_url + "Edit-Department-Function/" + department_id;
        document.getElementById("add_department_div").style.display = "none";
        document.getElementById("edit_department_div").style.display = "block";
        $('[name="edit_form_department_name"]').val(data.department_name);
        },
        error: function(jqXHR, textStatus, errorThrown){
          UIkit.modal.alert('Error Getting Data!');
        }
      });
}

function edit_section(section_id){
  $.ajax({
  url: base_url + "Get_Section_Info_byID/" +  section_id ,
  type: "GET",
  dataType: "JSON",
  success: function(data){
      console.log(data);
      document.getElementById("edit_form_section").action = base_url + "Edit-Section-Function/" + section_id;
      document.getElementById("add_section_div").style.display = "none";
      document.getElementById("edit_section_div").style.display = "block";
      $('[name="edit_form_section_name"]').val(data.section_name);
      },
      error: function(jqXHR, textStatus, errorThrown){
        UIkit.modal.alert('Error Getting Data!');
      }
    });
}

function edit_position(position_id){
  $.ajax({
  url: base_url + "Get_Position_Info_byID/" +  position_id ,
  type: "GET",
  dataType: "JSON",
  success: function(data){
      console.log(data);
      document.getElementById("form_edit_position").action = base_url + "Edit-Position-Function/" + position_id;
      document.getElementById("add_position_div").style.display = "none";
      document.getElementById("edit_position_div").style.display = "block";
      $('[name="edit_form_position_name"]').val(data.job_name);
      },
      error: function(jqXHR, textStatus, errorThrown){
        UIkit.modal.alert('Error Getting Data!');
      }
    });
}