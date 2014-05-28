<?php
/**
 * todo 页脚
 */
?>
<!--<footer class="Footer">-->
<!--<div class="module module-footer module-link module-large">-->
<!--
	    <h2 class="module_title">网站地图</h2>
	    <nav>
	        <h3>导航</h3>
	        <ul>
	            <li><a href="<?php echo projectRoot();?>">首页</a></li>
	            <li><a href="<?php echo projectRoot();?>document/">前端文档</a></li>
	            <li><a href="<?php echo projectRoot();?>palette/">调色板</a></li>
	        </ul>
	    </nav>
	    <nav>
	        <h3>联系我们</h3>
	    </nav>
	    <section>
	        <h3>更新记录</h3>
	    </section>
-->
<!--	<p>copyright &copy; --><?php //echo date('Y');?><!-- 周文博 All rights reserved </p>-->
<!--</div>-->
<!--</footer>-->

<section class="module module-large module-advert hidden">
    <h2 class="module_title">可耻的广告区</h2>
</section>

<div class="clearfix"></div>

<div id="statistics" class="hidden"></div>
<?php
require_once('include/User.class.php');
/**
 *  输出用户信息
 */
$user = new User();
$userInfo = isset( $_SESSION['userId'] ) ? $user->selectById( $_SESSION['userId'] ) : null;
?>
<script>
var USER_INFO = <?php echo json_encode($userInfo);?>,
    shim = ['jquery'],
    MODULE_CONFIG = {
        shim:{
            extend:shim,
            clippy:shim,
            validator:shim
        },
        paths:{
            jquery:'<?php echo projectRoot();?>lib/jQuery/jquery.min',
            global:'<?php echo projectRoot();?>module/global',
            extend:'<?php echo projectRoot();?>ui/jquery.extend',
            clippy:'<?php echo projectRoot();?>plugin/clippy/clippy.min',
            validator:'<?php echo projectRoot();?>ui/jquery.validator'
        }
    };
</script>