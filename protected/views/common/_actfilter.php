<div class='act_filter'>
    <div class='time_filter filter_line'>
        <span class='dimen'>时间：</span>
        <a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='near'){?>class='active' <?php }?>href="?time=near">最近</a>
        <a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='today'){?>class='active' <?php }?>href="?time=today">当天</a>
        <a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='weekend'){?>class='active' <?php }?>href="?time=weekend">本周末</a>
    </div>
    <div class='location_filter filter_line'>
        <span class='dimen'>类型：</span>
        <a <?php if(!isset($_REQUEST['type']) || $_REQUEST['type']=='all'){?>class='active' <?php }?>href="?type=all">全部</a>
<?php 
foreach(ActTypeList::$list as $type=>$tStr){
    if($type == 0)
        continue;
    $str = '<a ';
    if(isset($_REQUEST['type']) && $_REQUEST['type']==$type){
        $str .= 'class="active" ';
    }
    $str .= "href='?type={$type}'>{$tStr}</a>";
    echo $str;
}
?>
    </div>
</div>
