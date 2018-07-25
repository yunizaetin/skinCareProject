<!-- notification template -->
<?php if ($this->session->flashdata('error_status')): ?>
    <div class="alert alert-<?php if($this->session->flashdata('error_status') == "error") echo "danger"; elseif($this->session->flashdata('error_status') == "info") echo "warning"; else echo "success"; ?>" style="padding: 20px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>
            <?php echo strtoupper($this->session->flashdata('error_status')) ?>
        </strong>
        <?php echo $this->session->flashdata('error_msg') ?>
    </div>
<?php endif ?>
<!-- End of notification template -->