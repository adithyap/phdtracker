<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <?php
    $i = 0;
    foreach($details as $detail)
    {
        $i++;
        echo '<div style="margin-bottom: 20px; width: 80%;">';
        
        echo "<h2>Meeting #$i</h2>";
        
        echo '<div>';
        echo 'Date  : '.$detail['date'];
        echo '</div>';
        
        echo '<div>';
        echo 'Venue : '.$detail['venue'];
        echo '</div>';
        
        echo '<div>';
        echo 'Public Seminar : '.$detail['public_seminar'];
        echo '</div>';
        
        echo '<div>';
        echo 'Remarks : '.$detail['remarks'];
        echo '</div>';
        echo '</div>';
        
        if($this->session->userdata('is_admin')){
            echo "<a href='".base_url()."doctoral_meeting/edit/{$detail['id']}'>Edit</a>";
        }
                
    }
    
//    Check if all Meetings are Filled
    if($i && $i<3 && $this->session->userdata('is_admin'))
    {
        echo '<br/><hr/><br/>';
        echo "<a href='".base_url()."doctoral_meeting/add/{$details[0]['user_id']}'>Add another Doctoral Meeting Entry</a>";
    }
    ?>
</div>