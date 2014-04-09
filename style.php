<meta name="author" content="周文博" />
<meta name="description" content="小小的前端工程师，自说自话，自娱自乐的小网站" />
<meta name="keywords" content="web,前端,html,html5,css,css3,javascript" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo projectRoot();?>image/favicon.ico" />
<link rel="stylesheet" href="<?php echo projectRoot();?>style/style.css" />
<link rel="stylesheet" href="<?php echo projectRoot();?>script/plugin/clippy/clippy.css" />
<!--[if lt IE 9]>
<link rel="stylesheet" href="<?php echo projectRoot();?>style/ie.css" />
<script src="<?php echo projectRoot();?>script/ie.js"></script>
<![endif]-->
<?php
if( isset( $_COOKIE['color'] ) ){
    $_SESSION['color'] = $_COOKIE['color'];
}
if( isset( $_SESSION['color'] ) ){
    echo '<style>.module,.Header{background-color:#'. $_SESSION['color'] .';}</style>';
}
?>