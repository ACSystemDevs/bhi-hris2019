<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Employee Masterlist</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Position</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Position</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        foreach($masterlist as $master){
                            $emp_wname = $master->emp_LName.',&nbsp;'.$master->emp_FName.' '.$master->emp_MName.' '.$master->emp_NameExt;
                            $pos_count = (count(unserialize(base64_decode($master->record_position)))) -1;
                                $sec_count = (count(unserialize(base64_decode($master->record_section)))) - 1;
                                $sta_count = (count(unserialize(base64_decode($master->record_status)))) -1;
                                $emp_status = unserialize(base64_decode($master->record_status))[$sta_count];
                                if($emp_status == 'Resigned'){
                                    $status = '<span class="uk-badge uk-badge-danger">Resigned</span>';
                                }elseif($emp_status == 'Retired'){
                                    $status = '<span class="uk-badge uk-badge-danger">Retired</span>';
                                }elseif($emp_status == "Regular"){
                                    $status = '<span class="uk-badge uk-badge-primary">Regular</span>';
                                }elseif($emp_status == 'Probationary'){
                                    $status = '<span class="uk-badge uk-badge-warning">Probationary</span>';
                                }elseif($emp_status == "Contractual"){
                                    $status = '<span class="uk-badge uk-badge-warning">Contractual</span>';
                                }else{
                                    $status = '<span class="uk-badge uk-badge-warning">Trainee</span>';
                                }
                            if ((is_array(unserialize(base64_decode($master->record_position))) && count(unserialize(base64_decode($master->record_position))) > 0 && unserialize(base64_decode($master->record_position))[0] != '') && (is_array(unserialize(base64_decode($master->record_section))) && count(unserialize(base64_decode($master->record_section))) > 0 && unserialize(base64_decode($master->record_section))[0] != '')) {
                                echo '<tr>
                                        <td>'.$emp_wname.'</td>
                                        <td>'.$master->PK_employee_code.'</td>
                                        <td>'
                                            .unserialize(base64_decode($master->record_position))[$pos_count].
                                        '</td>
                                        <td>'.unserialize(base64_decode($master->record_section))[$sec_count].'</td>
                                        <td>'.$status.'</td>
                                        <td><a href="'.base_url().'View-Employee/'.$master->PK_employee_code.'" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW PROFILE"><i class="material-icons md-color-grey-50 md-24">visibility</i></a></td>
                                        </tr>';
                            }else{
                                echo '<tr>
                                        <td>'.$emp_wname.'</td>
                                        <td>'.$master->PK_employee_code.'</td>
                                        <td>Unassigned</td>
                                        <td>Unassigned</td>
                                        <td>'.$status.'</td>
                                        <td><a href="'.base_url().'View-Employee/'.$master->PK_employee_code.'" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW PROFILE"><i class="material-icons md-color-grey-50 md-24">visibility</i></a></td>
                                        </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>