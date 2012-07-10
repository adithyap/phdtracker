<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css" />
<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php
    echo form_open('comprehensive_viva/submit'); 
    ?>
    <?php for($i=1; $i<=5; $i++){ ?>
        <div style="border-bottom: solid 1px #aaa; margin-bottom: 10px; width: 80%;">
            
            <label>Export Committee Member <?php echo $i ?></label>
            <?php 
            echo form_input('name'.$i,  set_value('name'.$i));
            echo form_error('name'.$i);
            ?>
            
            <label>Affiliation</label>
            <?php 
            echo form_input('affiliation'.$i,  set_value('affiliation'.$i));
            echo form_error('affiliation'.$i);
            ?>
        </div>
    <?php }
    
    echo '<label>Result</label>';
    echo form_dropdown('result', array('1'=>'Pass', '0'=>'Fail'));
    
    echo '<label>Date</label>';
    echo form_input(array('name'=>'date', 'id'=>'datepicker'), set_value('date'));
    echo form_error('date');
            
    echo form_hidden('id', $id);
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