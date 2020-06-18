<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
            <div class="uk-width-large-2-10">
            </div>
            <div class="uk-width-large-6-10">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_c uk-margin-medium-bottom">Account Settings</h3>
                        <form class="uk-form-stacked" enctype="multipart/form-data" method="POST" action="<?php echo base_url('Update-UserAccount/'.$account->PK_user_ID);?>">
                            <div class="uk-form-row">
                                <label for="user_username" >Username</label>
                                <input type="text" class="md-input label-fixed" id="user_username" name="user_username" value="<?php echo $account->Username;?>" autocomplete="off"/>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-help-block">Enter Password</span>
                                <input type="password" class="md-input" name="user_password"/>
                                <a href="" class="uk-form-password-toggle" data-uk-form-password>show</a>
                            </div>
                            <div class="uk-form-row">
                                <span class="uk-form-help-block">Confirm Password</span>
                                <input type="password" class="md-input" name="user_cpassword"/>
                                <a href="" class="uk-form-password-toggle" data-uk-form-password>show</a>
                            </div>
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light md-btn-small uk-float-right" data-uk-tooltip title="Save Changes"><i class="material-icons md-color-grey-50 md-24">save</i>&nbsp;Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div class="uk-width-large-2-10">
            </div>
        </div>
    </div>