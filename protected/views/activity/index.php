<style>
.left_content{display:none;}
.content{margin: 0 auto;float:none;overflow: visible;}
.content_bar{-webkit-border-top-left-radius: 6px;-moz-top-left-border-radius: 6px;border-top-left-radius: 6px;}
.main{padding-bottom: 30px;}
</style>

<div class="act">
    <div class='title'><h1><?php echo $act->subject;?></h1></div>
    <div class='profile'>
        <span>活动时间：</span><span><?php echo substr($act->start_time, 0, 10);?></span>
        <br />
        <span>地点：</span><span><?php echo "{$act->province}&nbsp;{$act->city}";?></span>
        <br />
        <span>组织者：</span><span><?php echo $act->organizer->displayname();?></span>
        <br />
    </div>
    <div class='main_content'>
        <p><?php echo $act->profile;?></p>
    </div>
    <div class='addinfo'>
        <div>参与者：<?php
            $parts = array();
            foreach($act->parts as $p){
                $parts[] = $p->displayname();
            }
            echo count($parts)>0? join($parts, "，") : '无';
        ?>
        </div>
        <div class='createtime'>发表于：<?php echo TimeUtil::getLastTime($act->created_at);?></div>
    </div>

    <div class='act_return'>
        <a href="javascript:back();">返回列表</a>
    </div>
</div>

