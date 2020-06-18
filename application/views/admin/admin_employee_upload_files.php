<div id="page_content">
    <div id="page_content_inner">
        <div class="user_heading">
            <div class="user_heading_avatar">
                <div class="thumbnail" style="height:125px;width:125px;">
                    <?php
                                        if(empty($profile->emp_picture)){
                                            $user_image = base_url('assets/img/avatars/user.png');
                                        }else{
                                            $user_image = base_url($profile->emp_picture);
                                        }
                                    ?>

                        <img src="<?php echo $user_image;?>" alt="<?php echo $emp_wname;?>" />
                </div>
            </div>
            <div class="user_heading_content">
                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">
                                        <?php 
                                            echo $emp_wname;
                                        ?>
                                    </span>
                                    <span class="sub-heading"><?php echo $profile->PK_employee_code;?> | 
                                        <?php
                                            if ((is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($profile->record_position)))) -1;
                                                echo unserialize(base64_decode($profile->record_position))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                    </span>
                                </h2>
                <ul class="user_stats">
                    <li>
                        <h4 class="heading_a"><i class="material-icons md-36">contact_phone</i><?php echo $profile->emp_mobno;?></h4>
                    </li>
                    <li>
                        <h4 class="heading_a"><i class="material-icons">contact_mail</i><?php echo strtolower($profile->emp_email);?></h4>
                    </li>
                </ul>
            </div>
        </div>
        <div class="uk-width-medium-10-10 uk-container-center reset-print">

            <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
                <div class="uk-width-large-3-10 hidden-print uk-visible-large">
                    <div class="md-list-outside-wrapper">
                        <ul class="md-list md-list-outside notes_list" id="notes_list">
                            <li class="heading_list uk-text-danger">Folders</li>
                            <li>
                                <button type="button" class="md-list-content note_link md-btn-flat md-btn-block uk-text-left" style="height:75px;">
                                    <span class="md-list-heading uk-text-truncate"><i class="material-icons">mail</i>Personal Credentials<span class="uk-badge uk-badge-primary uk-badge-notification">2</span></span>
                                    <span class="uk-text-small uk-text-muted">Service Record, Personal Records</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="md-list-content note_link md-btn-flat md-btn-block uk-text-left" style="height:75px;">
                                    <span class="md-list-heading uk-text-truncate"><i class="material-icons">assignment</i>Government Credentials<span class="uk-badge uk-badge-warning uk-badge-notification">0</span></span>
                                    <span class="uk-text-small uk-text-muted">Government Files</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="md-list-content note_link md-btn-flat md-btn-block uk-text-left" style="height:75px;">
                                    <span class="md-list-heading uk-text-truncate"><i class="material-icons">description</i>Contract/Salary Adjustments<span class="uk-badge uk-badge uk-badge-notification">0</span></span>
                                    <span class="uk-text-small uk-text-muted"></span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="md-list-content note_link md-btn-flat md-btn-block uk-text-left" style="height:75px;">
                                    <span class="md-list-heading uk-text-truncate"><i class="material-icons">class</i>Memo<span class="uk-badge uk-badge-success uk-badge-notification">0</span></span>
                                    <span class="uk-text-small uk-text-muted"></span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="md-list-content note_link md-btn-flat md-btn-block uk-text-left" style="height:75px;">
                                    <span class="md-list-heading uk-text-truncate"><i class="material-icons">unarchive</i>Separtion/Quit Claims<span class="uk-badge uk-badge-danger uk-badge-notification">0</span></span>
                                    <span class="uk-text-small uk-text-muted"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="uk-width-large-7-10">
                    <div class="md-card md-card-single" style="height:100%;">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom">201 Files</h3>
                            <button type="button" class="md-btn md-btn-primary  md-btn-wave-light uk-float-right" id="user_edit_save" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Upload Document" data-uk-modal="{target:'#upload_file_modal'}"><i class="material-icons md-color-grey-50 md-24">cloud_upload</i>&nbsp;Upload New File</button>
                            <div class="uk-form-row"><span class="uk-text-bold">Employee's Files</span></div>
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date Uploaded</th>
                                            <th>File Title</th>
                                            <th>File Name</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($emp_files as $files){
                                                $last_three = substr($files->File_name, -3);
                                                
                                                if($last_three == 'pdf'){
                                                    $view_button = '<button type="button" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE" onclick="uploaded_file_view_pdf(' . "'" . $files->PK_emp_201files_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>';
                                                }elseif($last_three == 'png' || $last_three == 'jpg' || $last_three == 'jpeg'){
                                                    $view_button = '<button type="button" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE" onclick="uploaded_file_view_img(' . "'" . $files->PK_emp_201files_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>';
                                                }else{
                                                    $view_button = '<a href="'.base_url().$files->File_path.'" target="_blank" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE"><i class="material-icons md-color-grey-50 md-24">visibility</i></a>';
                                                }
                                                echo '<tr>
                                                        <td>'.date('F d, Y',strtotime($files->Date_added)).'</td>
                                                        <td>'.$files->File_title.'</td>
                                                        <td>'.$files->File_name.'</td>
                                                        <td>'.$view_button.'
                                                            <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="DOWNLOAD FILE"><i class="material-icons md-color-grey-50 md-24">cloud_download</i></button>
                                                        </td>
                                                    </tr>';
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- MODAL START -->
                        <div class="uk-modal" id="upload_file_modal">
                            <div class="uk-modal-dialog">
                                <div class="uk-modal-header">
                                    <h3 class="uk-modal-title">Upload 201 File</h3>
                                </div>
                                <div class="md-card-content">
                                    <form class="uk-form-stacked" enctype="multipart/form-data" method="POST" action="<?php echo base_url();?>Upload-Employee-File-Function/<?php echo $this->uri->segment(2);?>">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <label>Folder:</label>
                                            <div class="uk-width-small-5-5">
                                                <select class="md-input" name="upload_folder_path" required>
                                                    <option value="">Select Folder...</option>
                                                    <optgroup label="Folders">
                                                        <option value="personal_credentials">Personal Credentials</option>
                                                        <option value="government_credentials">Government Credentials</option>
                                                        <option value="con_sal_adjustments">Contract/Salary Adjustments</option>
                                                        <option value="personal_memo">Personal Memo</option>
                                                        <option value="separation_claims">Separation/Quit Claims</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-form-row"></div>
                                        <div class="uk-form-row">
                                            <label>File Title</label>
                                            <input type="text" class="md-input uk-text-upper" name="upload_file_title" required/>
                                        </div>
                                        <div class="uk-form-row">
                                            <h3 class="heading_a uk-margin-small-bottom">
                                                Default
                                            </h3>
                                            <input type="file" id="input-file-a" class="dropify" name="upload_user_file" accept=".pdf,.png,.jpg,.jpeg,.docx,.doc"/>
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Short Description</label>
                                            <textarea rows="2" class="md-input" name="upload_file_description"></textarea>
                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>
                                            <button type="submit" class="md-btn md-btn-primary md-btn-wave-light">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END UPLOAD MODAL -->
                        <!-- MODAL FOR IMAGE -->
                            <div class="uk-modal" id="view_uploaded_file_image">
                                <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                    <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                                    <img src="assets/img/gallery/Image01.jpg" alt="" id="uploaded_file_img"/>
                                    <div class="uk-modal-caption" id="uploaded_short_desc" style="background-color:#000;opacity:0.6;"></div>
                                </div>
                            </div>
                        <!-- MODAL FOR PDF -->
                            <div class="uk-modal" id="view_uploaded_file_pdf">
                                <div class="uk-modal-dialog uk-modal-dialog-lightbox uk-modal-dialog-large" style="height:100%;" width="500px">
                                    <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                                    <iframe id="uploaded_file_pdf" src="http://10.200.0.125/bhi-hris/uploads/employee/69001/personal_credentials/Jose_Angelito_Cereno.pdf#zoom=100" width="100%" height="100%" frameborder="0" uk-video></iframe>
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>