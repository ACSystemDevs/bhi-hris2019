<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Employee Masterlist</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
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
                        $count = count($masterlist)-1;
                        for($i=0;$i<=$count;$i++){
                            if($masterlist[$i]['status'] == 'Resigned'){
                                $status = '<span class="uk-badge uk-badge-danger">Resigned</span>';
                            }elseif($masterlist[$i]['status'] == 'Retired'){
                                $status = '<span class="uk-badge uk-badge-danger">Retired</span>';
                            }elseif($masterlist[$i]['status'] == "Regular"){
                                $status = '<span class="uk-badge uk-badge-primary">Regular</span>';
                            }elseif($masterlist[$i]['status'] == 'Probationary'){
                                $status = '<span class="uk-badge uk-badge-warning">Probationary</span>';
                            }elseif($masterlist[$i]['status'] == "Contractual"){
                                $status = '<span class="uk-badge uk-badge-warning">Contractual</span>';
                            }else{
                                $status = '<span class="uk-badge uk-badge-warning">Trainee</span>';
                            }
                                echo '<tr>
                                        <td>'.$masterlist[$i]['emp_wname'].'</td>
                                        <td>'.$masterlist[$i]['employee_code'].'</td>
                                        <td>'.$masterlist[$i]['position'].'</td>
                                        <td>'.$masterlist[$i]['section'].'</td>
                                        <td>'.$status.'</td>
                                        <td><a href="'.base_url().'View-Member-Profile/'.$masterlist[$i]['employee_code'].'" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW PROFILE"><i class="material-icons md-color-grey-50 md-24">visibility</i></a></td>
                                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="md-fab-wrapper md-fab-in-card" style="position:fixed;bottom:50;">
            <a class="md-fab md-fab-success md-fab-wave-light" href="<?php base_url();?>Add-Employee" data-uk-tooltip title="ADD EMPLOYEE"><i class="material-icons">person_add</i></a>
        </div>
    </div>
</div>