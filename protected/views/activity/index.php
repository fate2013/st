<div class="act">
    <div class="title">
    <h2>活动：<?php echo $act->subject;?></h2>
    <span>概要：</span><span><?php echo $act->profile;?></span>
    <br />
    <span>开始时间：</span><span><?php echo $act->start_time;?></span>
    <br />
    <span>结束时间：</span><span><?php echo $act->end_time;?></span>
    <br />
    <span>组织者：</span><span><?php echo $act->organizer->displayname();?></span>
    <br />
    <span>创建时间：</span><span><?php echo $act->created_at;?></span>
    </div>
</div>
