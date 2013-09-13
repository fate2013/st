<div class='act_filter'>
<a <?php if(!isset($_REQUEST['time']) || $_REQUEST['time']=='all'){?>class='active' <?php }?>href="?time=all">全部</a>
<a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='near'){?>class='active' <?php }?>href="?time=near">最近</a>
<a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='today'){?>class='active' <?php }?>href="?time=today">当天</a>
<a <?php if(isset($_REQUEST['time']) && $_REQUEST['time']=='weekend'){?>class='active' <?php }?>href="?time=weekend">本周末</a>
</div>
