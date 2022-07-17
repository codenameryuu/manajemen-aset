<!-- Essential javascripts for application to work-->
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<!-- Data table plugin-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/auto.js"></script>

<script type="text/javascript">
    $('.select2').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });

    $('.datatable').DataTable();
</script>

<!-- The javascript plugin to display page loading on top-->
<script src="<?php echo base_url(); ?>assets/js/plugins/pace.min.js"></script>

<!-- Page specific javascripts-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/chart.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Block UI -->
<script src="https://malsup.github.io/jquery.blockUI.js"></script>