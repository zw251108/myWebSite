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