<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css" />
<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php
    $details = array('1' => 'Internal', '2'=>'Internal', '3' => 'External', '4'=>'External');
    echo form_open('doctoral_committee/submit'); 
    ?>
    <?php for($i=1; $i<5; $i++){ ?>
        <div style="border-bottom: solid 1px #aaa; margin-bottom: 10px; width: 80%;">
            <label><?php echo $details[$i].' Examiner '.$i ?></label>
            <?php 
            echo form_input(array('name'=>'name'.$i , 'value'=>$name[$i-1]));
            echo form_error('name'.$i);
            ?>
            
            <label>Affiliation</label>
            <?php
            echo form_input(array('name'=>'affiliation'.$i , 'value'=>$affiliation[$i-1]));
            echo form_error('affiliation'.$i);
            ?>
            
            <label>Email</label>
            <?php 
            echo form_input(array('name'=>'email'.$i , 'value'=>$email[$i-1]));
            echo form_error('email'.$i);
            ?>
            
            <label>Phone No.</label>
            <?php 
            echo form_input(array('name'=>'phone_no'.$i , 'value'=>$phone_no[$i-1]));
            echo form_error('phone_no'.$i);
            ?>
            
            <label>Phone No.</label>
            <?php 
            echo form_input(array('name'=>'address'.$i , 'value'=>$address[$i-1]));
            echo form_error('address'.$i);
            ?>
        </div>
    <?php }
    echo form_hidden('id', $id);
    echo form_hidden('dc_id', $dc_id);
    echo form_hidden('type', 'update');
    ?>
    
    <div>
        <?php echo form_submit('update','Update') ?>
    </div>
    <?php echo form_close() ?>
</div>