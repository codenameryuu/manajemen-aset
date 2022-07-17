<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) { ?>
            Swal.fire({
                icon: 'success',
                text: '<?php echo $this->session->flashdata('success') ?>',
                showConfirmButton: false,
                timer: 1500,
            });
        <?php } ?>

        <?php if ($this->session->flashdata('fail')) { ?>
            Swal.fire({
                icon: 'error',
                text: '<?php echo $this->session->flashdata('fail') ?>',
            });
        <?php } ?>
    });
</script>