<head>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js'></script>
<style>
li{display:inline;margin-right: 30px;cursor:pointer;}
li img{height: 200px;}
</style>
</head>

<body>
<ul>
<?php
    foreach($files as $file){
        echo "<li><img src='$file' /></li>";
    }
?>
</ul>

<script>
// Helper function to get parameters from the query string.
function getUrlParam( paramName ) {
    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' ) ;
    var match = window.location.search.match(reParam) ;
    
    return ( match && match.length > 1 ) ? match[ 1 ] : null ;
}
function bind_select_img(){
    $('li').click(function(){
        var funcNum = getUrlParam( 'CKEditorFuncNum' );
        var fileUrl = $(this).children('img').attr('src');
        window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
        window.close();
    });
}
bind_select_img();
</script>
</body>
