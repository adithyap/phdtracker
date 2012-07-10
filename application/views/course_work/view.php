<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <h2>
        <?php 
        if($pass)
            echo 'PASS';
        else
            echo 'FAIL';
        ?>
    </h2>
    <?php
    for($i=0; $i<4; $i++)
    {
        echo '<div style="margin-bottom: 20px; width: 80%;">';
        
        echo '<div><u>';
        echo 'Course Title '.($i+1).'</u> : '.$courses[$i];
        echo '</div>';
        
        echo '<div>';
        echo 'Mark : '.$marks[$i];
        echo '</div>';
        
        echo '</div>';
                
    }
    ?>
    
    <?php 
        if($this->session->userdata('is_admin')){
            echo "<a href='".base_url()."course_work/edit/$id'>Edit</a>";
        }
    ?>
</div>