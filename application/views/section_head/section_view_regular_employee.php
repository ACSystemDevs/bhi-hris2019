<div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">Regular Employee List<small>(Only Regular Employee will appear)</small></h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Position</th>
                            <th>Section</th>
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
                        $count = count($masterlist_regular)-1;
                            for($i=0;$i<=$count;$i++){
                                echo '<tr>
                                        <td>'.$masterlist_regular[$i]['emp_wname'].'</td>
                                        <td>'.$masterlist_regular[$i]['employee_code'].'</td>
                                        <td>'.$masterlist_regular[$i]['position'].'</td>
                                        <td>'.$masterlist_regular[$i]['section'].'</td>
                                        <td><a href="'.base_url().'View-Member-Profile/'.$masterlist_regular[$i]['employee_code'].'" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="APPLY LEAVE"><i class="material-icons md-color-grey-50 md-24">event_busy</i></a></td>
                                      </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>