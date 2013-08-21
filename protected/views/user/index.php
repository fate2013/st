<div class="recent">
    <div class="title">
        <h2>我发布的活动</h2>
    </div>
    <ul>
<?php
foreach($activities as $a){
?>
        <li>
            <img src="<?php echo $a->organizer->profile->portrait; ?>" class='middle_img' />
            <div>
发布人:
<span><?php echo $a->organizer->displayname(); ?></span>
<span class="subject">
<a href='/activity/index/aid/<?php echo $a->id;?>'><?php echo $a->subject; ?></a></span>
            </div>
        </li>   
<?php
}
?>
    </ul>
</div>

<div class="recent">
    <div class="title">
        <h2>喊我参加的活动</h2>
    </div>
    <ul>
<?php
foreach($relatedActs as $a){
?>
        <li>
            <img src="<?php echo $a->organizer->profile->portrait; ?>" class='middle_img' />
            <div>
发布人:
<span><?php echo $a->organizer->displayname(); ?></span>
<span class="subject">
<a href='/activity/index/aid/<?php echo $a->id;?>'><?php echo $a->subject; ?></a></span>
            </div>
        </li>   
<?php
}
?>
    </ul>
</div>

<div class="recent">
    <div class="title">
        <h2>最近的活动</h2>
    </div>
    <ul>
<?php
foreach($recentActs as $a){
?>
        <li>
            <img src="<?php echo $a->organizer->profile->portrait; ?>" class='middle_img' />
            <div>
发布人:
<span><?php echo $a->organizer->displayname(); ?></span>
<span class="subject">
<a href='/activity/index/aid/<?php echo $a->id;?>'><?php echo $a->subject; ?></a></span>
            </div>
        </li>   
<?php
}
?>
    </ul>
</div>
