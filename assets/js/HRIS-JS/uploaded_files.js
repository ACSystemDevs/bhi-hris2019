var view_file_modal_image =  UIkit.modal('#view_uploaded_file_image');
var view_file_modal_pdf = UIkit.modal('#view_uploaded_file_pdf');

function uploaded_file_view_pdf(files_id){
    $.ajax({
    url: base_url + "Get_Uploaded_File_Details/" +  files_id ,
    type: "GET",
    dataType: "JSON",
    success: function(data){
        console.log(data);
        var file_source = base_url + data.File_path;
        $('#uploaded_file_pdf').prop('src',file_source );
        view_file_modal_pdf.show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          UIkit.modal.alert('Error Getting Data!');
        }
      });
}

function uploaded_file_view_img(files_id){
  $.ajax({
  url: base_url + "Get_Uploaded_File_Details/" +  files_id ,
  type: "GET",
  dataType: "JSON",
  success: function(data){
      console.log(data);
      var file_source = base_url + data.File_path;
      $('#uploaded_file_img').prop('src',file_source );
      $('#uploaded_short_desc').text(data.Description);
      view_file_modal_image.show();
      },
      error: function(jqXHR, textStatus, errorThrown){
        UIkit.modal.alert('Error Getting Data!');
      }
    });
}