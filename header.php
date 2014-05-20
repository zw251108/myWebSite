<header class="Header">

	<nav class="module module-header module-large" id="header">
		<a class="btn btn-big btn-link menu_item-home" id="home" href="<?php echo projectRoot();?>" title="返回首页"></a>

		<button class="btn btn-big btn-menu<?php echo projectRoot()=='' ? ' hidden' : '';?>" id="menu" type="button" title="显示菜单"></button>

		<ul id="headerMenu" class="menu hidden">
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-blog" title="博客" href="<?php echo projectRoot();?>blog/">博客<br />blog</a>
			</li>
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-document" title="前端文档" href="<?php echo projectRoot();?>document/">前端文档<br />document</a>
			</li>
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-editor" title="编辑器" href="<?php echo projectRoot();?>editor/">编辑器<br />editor</a>
			</li>
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-favorite" title="收藏夹" href="<?php echo projectRoot(); ?>favorite/">收藏夹<br />favorite</a>
			</li>
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-rss" title="订阅" href="<?php echo projectRoot(); ?>rss/">订阅<br />rss</a>
			</li>
			<li>
				<a class="btn btn-big btn-link menu_item menu_item-palette" title="调色板" href="<?php echo projectRoot(); ?>palette/">调色板<br />palette</a>
			</li>
		</ul>

		<button class="btn btn-big menu_item-copyright" id="copyright" type="button"
				title="copyright &copy; <?php echo date('Y');?> 周文博 All rights reserved"></button>

		<button class="btn btn-big btn-backTop hidden" id="backTop" type="button" title="回到顶部"></button>
	</nav>

<!--
	<ul class="menu hidden" style="
    width: 100%;
    overflow: hidden;
    position: absolute;
    top: 70px;
    left: 0;
    background: #fff;
">
		<li class="menu_item">
			<a class="btn btn-big btn-link btn-blog" title="博客" href="<?php echo projectRoot();?>blog"></a>
		</li>
		<li class="menu_item">
			<a class="btn btn-big btn-link btn-document" title="前端文档" href="<?php echo projectRoot();?>document"></a>
		</li>
		<li class="menu_item">
			<a class="btn btn-big btn-link btn-editor" title="编辑器" href="<?php echo projectRoot();?>editor"></a>
		</li>
		<li class="menu_item">
			<a class="btn btn-big btn-link btn-favorite" title="收藏夹" href="<?php echo projectRoot(); ?>favorite"></a>
		</li>
		<li class="menu_item">
			<a class="btn btn-big btn-link btn-palette" title="调色板" href="<?php echo projectRoot(); ?>palette"></a>
		</li>
	</ul>
-->

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