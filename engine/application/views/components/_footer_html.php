        <!-- FOOTER -->
	<footer class="footer">
		&copy; 2017-2018 Majalah Stabilitas - LPPI
	</footer>
	<!-- END FOOTER -->
	<!-- Javascript -->
        <script src="<?php echo get_plugin_url('bootstrap/bootstrap.js') ?>"></script>
        <script src="<?php echo get_plugin_url('modernizr/modernizr.js') ?>"></script>
        <script src="<?php echo get_plugin_url('moment/moment.min.js') ?>"></script>
        
        <script src="<?php echo get_plugin_url('bootstrap-datepicker/bootstrap-datepicker.js'); ?>"></script>
        <script src="<?php echo get_plugin_url('bootstrap-select/bootstrap-select.min.js'); ?>"></script>
        <script src="<?php echo get_plugin_url('jquery-validation/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo get_plugin_url('select2/4.0.2/select2.min.js'); ?>"></script>
        <!-- accounting formatter -->
        <script src="<?php echo get_plugin_url('accountingjs/accounting.min.js'); ?>"></script>
        <!-- DataTables -->
        <script src="<?php echo get_plugin_url('DataTables/datatables.min.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/DataTables-1.10.13/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/DataTables-1.10.13/js/dataTables.bootstrap.min.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/Buttons-1.2.4/js/dataTables.buttons.min.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/Buttons-1.2.4/js/buttons.bootstrap.min.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/Select-1.2.0/js/dataTables.select.min.js');?>"></script>
        <!-- additional render plugin -->
        <script src="<?php echo get_plugin_url('DataTables/DataRender/ellipsis.js');?>"></script>
        <script src="<?php echo get_plugin_url('DataTables/DataRender/datetime.js');?>"></script>
        
        <!-- jquery ajax form -->
        <script src="<?php echo get_plugin_url('ajax-form/jquery.form.min.js'); ?>"></script>
        <!--twitter typeaheadjs -->
        <script src="<?php echo get_plugin_url('typeahead/typeahead.bundle.min.js'); ?>"></script>
        <!-- bootstrap typeaheadjs -->
<!--        <script src="<?php echo get_plugin_url('bootstrap-typeahead/bootstrap-typeahead.min.js'); ?>"></script>
        <script src="<?php echo get_plugin_url('bootstrap-typeahead/bloodhound.js'); ?>"></script>-->
        <!-- treejs -->
        <script src="<?php echo get_plugin_url('tree/jstree.js') ?>"></script>
        <!-- FullCalender -->
        <script src="<?php echo get_plugin_url('fullcalendar/fullcalendar.min.js') ?>"></script>
        <!-- printArea -->
        <script src="<?php echo get_plugin_url('printArea/jquery.printarea.js') ?>"></script>
        <!-- Summernote texteditor -->
        <script src="<?php echo get_plugin_url('summernote/summernote.min.js') ?>"></script>
        <!-- Slimscroll -->
        <script src="<?php echo get_plugin_url('jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
        <script type="text/javascript">
            // Settings object that controls default parameters for library methods:
            accounting.settings = {
                currency: {
                    symbol : "",   // default currency symbol is '$'
                    format: {
                        pos : "%s%v",   // for positive values, eg. "$ 1.00" (required)
                        neg : "%s(%v)", // for negative values, eg. "$ (1.00)" [optional]
                        zero: "%s0"  // for zero values, eg. "$  --" [optional]
                    }, // controls output: %s = symbol, %v = value/number
                    decimal : ".",  // decimal point separator
                    thousand: ",",  // thousands separator
                    precision : 3   // decimal places
                },
                number: {
                    precision : 0,  // default precision on numbers is 0
                    thousand: ",",
                    decimal : "."
                }
            };
        </script>
    </body>
</html>
