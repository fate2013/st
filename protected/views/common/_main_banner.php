<div class='main_banner'>
    <div class='main_bar'>
    </div>
    <div class='wrapper'>
        <div class='round_bar'>
            <div class='portrait'>
                <a href='/user/portrait' style='float:left'><img class='portrait_img' width='136px' height='136px' src='<?php echo Yii::app()->session['user']->profile && Yii::app()->session['user']->profile->portrait? Yii::app()->session['user']->profile->portrait : '/images/tx.png';?>' /></a>
            </div>
            <div class='portrait_name'>
                <span><?php echo Yii::app()->session['user']->displayname();?></span>
                <input type="text" style="display:none;background:none;width:60px;border:1px solid #65B1EB;height:17px;font-size:12px;" />
            </div>
        </div>
    </div>
</div>

