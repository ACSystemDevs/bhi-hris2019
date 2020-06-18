<div id="page_content">
    <div id="page_content_inner">
        <h4 class="heading_a uk-margin-bottom">Section Management</h4>
        <div class="uk-grid">
            <div class="uk-width-medium-7-10">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">fullscreen</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                List of Sections
                            </h3>
                    </div>
                    <div class="md-card-content">
                        <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Department</th>
                                    <th>Section Head</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Department</th>
                                    <th>Section Head</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                    foreach($section as $sec){
                                        $head_wname = $sec->emp_LName.',&nbsp;'.$sec->emp_FName.'&nbsp;'.$sec->emp_MName.'&nbsp;'.$sec->emp_NameExt;
                                        echo    '<tr>
                                                <td>'.$sec->section_name.'</td>
                                                <td>'.$sec->department_name.'</td>
                                                <td>'.$head_wname.'</td>
                                                <td><button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="EDIT SECTION" onclick="edit_section(' . "'" . $sec->PK_section_ID . "'" . ')""><i class="material-icons md-color-grey-50 md-24">edit</i></button></td>
                                                </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-3-10" id="add_section_div" style="display:block;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Add Section
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Add-Section-Function">
                            <div class="uk-form-row">
                                <div class="uk-form-row">
                                    <label>Department</label>
                                    <select id="select_department" data-md-selectize name="form_section_department">
                                        <option value="">Select Department...</option>
                                        <?php
                                                        foreach($department as $dept){
                                                            echo '<option value="'.$dept->PK_department_ID.'">'.$dept->department_name.'</option>';
                                                        }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <label>Section Name</label>
                                    <input type="text" class="md-input uk-text-upper" name="form_section_name" autocomplete="off"/>
                                </div>
                                <div class="uk-form-row">
                                    <label>Section Head</label>
                                    <select id="select_section_head" data-md-selectize name="form_section_head" autocomplete="off">
                                        <option value="">Select Section Head...</option>
                                        <?php
                                                            foreach($active_employee as $employee){
                                                                $emp_wname = $employee->emp_LName.',&nbsp;'.$employee->emp_FName.' '.$employee->emp_MName.' '.$employee->emp_NameExt;
                                                                echo '<option value="'.$employee->PK_employee_code.'">'.$emp_wname.'</option>';
                                                            }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">ADD SECTION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-3-10" id="edit_section_div" style="display:none;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Update Section
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form enctype="multipart/form-data" method="POST" id="edit_form_section">
                            <div class="uk-form-row">
                            <label>Department</label>
                                <div class="uk-form-row">
                                    <select id="select_department" data-md-selectize name="edit_form_section_department">
                                        <option value="">Select Department...</option>
                                        <?php
                                                        foreach($department as $dept){
                                                            echo '<option value="'.$dept->PK_department_ID.'">'.$dept->department_name.'</option>';
                                                        }
                                                        ?>
                                    </select>
                                </div>
                                <label>Section Name</label>
                                <div class="uk-form-row">
                                    <input type="text" class="md-input uk-text-upper" name="edit_form_section_name" autocomplete="off"/>
                                </div>
                                <div class="uk-form-row">
                                    <label>Section Head</label>
                                    <select id="select_section_head" data-md-selectize name="edit_form_section_head" autocomplete="off">
                                        <option value="">Select Section Head...</option>
                                        <?php
                                                            foreach($active_employee as $employee){
                                                                $emp_wname = $employee->emp_LName.',&nbsp;'.$employee->emp_FName.' '.$employee->emp_MName.' '.$employee->emp_NameExt;
                                                                echo '<option value="'.$employee->PK_employee_code.'">'.$emp_wname.'</option>';
                                                            }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">UPDATE SECTION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>