<div id="page_content">
    <div id="page_content_inner">
        <h4 class="heading_a uk-margin-bottom">Position Management</h4>
        <div class="uk-grid">
            <div class="uk-width-medium-7-10">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">fullscreen</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                List of Positions
                            </h3>
                    </div>
                    <div class="md-card-content">
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Position Name</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Position Name</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                    foreach($position as $position){
                                        if($position->position_status == 'Active'){
                                            $status = '<span class="uk-badge uk-badge-primary">Active</span>';
                                        }else{
                                            $status = '<span class="uk-badge uk-badge-danger">Inactive</span>';
                                        }
                                        echo    '<tr>
                                                    <td>
                                                        '.$position->job_name.'
                                                    </td>
                                                    <td>
                                                        '.$position->section_name.'
                                                    </td>
                                                    <td>
                                                        '.$status.'
                                                    </td>
                                                    <td>
                                                    <button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="EDIT DEPARTMENT" onclick="edit_position(' . "'" . $position->PK_position_ID . "'" . ')""><i class="material-icons md-color-grey-50 md-24">edit</i></button>
                                                    </td>
                                                </tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-3-10" id="add_position_div" style="display:block;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Add Position
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form method="POST" action="<?php echo base_url();?>Add-Position-Function">
                            <div class="uk-form-row">
                                <div class="uk-form-row">
                                    <label>Position Name</label>
                                    <input type="text" class="md-input uk-text-upper" name="form_position_name" autocomplete="off" />
                                </div>
                                <div class="uk-form-row">
                                    <label>For Section</label>
                                    <select id="select_demo_1" data-md-selectize name="form_position_section">
                                        <option value="">Select Section...</option>
                                        <?php
                                                            foreach($section as $sec){
                                                                echo '<option value="'.$sec->PK_section_ID.'">'.$sec->section_name.'</option>';
                                                            }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">ADD POSITION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-3-10" id="edit_position_div" style="display:none;">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                                    Update Position
                                </h3>
                    </div>
                    <div class="md-card-content">
                        <form method="POST" id="form_edit_position">
                            <div class="uk-form-row">
                            <label>Position Name</label>
                                <div class="uk-form-row">
                                    <input type="text" class="md-input uk-text-upper" name="edit_form_position_name" autocomplete="off" />
                                </div>
                                <div class="uk-form-row">
                                    <label>For Section</label>
                                    <select id="select_demo_1" data-md-selectize name="edit_form_position_section">
                                        <option value="">Select Section...</option>
                                        <?php
                                                            foreach($section as $sec){
                                                                echo '<option value="'.$sec->PK_section_ID.'">'.$sec->section_name.'</option>';
                                                            }
                                                        ?>
                                    </select>
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light  uk-float-right">ADD POSITION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>