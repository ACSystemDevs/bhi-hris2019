
        <!-- common functions -->
        <script src="<?php echo base_url();?>assets/js/common.min.js"></script>
        <!-- uikit functions -->
        <script src="<?php echo base_url();?>assets/js/uikit_custom.min.js"></script>
        <!-- altair common functions/helpers -->
        <script src="<?php echo base_url();?>assets/js/altair_admin_common.min.js"></script>

        <!-- page specific plugins -->
        <!-- d3 -->
        <script src="<?php echo base_url();?>assets/bower_components/d3/d3.min.js"></script>
        <!-- metrics graphics (charts) -->
        <script src="<?php echo base_url();?>assets/bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="<?php echo base_url();?>assets/bower_components/chartist/dist/chartist.min.js"></script>
        <!-- peity (small charts) -->
        <script src="<?php echo base_url();?>assets/bower_components/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="<?php echo base_url();?>assets/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <!-- countUp -->
        <script src="<?php echo base_url();?>assets/bower_components/countUp.js/countUp.min.js"></script>
        <!-- handlebars.js -->
        <script src="<?php echo base_url();?>assets/bower_components/handlebars/handlebars.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/custom/handlebars_helpers.min.js"></script>
        <!-- CLNDR -->
        <script src="<?php echo base_url();?>assets/bower_components/clndr/src/clndr.js"></script>
        <!-- fitvids -->
        <script src="<?php echo base_url();?>assets/bower_components/fitvids/jquery.fitvids.js"></script>
        <!--  dashbord functions -->
        <script src="<?php echo base_url();?>assets/js/pages/dashboard.min.js"></script>
        <!--  contact list functions -->
        <script src="<?php echo base_url();?>assets/js/pages/page_contact_list.min.js"></script>
        <!-- datatables -->
        <script src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <!-- datatables colVis-->
        <script src="<?php echo base_url();?>assets/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
        <!-- datatables custom integration -->
        <script src="<?php echo base_url();?>assets/js/custom/datatables_uikit.min.js"></script>
        <!--  datatables functions -->
        <script src="<?php echo base_url();?>assets/js/pages/plugins_datatables.min.js"></script>
        <!-- file input -->
        <script src="<?php echo base_url();?>assets/js/custom/uikit_fileinput.min.js"></script>
        <!--  user edit functions -->
        <script src="<?php echo base_url();?>assets/js/pages/page_user_edit.min.js"></script>
        <!--  forms advanced functions -->
        <script src="<?php echo base_url();?>assets/js/pages/forms_advanced.min.js"></script>
        <!-- form controls -->
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/manage_rows.js"></script>
        <!-- inputmask-->
        <script src="<?php echo base_url();?>assets/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
        <!--  notifications functions -->
        <script src="<?php echo base_url();?>assets/js/pages/components_notifications.min.js"></script>
        <!-- AJAX -->
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/ajax_modal.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/manage_entities.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/uploaded_files.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/manage_uface.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/manage_users.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/reports.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/account_settings.js"></script>
        <!-- JS PDF -->
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/jsPDF/dist/jspdf.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/jsPDF/dist/jspdf.autotable.js"></script>
        <script src="<?php echo base_url();?>assets/js/HRIS-JS/jsPDF/plugins/addimage.js"></script>
        <script>
        // var base_url = 'http://10.200.0.125/bhi-hris/';
		var base_url = 'http://192.168.0.188:8080/bhi-hris/';
            $(function() {
                // enable hires images
                altair_helpers.retina_images();
                // fastClick (touch devices)
                if(Modernizr.touch) {
                    FastClick.attach(document.body);
                }
            });
            $(document).ajaxStart(function() {
                altair_helpers.content_preloader_show();
            });

            $(document).ajaxStop(function() {
                altair_helpers.content_preloader_hide();
            });
        </script>
</body>
</html>