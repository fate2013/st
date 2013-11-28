var TIME_INTER = 300;
$(document).ready(function(){
    $('.act_item').click(function(){
        var id = $(this).attr("id").substr(9);
        Nav.go('/activity/index/aid/'+id);
    });

    $('.tool_bar .edit').click(function(){
        var id = $(this).attr("id").substr(5);
        Nav.go('/activity/create/aid/'+id);
        return false;
    });

    $('.act_item').on('click', '.comment_content', function(){
        return false;
    });

    $('.tool_bar .comment').click(function(){
        if($(this).parents('.tool_bar').next('.comment_content').length<1){
            var id = $(this).attr('id');
            var arrtmp = id.split('_');
            var aid = arrtmp[1];
            var cid = arrtmp[2];
            $(this).parents('.tool_bar').after('<div class="comment_content"><textarea></textarea><span class="comment_submit" id="csub_'+aid+'_'+cid+'">评论</span><ul></ul></div>');
            var ul = $(this).parents('.tool_bar').next('.comment_content').children('ul');
            $.get('/activity/listComment', {aid:aid}, function(json){
                for(var i in json){
                    var ele = json[i];
                    var li = getLi(ele, aid);
                    ul.append(li);
                }
            },'json');
        }
        $(this).parents('.tool_bar').next('.comment_content').toggle();
        return false;
    });

    $('.act_item').on('click', '.comment_submit', function(){
        var id = $(this).attr('id');
        var arrtmp = id.split('_');
        var aid = arrtmp[1];
        var cid = arrtmp[2];
        var textarea = $(this).prev('textarea');
        var content = textarea.val();
        var ul = $(this).next('ul');
        $.get('/activity/commentcreate', {aid:aid,cid:cid,content:content}, function(data){
            if(data != -1){
                textarea.val('');
                ul.prepend(getLi(data,aid));
            } else {
                alert('评论失败');
            }
        }, 'json');
    });

    $('.act_item').on('click', '.comment_submit_sub', function(){
        var id = $(this).attr('id');
        var arrtmp = id.split('_');
        var aid = arrtmp[1];
        var cid = arrtmp[2];
        var textarea = $(this).prev('textarea');
        var content = textarea.val();
        var ul = $(this).parents('ul:eq(0)');
        var div = $(this).parent('div');
        $.get('/activity/commentcreate', {aid:aid,cid:cid,content:content}, function(data){
            if(data != -1){
                textarea.val('');
                div.fadeOut(TIME_INTER);
                ul.prepend(getLi(data,aid));
            } else {
                alert('评论失败');
            }
        }, 'json');
    });

    $('.act_item').on('click', '.delcomm', function(){
        var id = $(this).attr('id');
        var arrtmp = id.split('_');
        var cid = arrtmp[1];
        var comm = $(this).parents('li:eq(0)');
        $.get('/activity/delcomment', {cid:cid}, function(data){
            if(data==0){
                comm.fadeOut(TIME_INTER);
            } else {
                alert('删除评论失败');
            }
        }, 'json');
    });

    $('.act_item').on('click', '.tool_bar .join', function(event){
        var id = $(this).attr("id").substr(5);
        var ele = this;
        $.get('/activity/join', {aid:id}, function(data){
            if(data != -1){
                if(data == 0){
                    var text = '待审批';
                } else if(data == 1){
                    var text = '审批通过';
                }
                $(ele).attr('class','quit').text('退出').attr('id', 'quit_'+id);
                $(ele).parent('div').siblings('.first_line').children('.status').text(text);
            }
        }, 'json');
        return false;
    })
    .on('click', '.tool_bar .quit', function(event){
        var id = $(this).attr("id").substr(5);
        var ele = this;
        $.get('/activity/quit', {aid:id}, function(data){
            if(data == '0'){
                $(ele).attr('class','join').text('申请加入').attr('id', 'join_'+id);
                $(ele).parent('div').siblings('.first_line').children('.status').text('');
            }
        }, 'json');
        return false;
    });

    $('.needappr').on('click', '.approve', function(){
        var arrtmp = $(this).attr('id').split('_');
        var aid = arrtmp[1];
        var uid = arrtmp[2];
        var ele = this;
        $.get('/activity/approve', {aid:aid,uid:uid}, function(data){
            if(data == '0'){
                //$(ele).siblings('.appr_msg').find('.appr_status_word').text('审批通过');
                $(ele).parents('li:eq(0)').hide(300);
            }
        }, 'json');
        return false;
    })
    .on('click', '.refuse', function(){
        var arrtmp = $(this).attr('id').split('_');
        var aid = arrtmp[1];
        var uid = arrtmp[2];
        var ele = this;
        $.get('/activity/refuse', {aid:aid,uid:uid}, function(data){
            if(data == '0'){
                //$(ele).siblings('.appr_msg').find('.appr_status_word').text('审批拒绝');
                $(ele).parents('li:eq(0)').hide(300);
            }
        }, 'json');
        return false;
    });
    
    $('.needappr').on('click', '.needappr_word', function(){
        $(this).next('ul').toggle();
        return false;
    });

    $('.act_item').on('click', '.replyto', function(){
        if($(this).parents('.comment_tool').next('.comment_content_sub').length<1){
            var id = $(this).attr('id');
            var arrtmp = id.split('_');
            var aid = arrtmp[1];
            var cid = arrtmp[2];
            $(this).parents('.comment_tool').after('<div class="comment_content_sub"><textarea></textarea><span class="comment_submit_sub" id="csub_'+aid+'_'+cid+'">评论</span></div>');
        }
        $(this).parents('.comment_tool').next('.comment_content_sub').toggle();
        return false;
    });
});

function getLi(ele, aid){
    var li = '<li><img src="'+ele['portrait']+'" /><div class="comment_detail"><a href="javascript:void(0);" class="creator">'+ele['creator']+'</a>';
    if(ele['replyto']){
        li += '回复<a href="javascript:void(0);">'+ele['replyto']+'</a>';
    }
    li += '</a>：'+ele['content']+'</div><div class="comment_tool"><span><a id="replyto_'+aid+'_'+ele['cid']+'" href="javascript:void(0);" class="replyto">回复</a></span>';
    if(ele['uid'] == user.id){
        li += '<span><a id="delcomm_'+ele['cid']+'" class="delcomm" href="javascript:void(0);">删除</a></span>';
    }
    li += '<span class="comment_time">'+ele['createtime']+'</span></div></li>';
    return li;
}
