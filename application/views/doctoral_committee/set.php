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
            echo form_input('name'.$i,  set_value('name'.$i));
            echo form_error('name'.$i);
            ?>
            
            <label>Affiliation</label>
            <?php 
            echo form_input('affiliation'.$i,  set_value('affiliation'.$i));
            echo form_error('affiliation'.$i);
            ?>
            
            <label>Email</label>
            <?php 
            echo form_input('email'.$i,  set_value('email'.$i));
            echo form_error('email'.$i);
            ?>
            
            <label>Phone No.</label>
            <?php 
            echo form_input('phone_no'.$i,  set_value('phone_no'.$i));
            echo form_error('phone_no'.$i);
            ?>
            
            <label>Address</label>
            <?php 
            echo form_input('address'.$i,  set_value('address'.$i));
            echo form_error('address'.$i);
            ?>
        </div>
    <?php }
    echo form_hidden('id', $id);
    echo form_hidden('type', 'add');
    ?>
    
    <div>
        <?php echo form_submit('submit','Submit') ?>
    </div>
    <?php echo form_close() ?>
</div>