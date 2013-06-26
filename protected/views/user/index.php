<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="main">
    <div id="recent">
        <div class="title">
            <h2>最近活动</h2>
        </div>
        <ul>
<?php
foreach($activities as $a){
?>
            <li>
            <img src="<?php echo $a->organizer->profile->portrait; ?>" height="100px" width="100px" />
                <div>
发布人:
    <span><?php echo $a->organizer->displayName(); ?></span>
    <span class="subject"><?php echo $a->subject; ?></span>
                </div>
            </li>   
<?php
}
?>
        </ul>
    </div>
</div>
