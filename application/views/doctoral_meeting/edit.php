<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css" />
<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php echo form_open('doctoral_meeting/submit'); ?>
    
    <label>Date</label>
    <?php 
    echo form_input(array('name'=>'date', 'class'=>'datepicker', 'value'=>$date));
    echo form_error('date');
    ?>

    <label>Venue</label>
    <?php 
    echo form_input(array('name'=>'venue',  'value'=>$venue));
    echo form_error('venue');
    ?>

    <label>Public Seminar</label>
    <?php 
    echo form_textarea(array('name'=>'public_seminar', 'value'=>$public_seminar));
    echo form_error('public_seminar');
    ?>

    <label>Remarks</label>
    <?php 
    echo form_textarea(array('name'=>'remarks', 'value'=>$remarks));
    echo form_error('remarks');
    ?>
    
    <?php
    echo form_hidden('id', $user_id);
    echo form_hidden('num', $num);
    echo form_hidden('dm_id', $id);
    echo form_hidden('type', 'update');
    ?>
    
    <div>
        <?php echo form_submit('submit','Submit') ?>
    </div>
    <?php echo form_close() ?>
</div>

<script type="text/javascript"> $(".datepicker").datepicker(); </script>