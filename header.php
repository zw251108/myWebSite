<header class="Header">

	<div class="module module-header module-large" id="header">
		<a class="btn btn-big btn-link btn-home" id="home" href="<?php echo projectRoot();?>" title="返回首页"></a>

		<button class="btn btn-big btn-menu<?php echo projectRoot()=='' ? ' hidden' : '';?>" id="menu" type="button" title="显示菜单"></button>
		<button class="btn btn-big btn-copyright" id="copyright" type="button"
				title="copyright &copy; <?php echo date('Y');?> 周文博 All rights reserved"></button>

		<button class="btn btn-big btn-backTop hidden" id="backTop" type="button" title="回到顶部"></button>
	</div>

	<div class="hidden">
		<div>
			<a class="btn btn-big btn-link" href=""></a>
		</div>
	</div>

<!--
    <div class="module module-large module-header">
        <h1 id="logo" class="logo">
            <a href="<?php echo projectRoot();?>">自娱自乐</a>
        </h1>
        <div id="userCard" class="userCard userCard-header userCard-min">
            <img class="userCard_avatar" src="<?php echo projectRoot();?>image/default/default_avatar.jpg" width="60" height="60" alt="" />

            <form id="loginForm" class="form" action="<?php echo projectRoot();?>user/userLogin.php">
                <input type="text" class="input" name="email" id="email" data-validator="email" placeholder="电子邮箱" />
                <label for="email" class="tips tips-bottom hidden"></label>
                <input type="password" class="input" name="password" id="password" data-validator="password" placeholder="密码" />
                <label for="password" class="tips tips-bottom hidden"></label>
                <input type="submit" class="btn btn-submit" id="btnSubmit" value="登录"/>
            </form>
        </div>

        <div id="userMsg" class="tips tips-left hidden">
            <div id="userMsgContent" class="tips_content"></div>
            <span class="tips_arrow hidden"></span>
        </div>
    </div>
-->

<!--
    <hgroup>
        <h1>Welcome to { user_name }'s blog</h1>
        游离于理想与现实之间，还会坚持，坚持到坚持不下去为止
        <h2><br />和设计师一样细腻，
        <br />和工程师一样严谨；
        <br />游走在设计师和工程师之间，
        <br />游刃于用户体验和技术实现之间，
        <br />斡旋在用户利益和商业利益之间。
        <br />——前端开发工程师</h2>

        为API生，为框架死，为debug奋斗一辈子，吃符号亏，上大小写的当，最后死在需求上~
    </hgroup>
-->
</header>

<!--<div class="tools hidden" id="Tools">-->
<!--</div>-->