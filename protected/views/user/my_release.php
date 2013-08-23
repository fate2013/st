<div class="recent">
    <ul>
<?php
foreach($activities as $a){
?>
        <li class="act_item" id="act_item_<?php echo $a->id;?>">
            <div class="middle_portrait">
                <div class="portrait_wrap">
                    <img src="<?php echo $a->organizer->profile->portrait; ?>" />
                </div>
                <span class="organizer">
                    <?php echo $a->organizer->displayname(); ?>
                </span>
            </div>
            <div class="wrap">
                <div class="first_line">
                    <span class="subject">
                        <?php echo $a->subject; ?>
                    </span>
                    <span class="type">
                        <?php echo $typelist[$a->type]; ?>
                    </span>
                </div>
                <span class="profile">
                    <?php echo $a->profile; ?>
                </span>
            </div>
            <div class="ctime">
                    <?php echo $a->start_time === null ? '待定' : $a->start_time; ?>
            </div>
        </li>
<?php
}
?>
    </ul>
</div>

<script>
$(document).ready(function(){
    $('.act_item').click(function(){
        var id = $(this).attr("id").substr(9);
        Nav.go('/activity/index/aid/'+id);
    });
});
</script>
