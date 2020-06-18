<div id="page_content">
    <div id="page_content_inner">
        <h4 class="heading_a uk-margin-bottom">Department Management</h4>
        <div class="uk-grid">
            <div class="uk-width-medium-6-10">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">fullscreen</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                List of Departments
                            </h3>
                    </div>
                    <div class="md-card-content">
                        <table id="dt_scroll" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Department Head</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Department Head</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                    foreach($department as $dept){
                                        $head_wname = $dept->emp_LName.',&nbsp;'.$dept->emp_FName.'&nbsp;'.$dept->emp_MName.'&nbsp;'.$dept->emp_NameExt;
                                        echo    '<tr>
                                                    <td>
                                                        '.$dept->department_name.'
                                                    </td>
                                                    <td>
                                                        '.$head_wname.'
                                                    </td>
                                                    <td>
                                                        <button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="EDIT DEPARTMENT" onclick="edit_department(' . "'" . $dept->PK_department_ID . "'" . ')""><i class="material-icons md-color-grey-50 md-24">edit</i></button>
                                                    </td>
                                                </tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-4-10" id="add_department_div" style="display:block;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Add Department
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form method="POST" action="<?php echo base_url();?>Add-Department-Function">
                            <div class="uk-form-row">
                                <div class="uk-form-row">
                                    <label>Department Name</label>
                                    <input type="text" class="md-input uk-text-upper" name="form_department_name" autocomplete="off" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Department Head</label>
                                    <select id="select_department_head" data-md-selectize name="form_department_head_ID">
                                        <option value="">Select Department Head...</option>
                                        <?php
                                                        foreach($active_employee as $employee){
                                                            $emp_wname = $employee->emp_LName.',&nbsp;'.$employee->emp_FName.' '.$employee->emp_MName.' '.$employee->emp_NameExt;
                                                            echo '<option value="'.$employee->PK_employee_code.'">'.$emp_wname.'</option>';
                                                        }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">ADD DEPARTMENT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-4-10" id="edit_department_div" style="display:none;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Update Department
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form method="POST" id="edit_department_form">
                            <div class="uk-form-row">
                                <label>Department Name</label>
                                <div class="uk-form-row">
                                    <input type="text" class="md-input uk-text-upper" name="edit_form_department_name" id=" "/>
                                </div>
                                <div class="uk-form-row">
                                    <label>Department Head</label>
                                    <select id="select_department_head" data-md-selectize name="edit_form_department_head_ID" id="edit_dept_head">
                                        <option value="">Select Department Head...</option>
                                        <?php
                                                        foreach($active_employee as $employee){
                                                            $emp_wname = $employee->emp_LName.',&nbsp;'.$employee->emp_FName.' '.$employee->emp_MName.' '.$employee->emp_NameExt;
                                                            echo '<option value="'.$employee->PK_employee_code.'">'.$emp_wname.'</option>';
                                                        }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">UPDATE DEPARTMENT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>