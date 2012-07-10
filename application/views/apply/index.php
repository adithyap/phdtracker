<div class="wrapper" style="padding-top: 20px;">
    <?php echo form_open_multipart('apply'); ?>
        <div>
            <label>Name</label>                        
            <?php echo form_input('name',  set_value('name')) ?>
            <?php echo form_error('name') ?>
        </div>
        <div>
            <label>Date of Birth</label>
            <?php echo form_input(array('name'=>'dob', 'id'=>'dob'),  set_value('dob')) ?>
            <?php echo form_error('dob') ?>
        </div>
        <div>
            <label>Area of Interest</label>
            <?php echo form_input('area_of_interest', set_value('area_of_interest')) ?>
            <?php echo form_error('area_of_interest') ?>
        </div>
        <div>
            <label>Proposed Research Work</label>
            <?php echo form_textarea('synopsis', set_value('synopsis')) ?>
            <?php echo form_error('synopsis') ?>
        </div>
        <div>
            <label>E-Mail</label>
            <?php echo form_input('email', set_value('email')) ?>
            <?php echo form_error('email') ?>
        </div>
        <div>
            <label>Resume</label>
            <?php echo form_upload('resume') ?>
            
            <?php if(isset($error)) echo $error ?>
        </div>
        <div>
            <?php echo form_submit('submit','Submit') ?>
        </div>
    <?php echo form_close() ?>
    <script type="text/javascript"> $("#dob").datepicker(); </script>
</div>