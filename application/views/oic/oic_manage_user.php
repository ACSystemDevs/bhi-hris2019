<div id="page_content">
    <div id="page_content_inner">
        <h4 class="heading_a uk-margin-bottom">User Management</h4>
        <div class="uk-grid">
            <div class="uk-width-medium-10-10">
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">fullscreen</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                List of Users
                            </h3>
                    </div>
                    <div class="md-card-content">
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Usertype</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>ID No</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Usertype</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                    foreach($users as $user){
                                        $emp_wname = $user->emp_LName.',&nbsp;'.$user->emp_FName.'&nbsp;'.$user->emp_MName.'&nbsp;'.$user->emp_NameExt;
                                        if($user->user_status == 'Active'){
                                            $button = '<button class="md-btn md-btn-danger md-btn-wave-light md-btn-small" data-uk-tooltip title="MARK AS INACTIVE" onclick="modal_mark_inactive(' . "'" . $user->PK_user_ID . "'".')"><i class="material-icons md-color-grey-50 md-24">close</i></button>';
                                        }else{
                                            $button = '<button class="md-btn md-btn-success md-btn-wave-light md-btn-small" data-uk-tooltip title="MARK AS ACTIVE" onclick="modal_mark_active(' . "'" . $user->PK_user_ID . "'".')"><i class="material-icons md-color-grey-50 md-24">done</i></button>';
                                        }
                                        echo    '<tr>
                                                <td>'.$user->PK_employee_code.'</td>
                                                <td>'.$user->Username.'</td>
                                                <td>'.$emp_wname.'</td>
                                                <td>'.$user->user_usertype.'</td>
                                                <td>
                                                <button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="EDIT USER ACCOUNT" onclick="modal_manage_user_account(' . "'" . $user->PK_user_ID . "'".')"><i class="material-icons md-color-grey-50 md-24">edit</i></button>
                                                <button class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="CHANGE PASSWORD" onclick="modal_modify_password(' . "'" . $user->PK_user_ID . "'".')"><i class="material-icons md-color-grey-50 md-24">lock</i></button>
                                                '.$button.'
                                                </td>
                                                </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- CHNAGE PASSORD MODAL START -->
                <div class="uk-modal" id="manage_user_account_admin">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Manage User</h3>
                        </div>
                        <div class="md-card-content">
                        <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Save_User_Account_Changes">
                            <div class="uk-form-row">
                                        <label>Username</label>
                                        <input type="text" class="md-input label-fixed" name="modal_form_username"/>
                                        <input type="hidden" class="md-input label-fixed" name="modal_form_user_id"/>
                            </div>
                            <div class="uk-form-row">
                                        <label>Assign Usertype</label>
                                        <select class="md-input label-fixed" name="modal_form_usertype">
                                            <option value=""></option>
                                            <option value="President">President</option>
                                            <option value="HR">HR</option>
                                            <option value="Payroll">Payroll</option>
                                            <option value="Employee">Employee</option>
                                        </select>
                            </div>
                            <div class="uk-form-row">
                                        <label>Status</label>
                                        <select class="md-input label-fixed" name="modal_form_user_status">
                                            <option value=""></option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                            </div>
                        </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>
                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light">Save Changes</button>
                            </div>
                        </form>
                        </div>
                    </div>

                    <div class="uk-modal" id="modify_password_admin">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Manage User</h3>
                        </div>
                        <div class="md-card-content">
                        <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Save_Password_Changes">
                            <div class="uk-form-row">
                                        <label>Username</label>
                                        <input type="text" class="md-input label-fixed" name="modal_form_username" disabled/>
                                        <input type="hidden" class="md-input label-fixed" name="modal_form_user_id"/>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-help-block">Enter Password</span>
                                <input type="password" class="md-input" name="form_password" />
                                <a href="" class="uk-form-password-toggle" data-uk-form-password>show</a>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-help-block">Re-enter Password</span>
                                <input type="password" class="md-input" name="form_confirm_password" />
                                <a href="" class="uk-form-password-toggle" data-uk-form-password>show</a>
                            </div>
                        </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>
                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light">Save Changes</button>
                            </div>
                        </form>
                        </div>
                    </div>