<?php
require_once('../include/Config.inc.php');
/**
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>个人资料</title>
<?php require_once('../style.php');?>
<style>
.module-profile{height:150px;}
</style>
</head>
<body>
<div id="Container" class="Container">
<?php require_once('../header.php');?>
    <section class="module module-large module-profile"></section>
    <section class="module module-large module-profile"></section>
    <section class="module module-large module-profile"></section>
    <section class="module module-large module-profile"></section>
    <section class="module module-large module-profile"></section>
<?php require_once('../footer.php');?>
</div>

<script type="text/javascript" src="../script/lib/jQuery/jquery-1.10.2.min.js"></script>
<script>
$(function(){
    var curr = 0,
        section = $('section'),
        sum = section.length;
    $(document).on('click', 'section>h1', function(){
        var self = section.has(this);
        if( !self.hasClass('show') ){console.log(curr);
            section.eq(curr).toggleClass('show');
            curr = section.index(self);
            self.toggleClass('show');
        }
        else{
            self.toggleClass('show');
            curr = (curr+1)%sum;
            section.eq(curr).toggleClass('show');
        }
    });
});
</script>
</body>
</html>