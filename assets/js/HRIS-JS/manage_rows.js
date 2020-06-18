    var exp_counter = 2;
    var edu_counter = 2;
    var dep_counter = 2;
    var job_counter = 2;
function add_exp_row(){
    if(exp_counter <=10){
        var newRow_exp = $("<tr>");
        var cols_exp = "";
        cols_exp += '<td><input class="md-input uk-text-upper" type="text" name="employer[]" placeholder="Firm/Office"/></td>';
        cols_exp += '<td><input class="md-input uk-text-upper" type="text" name="position[]" placeholder="Position"/></td>';
        cols_exp += '<td><input class="md-input uk-text-upper" type="text" name="exp_start_date[]" data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY"/></td>';
        cols_exp += '<td><input class="md-input uk-text-upper" type="text" name="exp_end_date[]" data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY"/></td>';
        cols_exp += '<td><input class="md-input uk-text-upper" type="text" name="exp_reason[]" placeholder="Reason For Leaving"/></td>';
        newRow_exp.append(cols_exp);
        $(".exp_table").append(newRow_exp);
        exp_counter++;
    }else{
        alert("Sorry, you've reached the maximum allowed inputs");
    }
        
}

function add_edu_row(){
    if(edu_counter <=10){
        var newRow_edu = $("<tr>");
        var cols_edu = "";
        cols_edu += '<td><input class="md-input uk-text-upper" type="text" name="school[]" placeholder="School Attended"/></td>';
        cols_edu += '<td><input class="md-input uk-text-upper" type="text" name="course[]" placeholder="Course Pursued"/></td>';
        cols_edu += '<td><input class="md-input uk-text-upper" type="text" name="degree[]" placeholder="Degree Earned"/></td>';
        cols_edu += '<td><input class="md-input uk-text-upper" type="text" name="yr_grad[]" data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY"/></td>';
        newRow_edu.append(cols_edu);
        $(".edu_table").append(newRow_edu);
        edu_counter++;
    }else{
        alert("Sorry, you've reached the maximum allowed inputs");
    }
        
}

function add_dep_row(){
    if(dep_counter <=10){
        var newRow_dep = $("<tr>");
        var cols_dep = "";
        cols_dep += '<td><input class="md-input uk-text-upper" type="text" name="dep_lname[]" placeholder="Last Name"/></td>';
        cols_dep += '<td><input class="md-input uk-text-upper" type="text" name="dep_fname[]" placeholder="First Name"/></td>';
        cols_dep += '<td><input class="md-input uk-text-upper" type="text" name="dep_mname[]" placeholder="Middle Name"> </td>';
        cols_dep += '<td><select class="md-input uk-text-upper data-md-selectize" name="dep_name_ext[]" ><option value="">&nbsp;</option><optgroup label="Name Ext"><option value="Jr">Jr</option><option value="Sr">Sr</option><option value="II">II</option><option value="III">III</option><option value="IV">IV</option><option value="V">V</option></optgroup></select></td>';
        cols_dep += '<td><input class="md-input uk-text-upper" type="text" name="dep_bdate[]" data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY"></td>';
        newRow_dep.append(cols_dep);
        $(".dep_table").append(newRow_dep);
        dep_counter++;
    }else{
        alert("Sorry, you've reached the maximum allowed inputs");
    }
}

function add_job_row(){
                $.ajax({
                    type: "POST",
                    url: base_url + "Get_Active_Position",
                    success: function (position) {
                        if (position) {
                            $.ajax({
                                type: "POST",
                                url: base_url + "Get_Active_Section",
                                success: function (section) {
                                    if (section) {
                                        if(job_counter <=10){
                                            var newRow_job = $("<tr>");
                                            var cols_job = "";
                                            cols_job += '<td><input class="md-input uk-text-upper uk-text-upper" type="text" name="emp_inclusive_startdate[]"  data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY" autocomplete="off"/></td>';
                                            cols_job += '<td><input class="md-input uk-text-upper uk-text-upper" type="text" name="emp_inclusive_enddate[]" data-uk-datepicker='+"{format:'MM/DD/YYYY'}"+' placeholder="MM/DD/YYYY" autocomplete="off"/></td>';
                                            cols_job += '<td><select id="select_job_position" class="md-input uk-text-upper" data-md-selectize name="emp_job_position[]">'+position+'</select></td>';
                                            cols_job += '<td><select id="select_job_status" class="md-input uk-text-upper" data-md-selectize name="emp_job_status[]"><option value="">Select Status</option><optgroup label="Employment Status"><option value="Job Order">Job Order</option><option value="Part Time">Part Time</option><option value="Casual">Casual</option><option value="Reliever">Reliever</option><option value="Outsource">Outsource</option><option value="Orientee">Orientee</option><option value="Contractual">Contractual</option> <option value="Probationary">Probationary</option><option value="Regular">Regular</option><option value="Resigned">Resigned</option><option value="Retired">Retired</option><option value="Volunteer">Volunteer</option></optgroup></select></td>';
                                            cols_job += '<td><select id="select_job_section" class="md-input uk-text-upper" data-md-selectize name="emp_job_section[]">'+section+'</select></td>';
                                            newRow_job.append(cols_job);
                                            $(".jobinfo_table").append(newRow_job);
                                            job_counter++;
                                        }else{
                                            UIkit.modal.alert('Sorry, you have reached the maximum allowed inputs!');
                                        }
                                    } else {
                                        UIkit.modal.alert('Error etting Section!');
                                    }
                                }
                            });
                        } else {
                            UIkit.modal.alert('Error Getting Position!');
                        }
                    }
                });
}
function rm_exp_row(){
    
        var tbl = document.getElementById('experience_table');
        var lastRow = tbl.rows.length;
        if (lastRow > 3) tbl.deleteRow(lastRow - 2);
        exp_counter -= 1;
}

function rm_edu_row(){
    var tbl = document.getElementById('education_table');
    var lastRow = tbl.rows.length;
    if (lastRow > 3) tbl.deleteRow(lastRow - 2);
    edu_counter -= 1;
}

function rm_dep_row(){
        var tbl = document.getElementById('dependents_table');
        var lastRow = tbl.rows.length;
        if (lastRow > 3) tbl.deleteRow(lastRow - 2);
        dep_counter -= 1;
}

function rm_job_row(){
    var tbl = document.getElementById('job_info_table');
    var lastRow = tbl.rows.length;
    if (lastRow > 3) tbl.deleteRow(lastRow - 2);
    job_counter -= 1;
}