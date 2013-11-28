<ul>
<?php
$simpleHTML = new SimpleHTMLDOM;
$typelist = ActTypeList::$list;
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
        <div class='ftime'>
            <?php echo "发表于".TimeUtil::getLastTime($a->created_at);?>
        </div>
        <div class='out_wrap'>
            <div class="main_wrap">
                <div class="seco_wrap">
                    <div class="first_line">
                        <span class="subject">
                            <?php echo $a->subject; ?>
                        </span>
                        <span class="shuxian">
                        |
                        </span>
                        <span class="type">
                            <?php echo $typelist[$a->type]; ?>
                        </span>
                        <span class="status">
            <?php if($a->userStatus){?>
                            状态：
                            <?php
                switch($a->userStatus->status){
                case UserActivity::STATUS_PENDING:
                    echo '待审批';
                    break;
                case UserActivity::STATUS_APPROVED:
                    echo '审批通过';
                    break;
                case UserActivity::STATUS_REFUSE:
                    echo '审批拒绝';
                    break;
                }
            ?>
            <?php }?>
                        </span>

                        <span class="num">
                            <?php echo '人数：'. ($a->totalnum!=0? count($a->parts).'/'.$a->totalnum : '不限'); ?>
                        </span>
                    </div>
                    <div class="lline">
                        <span class="profile">
            <?php
            if(!empty($a->profile)){
            $profile = $simpleHTML->str_get_html($a->profile);
            $txt = $profile->plaintext;
            echo mb_substr($txt, 0, 300, 'UTF-8'); 
            }
            ?>
                        </span>
                        <div class="ctime">
                            活动时间：<?php echo $a->start_time === null ? '待定' : substr($a->start_time,0,10); ?>
                        </div>
                        <div class="location">
                            活动地点：<?php echo $a->province === '待定' ? '待定' : "{$a->province}&nbsp;{$a->city}"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tool_bar">
<?php
echo '<span><a id="comm_'.$a->id.'_0" class="comment" href="javascript:void(0);"></a></span>';
?>
<?php
if($a->organizer->id != Yii::app()->session['user']->id){
    $joined = false;
    foreach($a->parts as $p){
        if($p->id == Yii::app()->session['user']->id){
            $joined = true;
            break;
        }
    }
    if($joined){
        echo '<span><a id="quit_'.$a->id.'" class="quit" href="javascript:void(0);">退出</a></span>';
    } else {
        echo '<span><a id="join_'.$a->id.'" class="join" href="javascript:void(0);">申请加入</a></span>';
    }
} else {
    echo '<span><a id="del_'.$a->id.'" class="del" href="javascript:void(0);"></a></span>';
    echo '<span><a id="edit_'.$a->id.'" class="edit" href="javascript:void(0);"></a></span>';
}
?>
        </div>
        
<?php 
$hasneedappr = false;
foreach($a->parts as $p){ 
    if($p->status==UserActivity::STATUS_PENDING){
        $hasneedappr = true;
        break;
    }
}

if($a->organizer->id == Yii::app()->session['user']->id && $a->auth==Activity::AUTH_NEED_APPROVAL && $hasneedappr){ 
?>
        <div class='needappr'>
            <span class='needappr_word'>待审批：</span>
            <ul>
<?php foreach($a->parts as $p){ 
if($p->status==UserActivity::STATUS_PENDING){
?>
                <li>
                    <div class='appr_msg'>
                        <img src='<?php echo ($p->profile && $p->profile->portrait ? $p->profile->portrait : ($p->profile && $p->profile->sex==1? UserProfile::DEFAULT_WOMAN_IMG : UserProfile::DEFAULT_PORTRAIT_IMG));?>' />
                        <!--<span class='name'><?php echo $p->displayname();?></span>
                        <span class='appr_word'><?php echo $p->msg? $p->msg : UserActivity::DEFAULT_MESSAGE;?></span>
                        <span class='appr_status'>状态：<span class='appr_status_word'><?php 
switch($p->status){
case UserActivity::STATUS_PENDING:
    echo '审批中';
    break;
case UserActivity::STATUS_APPROVED:
    echo '审批通过';
    break;
case UserActivity::STATUS_REFUSE:
    echo '审批拒绝';
    break;
}
                        ?></span></span>-->
                        <a href="javascript:void(0);" id='appr_<?php echo $a->id.'_'.$p->id;?>' class='approve'>通过</a>
                        <a href="javascript:void(0);" id='refu_<?php echo $a->id.'_'.$p->id;?>' class='refuse'>拒绝</a>
                    </div>
                </li>
<?php }} ?>
            </ul>
        </div>
<?php } ?>
    </div>
</li>
<hr />
<?php
}
?>
</ul>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/act_list.js"></script>
