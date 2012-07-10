<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css" />
<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php
    echo form_open('course_work/submit'); 
    ?>
    <?php for($i=1; $i<5; $i++){ ?>
        <div style="border-bottom: solid 1px #aaa; margin-bottom: 10px; width: 80%;">
            
            <label>Course Title <?php echo $i ?></label>
            <?php 
            echo form_input(array('name'=>'course'.$i, 'value'=>$courses[$i-1]));
            echo form_error('course'.$i);
            ?>
            
            <label>Mark</label>
            <?php 
            echo form_input(array('name'=>'mark'.$i, 'value'=>$marks[$i-1]));
            echo form_error('mark'.$i);
            ?>
        </div>
    <?php }
    echo form_hidden('id', $id);
    echo form_hidden('cw_id', $cw_id);
    echo form_hidden('type', 'update');
    ?>
    
    <div>
        <?php echo form_submit('update','Update') ?>
    </div>
    <?php echo form_close() ?>
</div>