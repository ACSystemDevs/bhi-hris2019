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
                        foreach($regular_employee as $regular){
                            $emp_wname = $regular->emp_LName.',&nbsp;'.$regular->emp_FName.' '.$regular->emp_MName.' '.$regular->emp_NameExt;
                            if ((is_array(unserialize(base64_decode($regular->record_status))) && count(unserialize(base64_decode($regular->record_status))) > 0 && unserialize(base64_decode($regular->record_status))[0] != '')) {
                                $pos_count = (count(unserialize(base64_decode($regular->record_position)))) -1;
                                $sec_count = (count(unserialize(base64_decode($regular->record_section)))) - 1;
                                $rec_count = (count(unserialize(base64_decode($regular->record_status)))) - 1;
                                $employee_status = unserialize(base64_decode($regular->record_status))[$rec_count];
                                if($employee_status == 'Regular'){
                                    echo '<tr>
                                    <td>'.$emp_wname.'</td>
                                    <td>'.$regular->PK_employee_code.'</td>
                                    <td>'
                                        .unserialize(base64_decode($regular->record_position))[$pos_count].
                                    '</td>
                                    <td>'.unserialize(base64_decode($regular->record_section))[$sec_count].'</td>
                                    <td><a href="'.base_url().'Request-Leave/'.$regular->PK_employee_code.'" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="REQUEST LEAVE"><i class="material-icons md-color-grey-50 md-24">event_busy</i></a></td>
                                    </tr>';
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>