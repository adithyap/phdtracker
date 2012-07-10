<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css" />

<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <h2>Meeting #<?php echo $num ?></h2>
    
    <?php echo form_open('doctoral_meeting/submit'); ?>
    
    <label>Date</label>
    <?php 
    echo form_input(array('name'=>'date', 'id'=>'datepicker'), set_value('date'));
    echo form_error('date');
    ?>

    <label>Venue</label>
    <?php 
    echo form_input('venue',  set_value('venue'));
    echo form_error('venue');
    ?>

    <label>Public Seminar</label>
    <?php 
    echo form_textarea('public_seminar',  set_value('public_seminar'));
    echo form_error('public_seminar');
    ?>

    <label>Remarks</label>
    <?php 
    echo form_textarea('remarks',  set_value('remarks'));
    echo form_error('remarks');
    ?>
    
    <?php
    echo form_hidden('id', $id);
    echo form_hidden('num', $num);
    echo form_hidden('type', 'add');
    ?>
    
    <div>
        <?php echo form_submit('submit','Submit') ?>
    </div>
    <?php echo form_close() ?>
            
    <script type="text/javascript">
        $("#datepicker").datepicker();
    </script>
</div>