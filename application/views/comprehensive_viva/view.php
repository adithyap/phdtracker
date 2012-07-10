<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <h2>
        <?php 
        if($result)
            echo 'PASS';
        else
            echo 'FAIL';
        ?>
    </h2>
    <?php
    for($i=0; $i<5; $i++)
    {
        echo '<div style="margin-bottom: 20px; width: 80%;">';
        
        echo '<div><u>';
        echo 'Export Committee Member '.($i+1).'</u> : '.$name[$i];
        echo '</div>';
        
        echo '<div>';
        echo 'Affiliation : '.$affiliation[$i];
        echo '</div>';
        
        echo '</div>';
                
    }
    ?>
    
    <?php 
        if($this->session->userdata('is_admin')){
            echo "<a href='".base_url()."comprehensive_viva/edit/$id'>Edit</a>";
        }
    ?>
</div>