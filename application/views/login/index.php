<div class="wrapper">
    <div class="column">
        <?php echo form_open('login'); ?>
            <div>
                <label>Username</label>                        
                <?php echo form_input('username',  set_value('username')) ?>
                <?php echo form_error('username') ?>
            </div>
            <div>
                <label>Password</label>
                <?php echo form_password('password') ?>
                <?php echo form_error('password') ?>
            </div>
            <div>
                <?php echo form_submit('login','Login') ?>
            </div>
        </form>
        <div class="error"><?php if(isset($error)) echo $error ?></div>
    </div>
    <div class="column" style="border-left: solid 1px #000;">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </div>
</div>
