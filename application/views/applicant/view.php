<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <div>
        <h2><?php  echo $applicant['name'] ?></h2>
        <div class="applicant-item"><i>Date of Birth:</i><?php echo nbs(5).$applicant['dob'] ?></div>
        <div class="applicant-item"><i>Areas of Interest:</i><?php echo nbs(5).$applicant['area_of_interest'] ?></div>
        <div class="applicant-item"><i>Synopsis:</i><?php echo br(2).nbs(5).$applicant['synopsis'] ?></div>
        <div class="applicant-item"><i>E-Mail:</i><?php echo nbs(5).$applicant['email'] ?></div>
        <div class="applicant-item"><i>Resume:</i><a href='<?php echo base_url().'uploads/'.$applicant['resume'] ?>'><?php echo nbs(5).'Click to Download' ?></a></div>
    </div>
    
    <div>
        <?php echo form_open('applicant/approve') ?>
        <?php echo form_hidden('id', $applicant['id']) ?>
        <?php echo form_submit('approve', 'Approve') ?>
        <?php echo form_close() ?>
    </div>
    <div>
        <?php echo form_open('applicant/reject') ?>
        <?php echo form_hidden('id', $applicant['id']) ?>
        <?php echo form_submit('reject', 'Reject') ?>
        <?php echo form_close() ?>
    </div>
</div>