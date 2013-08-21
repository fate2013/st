<form action="create" method='POST'>
<input type='text' id='act_subject' name='Activity[subject]' placeholder='题目' required='true' />
<br />
<textarea id='act_profile' placeholder='内容' name='Activity[profile]' cols='60' rows='10'>
</textarea>
<br />
<input type='datetime' id='act_start_time' name='Activity[start_time]' placeholder='开始时间' />
<br />
<input type='datetime' id='act_end_time' name='Activity[end_time]' placeholder='结束时间' />
<br />
<input type='submit' value='提交' />
</form>
