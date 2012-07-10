<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php 
    $details = array('1' => 'Internal', '2'=>'Internal', '3' => 'External', '4'=>'External');
    for($i=0; $i<4; $i++)
    {
        echo '<div style="margin-bottom: 20px; width: 80%;">';
        
        echo '<div><u>';
        echo $details[$i+1].' Examiner '.$i.'</u> : '.$name[$i];
        echo '</div>';
        
        echo '<div>';
        echo 'Affiliation : '.$affiliation[$i];
        echo '</div>';
        
        echo '<div>';
        echo 'E-Mail : '.$email[$i];
        echo '</div>';
        
        echo '<div>';
        echo 'Phone No. : '.$phone_no[$i];
        echo '</div>';
        echo '</div>';
                
    }
    ?>
    
    <?php 
        if($this->session->userdata('is_admin')){
            echo "<a href='".base_url()."doctoral_committee/edit/$id'>Edit</a>";
        }
    ?>
</div>