<div class="recent">
    <ul>
<?php
$simpleHTML = new SimpleHTMLDOM;
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
<?php
if(!empty($a->profile)){
    $profile = $simpleHTML->str_get_html($a->profile);
    $txt = $profile->plaintext;
    echo mb_substr($txt, 0, 300, 'UTF-8'); 
}
?>
                </span>
            </div>
            <div class="ctime">
                    <?php echo $a->start_time === null ? '待定' : substr($a->start_time,0,10); ?>
            </div>
        </li>
<?php
}
?>
    </ul>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/act_list.js"></script>
