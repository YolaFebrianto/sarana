	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Sistem Informasi Sarana Prasarana</b>
		</div>
		<strong>Copyright &copy; <?=date('Y');?> SISPRA</strong>
	</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url();?>template/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url();?>template/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=base_url();?>template/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url();?>template/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url();?>template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url();?>template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>template/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?=base_url();?>template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url();?>template/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url();?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url();?>template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>template/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>template/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url();?>template/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>template/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?=base_url();?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>template/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$('#dtTable').DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
	});
	$('#year-input').each(function () {
        $(this).datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $(this).datepicker('clearDates');
    });
    $(function(){
    	$('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>