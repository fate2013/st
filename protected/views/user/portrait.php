<p>头像修改:</p>
<div>
    <object id="FaustCplus" height="500" width="650" type="application/x-shockwave-flash" data="/images/Face_v2.swf">
        <param name="menu" value="false">
        <param name="scale" value="noScale">
        <param name="allowFullscreen" value="true">
        <param name="allowScriptAccess" value="always">
        <param name="wmode" value="transparent">
        <param name="bgcolor" value="#FFFFFF">
        <param name="flashvars" value="jsfunc=uploadevent&imgUrl=/images/moren.jpg&pid=0&uploadSrc=true&showBrow=true&showCame=true&uploadUrl=/user/portrait/type/upload">
    </object>
</div>
<script>
function uploadevent(status){
    if(status==1){
        window.location = '/user/myrelease';
    } else if(status == 0){
        alert('上传失败');
    }
}
</script>
