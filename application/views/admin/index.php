<div class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
    <div id="tabs">
        <ul>
            <li><a href="#applicants">Applicants</a></li>
            <li><a href="#students">Students</a></li>
        </ul>
        <div id="applicants">
            <?php
            foreach ($applicants as $apl) {
                echo '<div class="applicant">';
                echo "<a href='".  base_url()."applicant/view/{$apl['id']}'>{$apl['name']}</a> | {$apl['area_of_interest']} ";
                echo '</div>';
            }
            ?>
        </div>
        <div id="students">
            <?php
            foreach ($users as $u) {
                echo '<div class="applicant">';
                echo "<a href='".  base_url()."student/view/{$u['id']}'>{$u['name']}</a> ";
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <script type="text/javascript">$("#tabs").tabs()</script>
</div>