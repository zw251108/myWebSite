<?php
/**
 *  todo
 * */
require_once('../include/Config.inc.php');

//$raw = '22.11.2001';
//$start = DateTime::createFromFormat('d.m.Y', $raw);
//echo $start->format('m/d/Y');
//
//$end = clone $start;
//$end->add(new DateInterval('P1M6D'));
//$diff = $end->diff( $start );
//echo $diff->format('%m %d(%a days)');
//
//$juice = 'plum';
//echo "I drank some juice made of $juice";

//echo @json_encode( array() );
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Web 前端编码规范</title>
<?php require_once('../style.php');?>
<link rel="stylesheet" href="../script/plugin/syntaxhighlighter/style/shCoreDefault.css"/>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-large module-main module-document" id="doc">
    <h2 class="module_title">前端文档 document</h2>
    <div class="module_content">
        <section class="document_section section">
            <h3 class="section_title">前言
                <span class="icon-CSS icon-minus"></span>
            </h3>
			<dl>
				<dt class="icon icon-arrow-r">为何规范</dt>
				<dd>
					<p>规范并不是一种限制，而是约定，强调团队的一致性；加强团队之间的合作，提高协作效率，优化项目和流程，形成一种团队文化；产品设计通过规范的方式来达到以用户为中心的目的；以标准化的方式设计界面，使最终设计出来的界面风格一致化；前端开发编码人员相互之间开发更轻松，同时便于服务器端开发人员添加功能及前端后期优化维护；最终是为项目服务的，遵循统一的操作规范，减少和改变责任不明，任务不清和由此产生的信息沟通不畅、反复修改、重复劳动、效率低下的现象，提高工作效率。</p>

					<p>其中编程风格是编码规范的一种，用来规约单文件中代码的规划。编码规范还包含编程最佳实践、文件和目录的规划以及注释等方面。一旦编程风格确立后，这套编程风格就会促成团队成员高水准的协作，因为所有代码的风格看起来极为类似，任何开发者都不会在乎某个文件的作者是谁，代码具备可读性、可预测性，也就没有必要花费额外精力去理解代码逻辑并重新排版，很容易地识别出问题代码并发现错误。</p>

					<p>编程最佳实践是另外一类编程规范。编程风格关心代码的呈现，编程实践则关心编码的结果。设计模式是编程实践的组成部分，专用于解决和软件组织相关的特定问题</p>
				</dd>
				<dt class="icon icon-arrow-r">基本准则</dt>
				<dd>
					<p>符合 Web2.0 标准，语义化
						HTML，结构、表现、行为三层分离，兼容性优良，页面性能方便，代码简洁明了有序，尽可能的减少服务器负载，保证最快的解析速度，书写所有人都可以看的懂的代码。简洁易懂是一种美德，为用户着想，为服务器着想</p>

					<p>在 Web 开发中，用户界面（User Interface,UI）是由三个彼此隔离又相互作用的层定义的：</p>

					<ul>
						<li>HTML 用来定义页面的数据和语义</li>
						<li>CSS 用来给页面添加样式，创造视觉特征</li>
						<li>JavaScript 用来给页面添加行为，使其更具交互性</li>
					</ul>

<!--					<p>数据不应当影响指令的正常运行的，精心设计的应用应当将关键数据从主要的源码中抽离出来，配置数据：URL、需要展现给用户的字符串、重复的值、设置（比如每页的配置项）、任何可能发生变更的值，配置数据最好放在单独的文件中，以便清晰的分隔数据和应用逻辑，一种值得尝试的做法是将配置数据存放于非 JavaScript 文件中</p>-->
				</dd>
				<dt class="icon icon-arrow-r">文件规范</dt>
				<dd>以项目名称建立文件夹，以日期建立文件夹区别版本，最终版本须有以下几个文件夹：html、psd、jpg、需求资料。html
					文件夹里有 style、script、image、media（放置视频、音频和
					flash 文件）。另：如果项目较多，需要给每个项目名称前上首个拼音的大写字母，例如：K-宽系列。
				</dd>
				<dt class="icon icon-arrow-r">关于优化</dt>
				<dd>
					<p>从用户角度而言，优化能够让页面加载得更快、对用户的操作响应得更及时，能够给用户提供更为友好的体验</p>

					<p>从服务商角度而言，优化能够减少页面请求数、或者减小请求所占带宽，能够节省可观的资源</p>
				</dd>
				<dt class="icon icon-arrow-r">备注</dt>
				<dd>本规范文档一经确认，前端人员必须按文档规范进行前端页面开发。本文档如有不对或者不合格的地方请及时提出，经讨论后决定可以修改此文档</dd>
				<dt class="icon icon-arrow-r">版本</dt>
				<dd>以下关于 jQuery 部分，是基于 jQuery 1.7 版本</dd>
				<dt class="icon icon-arrow-r">设计部分</dt>
				<dd>设计部分只是建议，是值得关注的一些细节，应该在项目正式开始编码前就将细节确定好，否则后期的细节改动对前端的影响是巨大的</dd>
				<dt class="icon icon-arrow-r">吐槽部分</dt>
				<dd>
					<p>规范的目标应该是使所有的代码应看似出自一人之手，即使奶妈有多人。风格统一了，就有了一个共同思维的环境，参与者就可以专注的看你要说什么，而不是先想你是在说哪星球的语言。虽然我们在这里提出统一样式规则，但就只是想让大家都知晓并借鉴而对自己的风格进行修正。当然，保持自己独有的风格也是很重要的。balabala。。。</p>

					<p>所谓的最佳实践是用来限制那些糟糕程序员的破坏力，唯一的最佳实践就是使用你的大脑</p>

					<p>本来最初只是想写一个关于优化方面的文档，但随着不断学习，发现自己不懂的太多了，逐渐变成了编码规范。。。</p>

					<p>关于本文档的阅读体验方面，一直在努力，所以就请不要吐槽了。。。</p>
				</dd>
				<dt class="icon icon-arrow-r">声明</dt>
				<dd>
					<p>在我还能保持住我的耐心与理智的情况下，我都会按照此标准进行开发，并衷心的希望您也能如此。。。</p>

					<p>以下内容均为读书学习所得和个人开发经验积累，同时当前并不是最终版本，将会随时更新</p>

					<p>若有错误，欢迎勘误，若有误导，概不负责，若有异议，可以讨论。。。若有雷同，纯属你抄袭，我将保留付诸于法律的权力</p>
				</dd>
			</dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">HTML 编码规范
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">文件命名</dt>
                <dd>英文命名，后缀为 .html，同时同目录需创建“必读.txt”文件，里面须有二级目录和对应的 HTML
					文件，以及提醒开发人员需要注意的地方，以方便开发人员添加功能时查找对应页面。</dd>
                <dt class="icon icon-arrow-r">文档类型声明及编码</dt>
                <dd>
                    <p>统一为 html5 声明类型 <span class="code">&lt;!DOCTYPE html&gt;</span>；编码统一为
						<span class="code">&lt;meta charset="utf-8" /&gt;</span>（注：要在
						<span class="code">&lt;head&gt;</span> 元素中；在任何其它内容之前，也就是要在
						<span class="code">&lt;head&gt;</span> 元素中的最前面，包括空格和
						<span class="code">&lt;!DOCTYPE html&gt;</span> 文档声明在内，要在前 512 个字节之内）</p>

                    <p>书写时用 IDE 实现层次分明的缩进，但在发布前应利用自动化工具删除注释、空格与缩进，压缩 HTML
						文件的体积，因为这些对浏览器不重要</p>
                </dd>
				<dt class="icon icon-arrow-r">语言属性</dt>
				<dd>根据 HTML5 规范：强烈建议为 <span class="code">&lt;html&gt;</span> 根元素指定
					<span class="code">lang</span>
					属性，从而为文档设置正确的语言。这将有助于语音合成工具确定其所应该采用的发音，有助于翻译工具确定其翻译时所应遵守的规则等</dd>
                <dt class="icon icon-arrow-r">meta</dt>
                <dd>
                    <p><span class="code">keyword</span>、<span class="code">content</span> 对于网站的 SEO
						很重要，页面描述不超过 150 个字符；<span class="code">author</span>
						定义网页作者；<span class="code">robots</span>
						定义网页搜索引擎方式，值为一组使用英文逗号“,”分割的值，通常有如下几种取值：<span class="code">none</span>，<span class="code">noindex</span>，<span class="code">nofollow</span>，<span class="code">all</span>，<span class="code">index</span>
						和 <span class="code">follow</span>，如：</p>

					<pre class="brush:html">
						&lt;meta name="description" content="web 前端开发编码规范" /&gt;
						&lt;meta name="keywords" content="web,前端,js,css,html" /&gt;
						&lt;!-- 定义网页作者 --&gt;
						&lt;meta name="author" content="name,email@email.com" /&gt;
						&lt;!-- 定义网页搜索引擎方式 --&gt;
						&lt;meta name="robots" content="index,follow" /&gt;
                    </pre>

                    <p><span class="code">X-UA-Compatible</span> 是用来描述文件在某些浏览器上的渲染程度，不允许设置为
						<span class="code">IE=7</span> 来兼容 IE8</p>

                    <pre class="brush:html">
                        &lt;!-- 不允许使用 --&gt;
                        &lt;meta http-equiv="X-UA-Compatible" content="IE=7" /&gt;

                        &lt;!-- 正确用法 --&gt;
                        &lt;meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /&gt;
                    </pre>

                    <p>也可以在服务器端设置该参数，参考服务器端优化</p>

					<p>RSS 订阅</p>

					<pre class="brush:html">
						&lt;link rel="alternate" type="application/rss+xml" title="RSS" href="rss.xml" /&gt;
                    </pre>

					<p>favicon icon</p>

					<pre class="brush:html">
						&lt;link rel="shortcut icon" type="image/ico" href="favicon.ico" /&gt;
                    </pre>

                    <p>随着移动开发，逐渐添加了额外的属性</p>

					<p>响应式布局获取设备宽度</p>

                    <pre class="brush:html">
                        &lt;meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" /&gt;
                    </pre>

					<p>iOS 设备</p>

                    <p>告诉 iphone 的 safari 浏览器，这个网站对应的 app 是什么，然后在页面上面显示一个下载 banner</p>

                    <pre class="brush:html">
                        &lt;meta name="apple-itunes-app" content="app-id=xxxxxxxxx" /&gt;

						&lt;meta name="format-detection" content="telephone=no" /&gt;
                    </pre>

					<p>Windows 8</p>

					<pre class="brush:html">
						&lt;!-- Windows 8 磁贴背景颜色 --&gt;
						&lt;meta name="msapplication-TileColor" content="#000" /&gt;
						&lt;!-- Windows 8 磁贴图片 --&gt;
						&lt;meta name="msapplacation-TileImage" content="icon.png" /&gt;
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">title</dt>
                <dd>永远在 <span class="code">&lt;title&gt;</span> 元素中给出页面的简单介绍</dd>
                <dt class="icon icon-arrow-r">协议</dt>
                <dd>
                    <p>绝对 URL 都以 HTTP 或 HTTPS 等协议头开始，如果能确定 URL 的协议与当前页面 URL 的协议是一致的，或者说该
						URL 在多种协议下均是可用的，则可以考虑删除这个协议头，如果不是这两个声明的 URL 则不能省略</p>

                    <p>省略协议声明，使 URL 成相对地址，防止内容混淆问题和导致小文件重复下载，如：</p>

                    <pre class="brush:html">
                        &lt;script src="//www.google.com/js/gweb/analytics/autotrack.js"&gt;&lt;/script&gt;
                    </pre>

                    <p>但对于 CSS，如果删除协议头在 IE7、IE8 下会造成 CSS 文件下载两次</p>
                </dd>
                <dt class="icon icon-arrow-r">外部 CSS 文件</dt>
                <dd>
                    <p>非特殊情况下样式文件必须外链至 <span class="code">&lt;head&gt;</span>
						元素内，浏览器在渲染页面时就能尽早的知道每个标签的样式</p>

                    <p>省略掉类型声明 <span class="code">type</span> 属性，除非不用 CSS，因为 HTML5 中默认
						<span class="code">type</span> 为 <span class="code">text/css</span>
						类型，<span class="code">&lt;link&gt;</span> 标签的 <span class="code">media</span>
						属性若未特殊设置值则的默认值是 <span class="code">all</span>，所以可以省略如：</p>

                    <pre class="brush:html">
                        &lt;link rel="stylesheet" href="style/style.css" /&gt;
                    </pre>

                    <p>站内资源使用相对路径有利于提高效率</p>
                </dd>
                <dt class="icon icon-arrow-r">外部 JS 文件</dt>
                <dd>
                    <p>非特殊情况下 JavaScript 文件必须外链至页面底部 <span class="code">&lt;/body&gt;</span>
						之前，对于 JavaScript 来说，因为它在执行过程中会阻塞页面的渲染</p>

                    <p>省略掉类型声明 <span class="code">type</span> 属性，除非不用 JavaScript，因为 HTML5 中默认
						<span class="code">type</span> 为 <span class="code">text/javascript</span>
						类型；文件须包含库名称及版本号，以及是否为压缩版；引用插件，文件名为库名+插件名称，如：</p>

                    <pre class="brush:html">
                        &lt;script src="jquery.1.71.min.js"&gt;&lt;/script&gt;
                        &lt;script src="jquery.cookie.js"&gt;&lt;/script&gt;
                        &lt;script src="script/script.js"&gt;&lt;/script&gt;
                    </pre>

                    <p>站内资源使用相对路径有利于提高效率</p>
                </dd>
                <dt class="icon icon-arrow-r">语义化 HTML</dt>
                <dd>
                    <p>使用 HTML 标签的语义来表述页面，体现文档的结构，并有利于搜索引擎的查询，如：</p>

                    <p>标题根据重要性用 h*(每个根节点与节点元素中只能有一个
						<span class="code">&lt;h1&gt;</span>，备注：<span class="code">&lt;hgroup&gt;</span>
						标签已被取消)</p>

                    <p>段落标记用 <span class="code">&lt;p&gt;</span>，无序列表
						<span class="code">&lt;ul&gt;</span>，有序列表 <span class="code">&lt;ol&gt;</span>，定义列表
						<span class="code">&lt;dl&gt;</span>，链接、锚点用 <span class="code">&lt;a&gt;</span></p>

                    <p>使用节点元素 <span class="code">&lt;section&gt;</span>
						标签对页面文档结构进行划分，主要对页面上的内容进行层次结构上的划分</p>

                    <p><span class="code">&lt;header&gt;</span> 定义页头，<span class="code">&lt;footer&gt;</span>
						定义页脚</p>

                    <p>使用 <span class="code">&lt;nav&gt;</span> 元素来作为页面导航的元素</p>

                    <p><span class="code">&lt;div&gt;、&lt;span&gt;</span> 元素本身并没有语义，避免使用没有
						<span class="code">class</span> 属性的
						<span class="code">&lt;div&gt;</span>、<span class="code">&lt;span&gt;</span> 元素</p>

                    <p>不允许使用 <span class="code">&lt;b&gt;</span>、<span class="code">&lt;i&gt;</span>
						元素来表示加粗和斜体字，使用 <span class="code">&lt;strong&gt;</span> 和
						<span class="code">&lt;em&gt;</span> 元素，虽然效果相同，但这是从语义上考虑的，同理，不允许使用
						<span class="code">&lt;s&gt;</span>、<span class="code">&lt;strike&gt;</span>
						元素来表示文字被删除，可以使用
						<span class="code">&lt;del&gt;</span>、<span class="code">&lt;ins&gt;</span>
						标签来表示删除与添加</p>

                    <p>保证每个页面可以通过工具（如：Chrome 的 HTML5 Outliner 扩展等）生成合理的文档大纲</p>
                </dd>
                <dt class="icon icon-arrow-r">标签与属性</dt>
                <dd>
                    <p>所有编码均遵循 XHTML 标准，标签、属性、属性值命名必须由小写字母、减号及数字组成（除了文本和
						CDATA），且所有标签必须闭合，如：<span class="code">&lt;br /&gt;</span>、<span class="code">&lt;hr /&gt;</span> 等</p>

                    <p>尽可能少使用标签，仅仅使用必要的标签（不仅能让文件保持小巧，下载速度快，浏览器也能够很快完成文档的解析，得到更快的呈现速度），虽然 HTML5 规范中指定了一些可以省略的标签，但不推荐</p>

                    <p>充分利用无兼容性问题的 HTML
						自身标签，比如：<span class="code">&lt;span&gt;</span>、<span class="code">&lt;em&gt;</span>、<span class="code">&lt;strong&gt;</span>、<span class="code">&lt;optgroup&gt;</span>、<span class="code">&lt;label&gt;</span>
						等</p>

                    <p>不允许使用
						<span class="code">&lt;blink&gt;</span>、<span class="code">&lt;marquee&gt;</span>、<span class="code">&lt;xmp&gt;</span>
						等有兼容性问题的标签</p>

                    <p>页面中所有文字均需要在闭合的标签内</p>

                    <p>属性值必须用双引号包裹</p>

                    <p>不允许使用
						<span class="code">font</span>、<span class="code">bgColor</span>、<span class="code">border</span>、<span class="code">align</span>、<span class="code">hspace</span>、<span class="code">vspace</span>
						等属性</p>

                    <p>忽略标签的默认属性，如：<span class="code">&lt;style&gt;</span>、<span class="code">&lt;link&gt;</span>
						元素的 <span class="code">media</span> 属性默认值为
						<span class="code">all</span>，<span class="code">&lt;form&gt;</span> 元素的
						<span class="code">method</span> 属性默认值为
						<span class="code">get</span>，<span class="code">&lt;input&gt;</span> 的
						<span class="code">type</span> 属性默认值为 <span class="code">text</span></p>

                    <p>需要为 HTML 元素添加自定义属性的时候，首先要考虑下有没有默认的已有的合适属性去设置，如果没有，可以使用以
						<span class="code">data-</span> 为前缀来添加自定义属性，避免使用 <span class="code">dataX=""</span>
						等其他命名方式，如：<span class="code">data-default="123"</span></p>

                    <p>给重要的元素和截断的元素加上 <span class="code">title</span> 属性</p>

                    <p>原则上不允许使用 <span class="code">style</span> 属性，若页面中的 CSS 代码足够少，则可以写在
						<span class="code">style</span> 标签里放在 <span class="code">&lt;head&gt;</span> 元素中</p>

                    <p>禁止使用 <span class="code">onclick</span> 等事件属性，若页面中的 JS 代码足够少，则可以写在
						<span class="code">script</span> 标签里放在 <span class="code">&lt;/body&gt;</span> 前</p>

                    <p><span class="code">&lt;script&gt;</span> 元素的 <span class="code">async</span>
						属性对优化非常重要，需要注意的是，如果有多个使用这种方式异步加载的脚本，他们是没有特定的执行顺序的，对于低版本的
						IE 浏览器，则尽可能使用 <span class="code">defer</span> 属性</p>

                    <p>在表格定义中，使用 <span class="code">&lt;thead&gt;</span> 来定义表头，使用
						<span class="code">&lt;tfoot&gt;</span> 来定义表注，注意 <span class="code">&lt;tfoot&gt;</span>
						元素必须出现在 <span class="code">&lt;tbody&gt;</span>
						之前，这样浏览器就可以在接受到所有数据之前呈现表注了，使用 <span class="code">&lt;caption&gt;</span>
						来定义表格标题，使用 <span class="code">&lt;colgroup&gt;</span>
						来定义表格列的分组，使用 <span class="code">&lt;col&gt;</span>
						来为表格列定义属性。表格正确结构为：</p>

                    <pre class="brush:html">
                        &lt;table&gt;
                            &lt;caption&gt;一个标准表格&lt;/caption&gt;
                            &lt;!-- 如果您希望为一组表格列规定相同的属性值，使用 colgroup 元素 --&gt;
                            &lt;colgroup class="colgroup-1" span="1"/&gt;
                            &lt;!-- 如果您希望为多个表格列规定不同的属性值，使用 col 元素 --&gt;
                            &lt;col class="col-1"/&gt;

                            &lt;!-- 表头 --&gt;
                            &lt;thead&gt;
                            &lt;tr&gt;
                                &lt;th&gt;表头&lt;th&gt;
                            &lt;/tr&gt;
                            &lt;/thead&gt;

                            &lt;!-- 表注 --&gt;
                            &lt;tfoot&gt;
                            &lt;tr&gt;
                                &lt;td&gt;表注&lt;td&gt;
                            &lt;/tr&gt;
                            &lt;/tfoot&gt;

                            &lt;!-- 表格主体 --&gt;
                            &lt;tbody&gt;
                            &lt;tr&gt;
                                &lt;td&gt;表格数据&lt;td&gt;
                            &lt;/tr&gt;
                            &lt;/tbody&gt;
                        &lt;/table&gt;
                    </pre>

                    <p><span class="code">&lt;img&gt;</span>、<span class="code">&lt;canvas&gt;</span>、<span class="code">&lt;video&gt;</span>
						等标签的 <span class="code">width</span>、<span class="code">height</span>
						属性是必填的，可以在浏览器获取其内容前渲染时知道该标签的渲染面积，防止渲染过程中的重绘（repaint）和重排（reflow），这些标签元素对应的
						CSS 样式中也需写明 <span class="code">width</span>、<span class="code">height</span>，但是这不意味着通过设置
						<span class="code">width</span>、<span class="code">height</span> 来改变缩放图片，除此之外的标签则不允许使用
						<span class="code">width</span>、<span class="code">height</span> 属性</p>

                    <p><span class="code">&lt;textarea&gt;</span> 元素可以通过 <span class="code">cols</span> 和
						<span class="code">rows</span> 属性来规定 <span class="code">&lt;textarea&gt;</span>
						的尺寸（文本输入区内的文本行间，用 <span class="code">%OD%OA</span>（回车/换行）进行分隔），可以通过
						<span class="code">wrap</span> 属性设置文本输入区内的换行模式</p>
                </dd>
                <dt class="icon icon-arrow-r">class 和 id 属性</dt>
                <dd>
                    <p><span class="code">class</span> 和 <span class="code">id</span> 属性参见 CSS 书写规范</p>

                    <p>给每一个表格和表单加上一个唯一的、结构标记 <span class="code">id</span></p>
                </dd>
                <dt class="icon icon-arrow-r">body 上的 id</dt>
                <dd>应用到 <span class="code">&lt;body&gt;</span> 元素上的 <span class="code">id</span> 叫做 CSS
					签名（CSS Signature）用户自定义的样式表可以覆盖页面中的部分甚至所有 CSS 样式，可根据项目需求来使用</dd>
                <dt class="icon icon-arrow-r">accesskey</dt>
                <dd>
                    <p>以下元素支持 <span class="code">accesskey</span>
						属性：<span class="code">&lt;a&gt;</span>、<span class="code">&lt;area&gt;</span>、<span class="code">&lt;button&gt;</span>、<span class="code">&lt;input&gt;</span>、<span class="code">&lt;label&gt;</span>、<span class="code">&lt;legend&gt;</span>、<span class="code">&lt;textarea&gt;</span>，如：</p>

                    <a href="../" target="_blank" accesskey="q" title="快捷键为 q"></a>

                    <pre class="brush:html">
                        &lt;a href="../" accesskey="q"&gt;设置快捷键 q&lt;/a&gt;
                    </pre>

                    <p><span class="code">accesskey</span> 属性规定激活（使元素获得焦点）元素的快捷键，除 Opera
						外所有浏览器都支持 <span class="code">accesskey</span> 属性</p>

                    <p>但不同系统与不同浏览器对快捷键的使用方式不同，如：windows 下 IE、Chrome 为 alt + 所设的快捷键，Firefox
						则为 alt + shift + 所设的快捷键</p>

                    <p>随着移动设备的兴起，该属性不再推荐使用，若使用也只建议对导航型的元素来使用</p>
                </dd>
                <dt class="icon icon-arrow-r">标签嵌套</dt>
                <dd>
                    <p>尽可能减少 <span class="code">&lt;div&gt;</span> 元素的嵌套，<span class="code">div</span>
						用来表示结构，一般不要超过 3 层（个人建议：当写你一个 <span class="code">div</span>
						标签，该标签的上一层不是 <span class="code">div</span> 标签时，你应该考虑用其它标签替代它了。。。）</p>

                    <p><span class="code">&lt;a&gt;</span>
						里不可以嵌套交互式元素（<span class="code">&lt;a&gt;</span>、<span class="code">&lt;button&gt;</span>、<span class="code">&lt;select&gt;</span>
						等）</p>

                    <p><span class="code">&lt;p&gt;</span> 元素中不可以嵌套
						<span class="code">&lt;div&gt;</span>、<span class="code">&lt;h1&gt;</span>~<span class="code">&lt;h6&gt;</span>、<span class="code">&lt;p&gt;</span>、 <span class="code">&lt;ul&gt;</span>/<span class="code">&lt;ol&gt;</span>/<span class="code">&lt;li&gt;</span>、 <span class="code">&lt;dl&gt;</span>/<span class="code">&lt;dt&gt;</span>/<span class="code">&lt;dd&gt;</span>、 <span class="code">&lt;form&gt;</span>
						等</p>
<!--            <p>内联元素中不可嵌套块级元素（在最新的 HTML5 规范中，a 标签似乎可以嵌套块级元素，以便于移动应用）</p>-->
                    <p>删除不必要的标签，如：<span class="code">&lt;ul&gt;</span> 为块元素，则不需要再使用
						<span class="code">div</span> 将其包裹</p>

                    <p>应将 <span class="code">form</span> 标签嵌套在 <span class="code">table</span> 或
						<span class="code">ul</span> 标签外部</p>
                </dd>
                <dt class="icon icon-arrow-r">表单</dt>
                <dd>
                    <p>必须为含有描述性表单元素（<span class="code">&lt;input&gt;</span>、<span class="code">&lt;textarea&gt;</span>）添加
						<span class="code">&lt;label&gt;</span> 元素，且 <span class="code">&lt;label&gt;</span> 元素的
						<span class="code">for</span> 属性必须与表单元素的 <span class="code">id</span> 属性一一对应</p>

                    <p>若表单元素为 <span class="code">radio</span> 或 <span class="code">checkbox</span> 类型，则可以用
						<span class="code">&lt;label&gt;</span> 元素将其嵌套，如：</p>

                    <pre class="brush:html">
                        &lt;label&gt;&lt;input type="radio" name="sex" /&gt;未知&lt;/label&gt;
                    </pre>

					<p>推荐只在表单中使用 <span class="code">&lt;input&gt;</span> 元素来创建按钮，如果在表单中使用
						<span class="code">&lt;button&gt;</span> 元素，不同的浏览器会提交不同的按钮值，IE 将提交
						<span class="code">&lt;button&gt;</span> 与 <span class="code">&lt;/button&gt;</span>
						之间的文本，而其他浏览器将提交 <span class="code">value</span> 属性的内容。在表单外的按钮使用
						<span class="code">&lt;button&gt;</span> 元素，但始终要为按钮规定 <span class="code">type</span>
						属性。不同的浏览器根据 <span class="code">type</span> 属性使用不同的默认值</p>
                </dd>
                <dt class="icon icon-arrow-r">table 标签</dt>
                <dd>
                    <p>尽量避免使用 <span class="code">table</span> 标签，请不要用
						<span class="code">width</span>、<span class="code">height</span>、<span class="code">cellspacing</span>、<span class="code">cellpadding</span>
						等 <span class="code">&lt;table&gt;</span> 元素的属性直接定义表现，应尽可能的利用
						<span class="code">table</span> 自身私有属性分离结构与表现，在 base.css 文件中初始化表格样式</p>

                    <pre class="brush:css">
                        table{border:0;margin:0;border-collapse:collapse;}
                        th, td{padding:0;}
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">链接</dt>
                <dd>
                    <p>避免重定向，即须在 URL 地址后面加上 "<span class="code">/</span>"</p>

                    <p>系统中的路径全部采用相对路径</p>
                </dd>
                <dt class="icon icon-arrow-r">图片</dt>
                <dd>
                    <p>所有页面元素类图片均放入 image 文件夹, 测试用图片放于 image/demo 文件夹</p>

                    <p>若图片属于“内容”则使用 <span class="code">img</span> 标签，若图片属于样式，则以背景的方式写入 CSS
						样式中并使用 sprite 技术（详细参考 CSS 规范相关说明）</p>

                    <p>内容图片文件路径是绝对的——假设内容是来自于聚合</p>

                    <p>图片格式仅限于 GIF、PNG、JPG</p>

                    <p>命名全部用小写英文字母、数字和下划线的组合，其中不得包含汉字、空格和特殊字符</p>

                    <p>尽量用易懂的词汇，便于团队其他成员理解；另，命名分头尾两部分，用下划线隔开，如：ad_left01.gif 或
						btn_submit.gif(建议，可根据具体情况调整)</p>

                    <p>在保证视觉效果的情况下选择最小的图片格式与图片质量，以减少加载时间，具体参考图片优化部分</p>

                    <p>尽量避免使用半透明的 PNG 图片（若使用，详细参考 CSS 规范相关说明）</p>

                    <p>重要图片必须加上 <span class="code">alt</span> 属性</p>

                    <p>图像的 <span class="code">alt</span> 属性会产生冗余，如果使用图像只是为了不能立即用 CSS
						来装饰的，就不需要用备选文案了，可以写 <span class="code">alt=""</span></p>
                </dd>
                <dt class="icon icon-arrow-r">排版</dt>
                <dd>
                    <p>首行缩进处理，不要使用全角空格，使用样式表中的 <span class="code">text-indent:2em;</span>
						首字母大写同理使用 <span class="code">text-transform:capitalize;</span></p>

                    <p>最大程度发挥浏览器的自动排版功能，在一段文字中尽量不要使用 <span class="code">&lt;br /&gt;</span>
						来人工干预分段</p>

                    <p>不同语种文字之间应该有一个半角空格，英文字母和数字周围的括号应该使用半角括号，汉字周围的括号应该使用全角括号</p>

                    <p>空白应该尽量使用
						<span class="code">text-indent</span>、<span class="code">padding</span>、<span class="code">margin</span>
						以及透明的 GIF（间隔图片，是 <span class="code">table</span> 布局中常用的一个技巧，通常是一个 1*1
						大小的透明 GIF 图片，用在撑大表格等辅助布局中）图片来实现</p>

                    <p>中英文混排时，应尽可能将英文和数字定义为 verdana 和 arial 两种字体</p>

                    <p>行距建议用百分比来定义，常用的两个行距（<span class="code">line-height</span>）的值是 <span class="code">120%</span> 或
						<span class="code">150%</span></p>

                    <p>建议正文的文字要大于菜单部分的文字（以此暗示正文内容的重要性）</p>
                </dd>
                <dt class="icon icon-arrow-r">图像替换</dt>
                <dd>用一张背景图片替代某元素中的原始文字，以期显示出更美观的字体，这个技巧被称为 "Fahrner 图像替换(Fahrner Image
					Replacement,FIR)"，该技巧实现非常简单：用标签将元素中文本包围起来，然后通过应用 CSS 样式
					<span class="code">display:none;</span> 或 <span class="code">visibility:hidden;</span>
					隐藏这个标签，最后将背景图像应用到该元素父级即可。之所以仍保留文字，是为了针对搜索引擎，以及辅助浏览设备（例如，屏幕阅读器即可阅读页面内容，并以声音的形式告知浏览者），但有些屏幕阅读器并不能读取隐藏到的文本，所以更好的办法是不增加额外的标签，而是使用
					<span class="code">text-indent:-5000px;</span> 将文本推到屏幕外。</dd>
                <dt class="icon icon-arrow-r">结构与表现分离</dt>
                <dd>
                    <p>禁止使用控制表现的标签，如：<span class="code">&lt;font&gt;</span>、<span class="code">&lt;b&gt;</span>
						等元素，字号应该用 CSS 样式表来实现</p>

                    <p>总体上尽量避免在 HTML 中手工编写 CSS/JS（首选的方法是通过工具实现这个过程的自动化）</p>
                </dd>
                <dt class="icon icon-arrow-r">特殊符号</dt>
                <dd>尽可能使用代码替代：比如：&lt;(<span class="code">&amp;lt;</span>)、&gt;(<span class="code">&amp;gt;</span>)、&amp;(<span class="code">&amp;amp;</span>)、空格(<span class="code">&amp;nbsp;</span>)、&raquo;(<span class="code">&amp;raquo;</span>)、版权符号 &copy;(<span class="code">&amp;copy;</span>)
					等等</dd>
                <dt class="icon icon-arrow-r">代码格式</dt>
                <dd>每个块元素、列表元素或表格元素都独占一行，每个子元素都相对于父元素进行缩进</dd>
                <dt class="icon icon-arrow-r">页面大小</dt>
                <dd>“页面大小”为网页的所有文件大小的总和，包括 HTML 文件和所有的嵌入的对象，页面大小保存在 34K 以下为合适</dd>
                <dt class="icon icon-arrow-r">关于 IDE</dt>
                <dd>
                    <p>根据自己喜好选择，但须遵循如下原则：</p>

                    <p>不可利用 IDE 的视图模式“画”代码</p>

                    <p>不可利用 IDE 生成相关功能代码，比如：DW 内置的一些功能 js</p>

                    <p>编码必须格式化，如缩进</p>
                </dd>
                <dt class="icon icon-arrow-r">注释</dt>
                <dd>
                    <p>给区块代码及重要功能（比如循环）加上注释，方便后台添加功能</p>

                    <p>注释格式：<span class="code">&lt;!-- 这是注释 --&gt;</span>，'<span class="code">--</span>' 只能在注释始末位置，不可置入注释文字区域</p>

                    <p>但在发布前应利用自动化工具删除注释、空格和缩进，压缩 HTML 文件的体积，因为这些对浏览器不重要</p>
                </dd>
                <dt class="icon icon-arrow-r">条件注释</dt>
                <dd>
                    <p>条件注释，主要是用来兼容低版本的 IE 浏览器，尤其应用在响应式布局中</p>

                    <p>不要把兼容代码和常规代码混合，这样方便代码的维护，如果后期网站不支持这些老旧浏览器，直接删除这些单独的 CSS 文件即可，如：</p>

                    <pre class="brush:html">
                        &lt;!--[if lt IE9]&gt;&lt;link rel="stylesheet" href="style/style-ie8.css" /&gt;&lt;![endif]--&gt;
                        &lt;!--[if IE7]&gt;&lt;link rel="stylesheet" href="style/style-ie7.css" /&gt;&lt;![endif]--&gt;
                        &lt;!--[if IE6]&gt;&lt;link rel="stylesheet" href="style/style-ie6.css" /&gt;&lt;![endif]--&gt;
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">深度优化</dt>
                <dd>某些编码规范中会建议用可以执行，但会违反一些严格规范的方式进行优化，如：省略一些标签，去掉可选的闭合标签，去掉标签中属性值的引号等等，在此不建议使用这些规范，即使使用也不建议开发者在开发时使用，只建议使用自动化工具进行优化</dd>
                <dt class="icon icon-arrow-r">测试工具</dt>
                <dd>
                    <p>前期开发仅测试 FireFox & IE6 & IE7 & IE8，后期优化时加入 Opera & Chrome & Safari</p>

                    <p>建议测试顺序：FireFox-->IE7-->IE8-->IE6-->Opera-->Chrome-->Safari，建议安装 Firebug 及 IE Tab minus 插件</p>

                    <p>所有 HTML 代码必须通过验证，如：
                        <a class="link" target="_blank" href='//validator.w3.org/'>W3C Validator</a>
                        ，或使用 FireFox 的 Html Validator 插件</p>

                    <p>使用 Chrome 的 HTML5 Outliner 扩展来检测页面的文档大纲</p>

                    <p>通过可访问性检验，如：
                        <a class="link" target="_blank" href="//wave.webaim.org/">http://wave.webaim.org/</a>
                    </p>
                </dd>
                <dt class="icon icon-arrow-r">HTML5 启动模板</dt>
                <dd>
                    <pre class="brush:html">
                        &lt;!DOCTYPE html&gt;
                        &lt;html&gt;
                        &lt;head&gt;
                            &lt;meta charset="utf-8" /&gt;
                            &lt;title&gt;Untitled&lt;/title&gt;
                            &lt;!--[if lt IE 9]&gt;
                            &lt;script src="http://html5shim.googlecode.com/svn/trunk/html5.js"&gt;&lt;/script&gt;
                            &lt;![endif]--&gt;
                        &lt;/head&gt;
                        &lt;body&gt;

                        &lt;/body&gt;
                        &lt;/html&gt;
                    </pre>
                </dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">CSS 编码规范
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">文件划分</dt>
                <dd>英文命名，后缀为 .css

                    <p>小型网站只需一个文件 style.css</p>

                    <p>门户类型网站需按公用部门和私有部门以功能模块来命名</p>

                    <p>共用及初始化标签样式文件 base.css，设定标签元素的预设值，浏览器的 reset
						可以写在这里，这里只会对标签元素本身做设定，不会出现任何 <span class="code">class</span> 或
						<span class="code">id</span>，但是可以有属性选择器或是伪类</p>

                    <p>首页 index.css</p>

                    <p>布局样式（包括响应式布局和网格系统的规则）文件 layout.css，指整个网站的“大架构”的外观，而非小元件的
						<span class="code">class</span></p>

					<p>组件样式（不与实际需求相关，如：按钮、表格等）文件 component.css</p>

					<p>UI 组件（由 JS 动态生成的组件所调用的样式，如：datepicker 插件等）文件 ui.css</p>

					<p>向下兼容（针对低版本 IE 浏览器）文件 ie.css</p>

					<p>其它以实际模块需求命名</p>

                    <p>但在发布前应尽可能将 CSS 文件合并，减少 HTTP 请求数量</p>
                </dd>
                <dt class="icon icon-arrow-r">协作开发及分工</dt>
                <dd>根据各个模块，同时根据页面相似程度，事先写好共用大体框架文件
					base.css，各个前端人员事先规划内部结构、表现与行为；协作开发过程中，每个页面都要引入，此文件包含 reset
					及头部底部样式，此文件不可随意修改</dd>
                <dt class="icon icon-arrow-r">重复使用率</dt>
                <dd>书写代码前，考虑并提高样式重复使用率，遵循组件不依赖于 DOM 结构的原则</dd>
                <dt class="icon icon-arrow-r">编码</dt>
                <dd>编码统一为 <span class="code">utf-8</span>（不需要制定样式表的编码，它默认为
					<span class="code">utf-8</span>），编码统一使用小写字母</dd>
                <dt class="icon icon-arrow-r">@import</dt>
                <dd>当你在一个外部样式表中使用 <span class="code">@import url('style.css');</span>
					时，览器无法通过并行下载的方式下载这个资源，这样就会导致其他资源的下载被阻塞，所以不建议使用</dd>
                <dt class="icon icon-arrow-r">class 和 id</dt>
                <dd>
                    <p><span class="code">id</span> 是唯一的并是父级的，<span class="code">class</span>
						用于标识高度可复用组件是可以重复的并是子级的</p>

                    <p>所以 <span class="code">id</span> 仅使用在大的模块上，<span class="code">class</span>
						可用在重复使用率高或是子级中</p>

                    <p><span class="code">id</span> 原则上尽量不用，为 JavaScript 预留钩子的除外，为 JavaScript
						预留钩子的命名，请以 <span class="code">js-</span> 或 <span class="code">j-</span>
						为前缀，如：<span class="code">js-hide</span>，<span class="code">js-show</span></p>

                    <p>样式名称由 小写英文、数字、减号和下划线来组合命名，如：<span class="code">main</span>、<span class="code">block-title</span>、<span class="code">btn01</span>；避免使用中文拼音，尽量使用简易的单词组合；总之，命名要语义化，简明化</p>

                    <p>其中减号用来表示状态或类别，如：<span class="code">.module-header</span>,<span class="code">.module-show</span>，下划线用来表示子级元素，如：<span class="code">.module_title</span>,<span class="code">.module_content</span></p>

                    <p>同时命名中禁止出现描述大小的数字和描述颜色的英文以及所用于的标签（原则上，鼓励每一个
						<span class="code">class</span> 可以用在所有类型的标签上）</p>
                </dd>
                <dt class="icon icon-arrow-r">关于 Reset</dt>
                <dd>
                    <p>Reset 的目的为解决浏览器间的差异，统一标签效果，很多的标签本来就没有这个属性或属性本身就是统一的，那么再给设置一次，也有时间的开销，所以不应使用
						<span class="code">*{}</span>,<span class="code">.class1 *{}</span>，仅应该把你常用到的这些标签进行处理，如：</p>

                    <pre class="brush:css">
                        body,li,p,h1{margin:0; padding:0}
                    </pre>

                    <p>不要去使用生僻的标签，因为这些标签往往在不同浏览器中解释出来的效果不一样，所以你要尽可能的去使用那些常用的标签</p>
                </dd>
                <dt class="icon icon-arrow-r">选择器</dt>
                <dd>
                    <p>选择器尽可能简单，如：<span class="code">#example</span>，而不是
						<span class="code">ul#example</span>，过深的选择器路径可能会使第三方组件的样式失效</p>

                    <p>尽量避免使用元素标签名和 <span class="code">id</span>、<span class="code">class</span>
						进行组合的选择器，做到样式与元素的分离，两者独立维护</p>

                    <p>选择器有个先后排序：<span class="code">id</span>、<span class="code">class</span>、标签及一般，这意味着一个带有
						<span class="code">id</span> 的元素集比只带有标签选择器的元素更快的被渲染。但在所有 DOM 元素都加上
						<span class="code">id</span> 是没有意义的</p>

                    <p>出于性能上的考虑避免使用子元素选择器和后代选择器，浏览器是从右向左来分析选择器的，对于
						<span class="code">#example &gt; li{}</span>，浏览器会先查找页面上所有的
						<span class="code">&lt;li&gt;</span> 元素，然后再去进一步判断：如果它的父节点的
						<span class="code">id</span> 为 <span class="code">example</span>
						则匹配成功，后代选择器比之前的子元素选择器效率更慢，会步步上溯其父节点，直到 DOM
						结构的根节点（<span class="code">document</span>）。由此可知，CSS 选择器的匹配性能问题不容忽视</p>

                    <p>如果不得不使用子元素选择器或后代选择器的话，选择器的层级不要超过 3 级</p>

                    <p>尽量避免使用全局选择器，如：</p>

                    <pre class="brush:css">
                        [hidden="true"]{}
                    </pre>

                    <p>该规则将查找页面上的所有节点，如果节点存在 <span class="code">hidden</span> 属性，且属性值为
						<span class="code">true</span> 则匹配成功，这是最耗时的匹配。星号也一样，遍历会消耗很多的时间，如果你的
						HTML 代码写的不规范或是某一签标没有必合，这个时间可能还会更长</p>

                    <p>当页面重排（reflow）时，低效的选择器依然会引发更高的开销</p>

                    <p>注：在 IE 中 <span class="code">:hover</span> 会降低响应速度</p>

                    <p>将选择器和声明隔行，每个选择器和声明都要独立新行</p>

                    <pre class="brush:css">
                        /* 推荐 */
                        h1,
                        h2,
                        h3 {
                            font-weight: normal;
                            line-height: 1.2;
                        }
                    </pre>

					<p>为选择器中的属行添加双引号</p>

					<p>最大限度复用 CSS 样式</p>
				</dd>
				<dt class="icon icon-arrow-r">准修饰选择器</dt>
				<dd>
					<p>有时你希望告诉其他开发者 <span class="code">class</span>
						的使用范围，我们可以在选择器前加上准修饰来描述我们规划的 <span class="code">class</span>
						作用范围，如：</p>

					<pre class="brush:css">
						/*html*/.product-page{}
						/*ol*/.breadcrumb{}
						/*p*/.intro{}
						/*ul*/.img-thumbs{}
					</pre>

					<p>这样就能在不影响代码私有度的前提下获知 <span class="code">class</span> 作用范围</p>
				</dd>
                <dt class="icon icon-arrow-r">HTML 自身属性</dt>
                <dd>充分利用 HTML 标签自身属性</dd>
                <dt class="icon icon-arrow-r">继承</dt>
                <dd>
                    <p>CSS
						中的继承是指只定义一次就能将同一样式赋予多个元素的能力。充分利用继承机制减少代码量，能够继承的属性有：<span class="code">color</span>、<span class="code">font</span>、<span class="code">letter-spacing</span>、<span class="code">line-height</span>、<span class="code">list-style</span>、<span class="code">text-align</span>、<span class="code">text-indent</span>、<span class="code">text-transform</span>、<span class="code">white-space</span>、<span class="code">word-spacing</span>
					</p>
                </dd>
                <dt class="icon icon-arrow-r">CSS 属性书写顺序</dt>
                <dd>
                    <p>建议遵循：布局定位属性-->自身属性-->文本属性-->其它属性，此条可根据自身习惯书写，但尽量保证同类属性写在一起</p>

                    <p>布局定位属性：<span class="code">display</span>、<span class="code">list-style</span>、<span class="code">position</span>(包括
						<span class="code">top</span>、<span class="code">bottom</span>、<span class="code">left</span>、<span class="code">right</span>)、<span class="code">float</span>、 <span class="code">clear</span>、<span class="code">visibility</span>、<span class="code">overfow</span></p>

                    <p>自身属性：<span class="code">width</span>、<span class="code">height</span>、<span class="code">margin</span>、<span class="code">padding</span>、<span class="code">border</span>、<span class="code">background</span></p>

                    <p>文本属性：<span class="code">color</span>、<span class="code">font</span>、<span class="code">text-decoration</span>、<span class="code">text-align</span>、<span class="code">vertical-align</span>、<span class="code">white-space</span></p>

                    <p>其它属性：<span class="code">content</span></p>

                    <p>以上属性仅为常用属性，并不代表全部</p>

                    <p>另有人建议：依字母顺序进行声明，很容易记住和维护</p>

                    <p>不建议使用系统颜色（<span class="code">color: WindowText;</span>）</p>

                    <p>CSS 目前支持 17
						种颜色名称：<span class="code">black</span>(黑色)、<span class="code">sliver</span>(银色)、<span class="code">gray</span>(灰色)、<span class="code">white|</span>(白色)、<span class="code">maroon</span>(栗色)、<span class="code">red</span>(红色)、<span class="code">purple</span>(紫色)、<span class="code">fuchsia</span>(紫红色)、<span class="code">green</span>(绿色)、<span class="code">lime</span>(鲜绿色)、<span class="code">olive</span>(橄榄色)、<span class="code">yellow</span>(黄色)、<span class="code">navy</span>(藏青色)、<span class="code">blue</span>(蓝色)、<span class="code">teal</span>(凫蓝)、<span class="code">aqua</span>(浅蓝绿色)、<span class="code">orange</span>(橙色)，CSS3
						将颜色值增加了 130 种</p>

                    <p>从 Gzip 压缩角度，只要整个文档中的书写顺序保持一致即可，可以提高 Gzip 压缩比率</p>
                </dd>
                <dt class="icon icon-arrow-r">CSS 表达式（CSS Expression）</dt>
                <dd>避免使用 CSS 表达式，CSS 表达式只有 IE8
					及其以前版本支持，而且他的执行比大多数人想象的要频繁的多，将会严重影响性能，甚至有可能造成无法预料的 JS
					错误，不仅页面渲染和改变大小（resize）时会执行，页面滚动（scroll）时也会执行，甚至连鼠标在页面上滑动时都会执行</dd>
                <dt class="icon icon-arrow-r">滤镜</dt>
                <dd>
                    <p>IE 滤镜是很耗性能的，尽量避免使用</p>

                    <p>使用 PNG 图片时，若其中有半透明效果，为 IE6 单独定义背景：</p>

                    <pre class="brush:css">
                        selector{
                            _background:none;
                            _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=crop,src='image/bg.png');
                        }
                    </pre>

                    <p>滤镜简写，如：</p>

                    <pre class="brush:css">
                        selector{
                            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
                            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=65);
                        }
                        /* 将上面代码简写为 */
                        selector{
                            -ms-filter:"alpha(opacity=65)";/* IE9 及以上  */
                            filter:alpha(opacity=65);/* IE8 及以下 */
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">浮动</dt>
                <dd>
                    <p>若用浮动实现布局，请确保正确地清除了浮动</p>

                    <p>在 IE6 中，设置了 <span class="code">float</span>，并设置的同方向的
						<span class="code">margin</span>，会造成 <span class="code">margin</span> 加倍</p>

                    <p>IE 中的斜体文字非常有可能导致水平溢出</p>
                </dd>
				<dt class="icon icon-arrow-r">z-index</dt>
				<dd>
					<p><span class="code">z-index</span> 属性只对定位元素有效，即 <span class="code">position</span> 值为
						<span class="code">absolute</span>,<span class="code">relative</span>,<span class="code">fixed</span>
						时才有效</p>

					<p>关于 <span class="code">z-index</span>
						属性，上下的层次关系也是按照树状结构进行层次划分的，优先父元素之间的分集，子元素这层次排序依赖于父元素的层次</p>
				</dd>
                <dt class="icon icon-arrow-r">外边距重叠（collapsing margin）</dt>
                <dd>
                    <p>CSS 盒模型（box model）中一个较为晦涩的概念。指若两个元素上下毗邻且都定义了都为正数的外边距值，同时有没有任何内边距、边框等设定，那么这两个元素之间的距离为二者外边距中较大的一个，即外边距要尽可能的重合</p>

                    <p>可设置 <span class="code">1px</span> 的内边距来解决此问题</p>
                </dd>
                <dt class="icon icon-arrow-r">em</dt>
                <dd>用 <span class="code">px</span>
					作为单位进行绝对定位将能够精确地控制布局，但同时也丧失了布局的灵活性——一旦给定了元素的位置，那么它将始终固定在原地。但若是使用
					<span class="code">em</span> 作为 <span class="code">left</span>、<span class="code">top</span>
					等属性的单位，元素的位置将变得略加灵活一些——这个位置会根据用户选择不同的字号而相应地改变。若是重叠在一起的若干元素都是用
					<span class="code">em</span>
					单位，那么任意的变化都将让其余的位置随之调整。虽然定位不是那么精确，但很多时候这种方法却相当好用</dd>
                <dt class="icon icon-arrow-r">居中</dt>
                <dd>
                    <p>使用 <span class="code">text-align</span>
						属性可以实现内容的居中，但这种方法并没有将文本属性应用到文本上，而是应用到了作为容器的元素上，所以这属于一种
						hack，而且会带来问题，所有子孙元素都会被居中显示</p>

                    <p>更好的做法是使用 <span class="code">margin:0 auto;</span> 来实现居中</p>
                </dd>
                <dt class="icon icon-arrow-r">通用字体族</dt>
                <dd>
                    <p>CSS 内置了一系列的字体族，而所有 CSS
						兼容的浏览器都能自动为每个字体族找到至少一个合适的默认字体（当然，用户也可以覆盖默认设置）。CSS
						并没有要求我们一定要在字体设定时设定一个字体族作为最后的备选字体，不过这样做却可以防止浏览器在没有匹配的情况下选择其默认的字体，如：</p>

                    <pre class="brush:css">
                        div{font-family: Geneva, Arial, Tahoma, sans-serif;}
                    </pre>

                    <ul>
                        <li>Serif 字体都有明显的装饰衬线，所以在字母笔画的结尾处大都能看到细小的衬线。Times New Roman 是默认的 Serif 字体，除非用户特意改变默认设置</li>
                        <li>Sans Serif 字体相对 Serif 的区别是它没有装饰衬线。Arial 是默认的 Sans Serif 字体</li>
                        <li>Monospace 字体的每个字母都有相同的宽度，因而在显示程序代码时特别有用。Courier(或者 Courier New) 是默认的 Monospace 字体</li>
                        <li>Cursive 字体模仿手写风格，通常用于标题中，多数为草体。Cursive 字体没有默认的字体，最常用的莫过于 Comic Sans</li>
                        <li>Fantasy 字体完全是装饰用字体，多数用于标题。由于 Fantasy 字族拥有太多的字体，几乎无法为这类字体的大小形状下一个定论，因而很少有人会在正式的站点设计中使用它们</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">字体格式（type form）</dt>
                <dd>
                    <p>字体格式指的是字样（typeface）表现的粗细、宽度和姿态（posture）等特征</p>

                    <p>字体粗细指文字笔画的宽度，在 CSS 中对应的属性为
						<span class="code">font-weight</span>，该属性用来设置文字表现出的粗细。需要注意的是有些字体并没有粗细适中的字样，因而他们并不能提供和
						CSS 中等同的粗细划分。而事实上，即使字体有足够多的粗细划分，浏览器也未必能找出最合适的字样。比较现实的做法是仅仅依赖两种设置：<span class="code">normal</span>
						和 <span class="code">bold</span></p>

                    <p>字体宽度指字符的宽度，紧缩字体会显得更为狭窄，而扩张字体则显得宽大，在 CSS 中对应的属性是
						<span class="code">font-stretch</span>，不过这个属性尚未被任何浏览器所支持。。。</p>

                    <p>字体姿态，与之对应的 CSS 属性是
						<span class="code">font-style</span>。所谓字体姿态实际上是指字体的倾斜程度，有两种：<span class="code">italic</span>，一种在常规字体基础上做过特殊设计的变体，一般带有手写风格；<span class="code">oblique</span>，常规字体由浏览器作倾斜处理后的版本。和
						<span class="code">italic</span> 不同的是，<span class="code">oblique</span>
						字体并不出自另外设计的变体，而仅仅是常规字体应用倾斜效果的结果，而多数人则错把
						<span class="code">oblique</span> 字体说成 <span class="code">italic</span> 字体</p>

                    <p>如字体设置了 <span class="code">bold</span>、<span class="code">italic</span> 或
						<span class="code">oblique</span> 等属性，浏览器一般都会首先尝试选择真实存在的衍生字体。若衍生字体不存在，浏览器就会调整常规字体，让它显示为
						<span class="code">bold</span>、 <span class="code">italic</span> 或者
						<span class="code">oblique</span>
						等样式。真实字体和自动调整形成的字体在视觉上有明显的区别，有经验的设计师能很快区分它们</p>
                </dd>
                <dt class="icon icon-arrow-r">字体大小</dt>
                <dd>
                    <p>使用 <span class="code">font-size</span> 来设置字体大小，对所有字体的作用都是相同的</p>

                    <p>不建议使用 <span class="code">em</span> 来设置文字大小，浏览器的默认值为
						<span class="code">16px</span>，当设置为 <span class="code">0.9em</span> 时，计算结果是
						<span class="code">14.4px</span>，有的浏览器会取 <span class="code">14px</span>，有的浏览器则会取
						<span class="code">15px</span>。而且，用户若改变了默认设置，那么结果会非常糟糕</p>

                    <p>使用关键字（<span class="code">xx-small</span>,<span class="code">x-small</span>,<span class="code">small</span>,<span class="code">medium</span>,<span class="code">large</span>,<span class="code">x-large</span>,<span class="code">xx-large</span>），每个关键字之间的缩放比例是 1.2，<span class="code">medium</span>
						即为默认值 <span class="code">16px</span>，也存在上述问题</p>

                    <p>有时候即使设置了字体大小，一些字体还是显得比其它字体更大，这是因为这些字体的
						x-height(小写字母去除高出部分和低出部分后的高度) 较大，这种情况下，可以使用
						<span class="code">font-size-adjust</span> 属性来解决，但该属性存在兼容性问题</p>
                </dd>
                <dt class="icon icon-arrow-r">文本的样式</dt>
                <dd>
                    <p><span class="code">font-variant</span>
						这个属性的唯一作用是将字母用略小的大写字母表示。原先为大写的字母将仍保持原样，而原先小写的字母将由稍小的大写字母来显示。这个属性有两个合法值，为
						<span class="code">normal</span> 和 <span class="code">small-caps</span>，需要指出的是，多数字体没有
						<span class="code">small-caps</span> 变体，因而浏览器会将大写字母缩小，因为浏览器具有这种特性，<span class="code">font-variant</span>
						也不强制要求字体必须有预设的变体</p>

                    <p><span class="code">text-transform</span>
						提供了更精确的字符大小写控制，可选值有：<span class="code">none</span>
						表示默认的正常状态，<span class="code">capitalize</span>
						将每个单词的首字母大写，<span class="code">uppercase</span>
						将单词所有字母大写，<span class="code">lowercase</span> 则将所有字母小写</p>

                    <p><span class="code">text-decoration</span>
						可以使下划线获得更多样式选项，但是运用不当将让用户觉得相当不便。这个属性的可选值有：<span class="code">none</span>
						默认值，在没有理由使用其它选项时，<span class="code">none</span> 就是最好的选择；<span class="code">underline</span>
						会为文字添加下划线，仅应该在链接中使用；<span class="code">overline</span>
						会显示出上划线。在数学中，上划线表示平均值，其它领域很少使用；<span class="code">line-through</span>
						会显示为中划线（删除线），仅用于表示已经不再相关、非事实或无效的文字，这些文字可能很快被其它文字替代。理想的用法是用于那些需要被改写的部分，如涉及版本跟踪和版本历史的文字中可以使用；
						<span class="code">blink</span> 将会产生时隐时现的效果，不推荐使用，而且并非所有浏览器都能支持
                    </p>
                </dd>
                <dt class="icon icon-arrow-r">间距的样式</dt>
                <dd>
                    <p><span class="code">line-height</span>
						用来控制行间距，可设置绝对数值、相对大小、长度或者百分比。若未加单位则认为是
						<span class="code">em</span>，表示基于当前文字大小的相对值</p>

                    <p><span class="code">letter-spacing</span> 用来控制字符间距，可设置为 <span class="code">normal</span>
						或者一个长度值，该长度值将作为默认值的补充，添加到正常的字符间距上。不应该为大段的文字设置字符间距，否则文字将显得很长，因此最好只在标题和小段文字中使用</p>

                    <p><span class="code">word-spacing</span> 用来控制单词的间距，可设置
						<span class="code">normal</span>、长度值或者百分比。需要注意的是
						<span class="code">text-align</span> 和 <span class="code">white-space</span>
						等属性均会影响到浏览器对 <span class="code">word-spacing</span> 的处理</p>

                    <p><span class="code">text-align</span> 用来控制文字对齐，可设置为
						<span class="code">left</span>、<span class="code">right</span>、<span class="code">center</span>
						和 <span class="code">justify</span></p>
                </dd>
                <dt class="icon icon-arrow-r">中文字体名</dt>
                <dd>
                    <p>样式表中中文字体名，请务必转码成 unicode
						码，以避免编码错误时乱码，如：<span class="code">\5b8b\4f53</span>(宋体)，<span class="code">\9ED1\4F53</span>(黑体)</p>

                    <table>
                        <thead>
                        <tr>
                            <th>中文名</th>
                            <th>英文名</th>
                            <th>unicode</th>
                            <th>unicode 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">Mac OS</td>
                        </tr>
                        <tr>
                            <td>华文黑体</td>
                            <td>STHeiti</td>
                            <td><span class="code">\534E\6587\9ED1\4F53</span></td>
                            <td><span class="code">&#38;#x534E;&#38;#x6587;&#38;#x9ED1;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>华文楷体</td>
                            <td>STKaiti</td>
                            <td><span class="code">\534E\6587\6977\4F53</span></td>
                            <td><span class="code">&#38;#x534E;&#38;#x6587;&#38;#x6977;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>华文宋体</td>
                            <td>STSong</td>
                            <td><span class="code">\534E\6587\5B8B\4F53</span></td>
                            <td><span class="code">&#38;#x534E;&#38;#x6587;&#38;#x5B8B;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>华文仿宋</td>
                            <td>STFangsong</td>
                            <td><span class="code">\534E\6587\4EFF\5B8B</span></td>
                            <td><span class="code">&#38;#x534E;&#38;#x6587;&#38;#x4EFF;&#38;#x5B8B;</span></td>
                        </tr>
                        <tr>
                            <td colspan="4">Windows</td>
                        </tr>
                        <tr>
                            <td>黑体</td>
                            <td>SimHei</td>
                            <td><span class="code">\9ED1\4F53</span></td>
                            <td><span class="code">&#38;#x9ED1;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>宋体</td>
                            <td>SimSun</td>
                            <td><span class="code">\5B8B\4F53</span></td>
                            <td><span class="code">&#38;#x5B8B;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>新宋体</td>
                            <td>NSimSun</td>
                            <td><span class="code">\65B0\5B8B\4F53</span></td>
                            <td><span class="code">&#38;#x65B0;&#38;#x5B8B;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>仿宋</td>
                            <td>FangSong</td>
                            <td><span class="code">\4EFF\5B8B</span></td>
                            <td><span class="code">&#38;#x4EFF;&#38;#x5B8B;</span></td>
                        </tr>
                        <tr>
                            <td>楷体</td>
                            <td>KaiTi</td>
                            <td><span class="code">\6977\4F53</span></td>
                            <td><span class="code">&#38;#x6977;&#38;#x4F53;</span></td>
                        </tr>
                        <tr>
                            <td>微软雅黑</td>
                            <td>Microsoft YaHei</td>
                            <td><span class="code">\5FAE\8F6F\96C5\9ED1</span></td>
                            <td><span class="code">&#38;#x5FAE;&#38;#x8F6F;&#38;#x96C5;&#38;#x9ED1;</span></td>
                        </tr>
                        <tr>
                            <td colspan="4">Office</td>
                        </tr>
                        <tr>
                            <td>隶书</td>
                            <td>LiSu</td>
                            <td><span class="code">\96B6\4E66</span></td>
                            <td><span class="code">&#38;#x96B6;&#38;#x4E66;</span></td>
                        </tr>
                        <tr>
                            <td>幼圆</td>
                            <td>YouYuan</td>
                            <td><span class="code">\5E7C\5706</span></td>
                            <td><span class="code">&#38;#x5E7C;&#38;#x5706;</span></td>
                        </tr>
                        </tbody>
                    </table>
                </dd>
                <dt class="icon icon-arrow-r">sprite 技术</dt>
                <dd>
                    <p>背景图片尽可能使用 sprite 技术，减少页面 http 请求数量，考虑到多人协作开发，sprite 按模块制作</p>

                    <p>但注意，请务必在对应的 sprite psd 源图中划参考线，并保存至 img 目录下</p>

                    <p>在使用 sprite 时，应当避免在每个图片之间的空隙过大。这个虽然不会影响到文件的大小，但是会影响到内存的消耗</p>
                </dd>
                <dt class="icon icon-arrow-r">Data-URI</dt>
                <dd>
                    <p>这种技术是 CSS Sprites 的替代方法，是指用图片的数据代替通常使用的图片 URI，以减少 HTTP 请求数量</p>

                    <p>所有的现代浏览器和 IE8 及以上版本的 IE 都支持这个方法，图片需要使用 base64 方法编码</p>

                    <p>这种技术和 CSS Sprites
						技术都是可以使用构建工具得到的。使用构建工具的好处是不用手工去进行图片的拼合替换，在开发时使用单独的文件就可以。</p>

                    <p>然而坏处是，随着 HTML/CSS 文件的增大增多，必须考虑可能会有一个非常大的图片。如果在 HTTP 请求中没有使用
						Gzip 技术压缩 HTML/CSS，那么不推荐使用这种方法，因为减少 HTTP
						请求数得到的大文件对于速度来说可能带来相反的结果</p>

                    <p>比如前文提到的间隔图片，就可以使用如下代码：</p>

                    <pre class="brush:html">
                        &lt;img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt=""/&gt;
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">链接</dt>
                <dd>
                    <p>对链接的不同状态设置样式，包括常态（Link）、已访问（Visited）、悬停（Hover）、活跃（Active）等，若还考虑焦点（Focus）的话，焦点在悬停后面，如：</p>

                    <pre class="brush:css">
                        /* :link 可以省略 */
                        a:link, a:visited{}
                        a:hover, a:focus, a:active{}
                    </pre>

                    <p>需要注意的是，若页面中使用了锚点，这些样式也会应用于锚点上，可以添加 <span class="code">id</span>
						属性来避免，或是用一种奇怪的语法避免，如：</p>

                    <pre class="brush:css">
                        :link:hover{}
                        :link:active{}
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">按钮</dt>
                <dd>
                    <p>对按钮的不同状态设置样式，包括默认（Default）、悬停（Hover）、点击（Click）、失效（Disabled），如：</p>

                    <pre class="brush:css">
                        input{}
                        input:focus{}
                        input:hover{}
                        input[disabled]{}
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">图片</dt>
                <dd>
                    <p>尽量使用 CSS 来实现小图标，如三角形等</p>

                    <p>为保证系统和浏览器的兼容性，当设置背景图片时，要使用双引号，但不要使用单引号</p>
                </dd>
                <dt class="icon icon-arrow-r">兼容性</dt>
                <dd>
                    <p>避免兼容性属性的使用</p>

                    <p>避免浏览器 hacks</p>

                    <p>不将 CSS3 属性作为主要功能功能来使用，如动画、变形等效果，也包括
						<span class="code">:before</span>,<span class="code">:after</span></p>
                </dd>
                <dt class="icon icon-arrow-r">性能</dt>
                <dd>
                    <p>减少使用影响性能的属性，以下为耗费较大的属性：</p>

                    <ol>
                        <li><span class="code">position:fixed</span></li>
                        <li><span class="code">background-position:fixed</span></li>
                        <li><span class="code">border-radius</span></li>
                        <li><span class="code">background-size</span></li>
                        <li><span class="code">box-shadow</span></li>
                        <li><span class="code">gradients</span></li>
                    </ol>

                    <p><span class="code">position:absolute;</span>,<span class="code">float</span>
						也有性能问题（尤其在所包含的子元素很多时），如果使用过多，会让网页变得非常的慢，尽量减少使用</p>

                    <p>背景图片的平铺次数越少越好</p>
                </dd>
                <dt class="icon icon-arrow-r">缩进与格式</dt>
                <dd>
                    <p>可根据自身习惯，后期优化统一处理</p>

                    <p>写属性值的时候尽量使用缩写，如：<span class="code">font</span>、<span class="code">background</span></p>

                    <p>属性的值为 <span class="code">0</span> 时，可以省略后边的单位</p>

                    <p>省略 <span class="code">0</span> 开头小数点前面的
						<span class="code">0</span>，如：<span class="code">margin: .5em -.5em</span></p>

                    <p>考虑到一致性和拓展性，请在每个属性声明尾部都加上分号</p>

                    <p>加颜色值时尽量使用简写 3 个字符的十六进制更短与简洁且应该全部小写，如：<span class="code">#abc</span></p>

                    <p>大型项目中最好在 <span class="code">id</span> 或 <span class="code">class</span>
						名字前加上这种标识性前缀（命名空间），使用短破折号链接</p>

                    <p>最好避免使用该死的 CSS "hacks"</p>

                    <p>出于一致性的原因，在属性名和值之间加一个空格（并不是属性名和冒号之间）</p>
                </dd>
                <dt class="icon icon-arrow-r">响应式布局</dt>
                <dd>
                    <p>针对不同分辨率的设备设计不同的界面，使刚进入网站时的界面显示该网站的核心内容，只针对主流移动设备，如：</p>

                    <pre class="brush:css">
                        @media only screen and (max-device-width:240px){
                            /* 针对屏幕宽度小于 240px 设备 */
                        }
                        @media only screen and (min-device-width:241px) and (max-device-width:360px){
                            /* 针对屏幕宽度于 240px 与 360px 宽度之间设备 */
                        }
                        @media only screen and (min-device-width:361px) and (max-device-width:480px){
                            /* 针对屏幕宽度于 360px 与 480px 宽度之间设备 */
                        }
                        @media only screen and (min-device-width:481px) and (max-device-width:640px){
                            /* 针对屏幕宽度于 480px 与 640px 宽度之间设备 */
                        }
                        @media only screen and (min-device-width:641px) and (max-device-width:800px){
                            /* 针对屏幕宽度于 640px 与 800px 宽度之间设备 */
                        }
                        @media only screen and (min-device-width:801px) and (max-device-width:1024px){
                            /* 针对屏幕宽度于 800px 与 1024px 宽度之间设备 */
                        }
                        @media only screen and (min-device-width:1025px){
                            /* 针对屏幕宽度超过 1024px 设备 */
                        }
                    </pre>

                    <p>在此列出的只是一些可能情况（也许还可以再补充），实际开发时也可能将几种情况合并，备注：在 HTML
						页面中需要设置 <span class="code">meta</span> 标签，详细见 HTML 规范</p>
                </dd>
                <dt class="icon icon-arrow-r">CSS3 动画</dt>
                <dd>
                    <p>使用 CSS 动画比起 JavaScript 驱动的动画效率更高，CSS 动画同时需要更少的代码，很多的 CSS 动画是用 GPU
						处理的，因此动画本身很流畅，可以使用下面代码强制使你的硬件加速：</p>

                    <pre class="brush:css">
                        .myAnimation{
                            animation: someAnimation 1s;
                            transform: translate3d(0, 0, 0);    /* 强制硬件加速 */
                            /* transform: translate(0, 0, 0) 在不会影响其他动画的同时将动画送入硬件加速 */
                        }
                    </pre>

                    <p>在不支持 CSS 动画的情况下（IE8 及以下版本的浏览器），你可以引入 JavaScript 动画逻辑</p>
                </dd>
				<dt class="icon icon-arrow-r">IE 浏览器的选择器限制</dt>
				<dd>IE9 及其以下版本的浏览器限制每个样式表最多有 4096 个选择器，也限制了 31 个复合的样式表和每个页面包含的
					<span class="code">&lt;style&gt;</span> 元素，所有超过这个限制的内容都会被浏览器忽略，把你的 CSS
					样式表分开或者重构</dd>
                <dt class="icon icon-arrow-r">注释</dt>
                <dd>
                    <p>必须为大区块样式添加注释，小区块适量注释</p>

                    <p>注释格式：<span class="code">/* 这是注释 */</span></p>

                    <p>但在发布前应利用自动化工具删除注释、空格和缩进，压缩 CSS 文件的体积，因为这些对浏览器不重要</p>
                </dd>
                <dt class="icon icon-arrow-r">测试工具</dt>
                <dd>
                    <p>所有 CSS 代码必须通过验证（可根据项目需要自定义标准），如：
                        <a class="link" target="_blank" href="//jigsaw.w3.org/css-validator">css-validator</a>、
                        <a class="link" target="_blank" href="//csslint.net/">CSS Lint</a>
                    </p>

                    <p>可以在开发时将所有 CSS 代码嵌入到 HTML 页面中的 <span class="code">&lt;style&gt;</span>
						元素中，即可避免许多因浏览器缓存导致的不正常现象，但在发布前，一定要将这些样式移至外部文件，然后用
						<span class="code">&lt;link&gt;</span> 元素引入</p>
                </dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">JS 编码规范
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">文件命名</dt>
                <dd>
                    <p>英文命名，后缀为 .js，公用文件 common.js/base.js/lib.js/core.js，其他按实际模块需求命名</p>

                    <p>但在发布前应尽可能将 JS 文件合并，减少 HTTP 请求数量</p>
                </dd>
                <dt class="icon icon-arrow-r">编码</dt>
                <dd>文件编码统一为 <span class="code">utf-8</span></dd>
                <dt class="icon icon-arrow-r">规范</dt>
                <dd>
                    <p>书写过程中，每行代码结束必须有分号</p>

                    <p>代码结构明了，加适量注释，提高函数重用率，尽量避免使用存在消耗资源及兼容性的方法或属性，如：<span class="code">eval()</span>
						或 <span class="code">innerText</span> 等</p>

                    <p>注重与 HTML 分离，减小 reflow，注重性能</p>

                    <p>原则上所有功能均根据 XXX 项目需求原生开发，以避免网上 Download
						下来的代码造成的代码污染（冗余代码或与现有代码冲突等情况）</p>
                </dd>
                <dt class="icon icon-arrow-r">JS 库</dt>
                <dd>原则上仅引入一个库（目前为 jQuery），若需引入第三方库，须与团队其他人员讨论决定</dd>
                <dt class="icon icon-arrow-r">异步加载第三方内容</dt>
                <dd>
                    <p>网站的开发经常回调用第三方的内容，例如：天气、分享等，问题在于，不管是用客户端还是服务器端的连接，都无法保证这些代码是正常有效工作的。这些服务有可能临时
						Down 掉或是被用户或者其公司的防火墙阻止</p>

                    <p>为了避免这些页面加载时成为问题，或者更严重的阻塞了全部页面的加载，总是应该异步加载这些代码，例如：</p>

                    <pre class="brush:js">
                        var script = document.createElement('script'),
                            scripts = document.getElementsByTagName('script')[0];

                        script.async = true;
                        script.src = url;
                        scripts.parentNode.insertBefore(script, scripts);
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">document.write()</dt>
                <dd>
                    <p>这个（坏）方法已经被开发者抛弃了很多年，但是在某些情况下仍然是需要的，例如在一些 JavaScript
						文件的同步回退中，如：</p>

                    <pre class="brush:html; brush:js; html-script:true">
                        &lt;script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"&gt;&lt;/script&gt;
                        &lt;script&gt;
                        window.jQuery || document.write('&lt;script src="js\/vendor\/jquery-1.9.0.min.js"&gt;&lt;\/script&gt;')
                        &lt;/script&gt;
                    </pre>

                    <p>如果发现 Google 的 CDN 没有响应，HTML5 Boilerplate 则会通过这个方法来调用本地的 jQuery 库</p>

                    <p>注意: 如果在 <span class="code">window.onload()</span> 事件中或之后执行
						<span class="code">document.write()</span> 方法，会将当前页面替换掉</p>
                </dd>
                <dt class="icon icon-arrow-r">eval()</dt>
                <dd>
					<p>避免使用 <span class="code">eval()</span> 除非反序列化</p>

					<p><span class="code">eval</span> 函数会在当前作用域中执行一段 JavaScript 代码字符串，但是
						<span class="code">eval</span> 函数只在被直接调用并且调用函数就是 <span class="code">eval</span>
						本身时，才在当前作用域中执行，如：</p>

					<pre class="brush:js">
						var num = 1;
						function doSomething(){
							var num = 2;
							eval('num = 3');
							return num;
						}
						console.log(doSomething(), num);	// 3, 1

						var num = 1;
						function doSomething(){
							var num = 2
								, doThings = eval
								;
							doThings('num = 3');
							return num;
						}
						console.log(doSomething(), num);	// 2, 3
					</pre>
				</dd>
                <dt class="icon icon-arrow-r">严格模式</dt>
                <dd>
                    <p>ECMAScript5 引入了“严格模式”（strict
						mode）：<span class="code">"use strict"</span>，但不推荐将其用在全局作用域中，建议只在函数内使用</p>

                    <pre class="brush:js">
                        function() doSomething{
                            'use strict';
                            // do something
                        }
                    </pre>

                    <p>严格模式将会改变许多 JavaScript 的行为，如果在处理老的代码时则要小心地使用严格模式</p>
                </dd>
                <dt class="icon icon-arrow-r">truthy 和 falsy 规则</dt>
                <dd>
                    <p>truthy 和 falsy 的概念：它们是一种 <span class="code">true</span>/<span class="code">false</span>
						字面量。在 JavaScript 中，所有的非 <span class="code">Boolean</span> 型值都会内置一个
						<span class="code">boolean</span> 标志，当这个值被要求有 <span class="code">boolean</span>
						行为的时候，这个内置布尔值就会出现，例如当你要跟 <span class="code">Boolean</span> 型值比对的时候</p>

                    <p>当 JavaScript
						两个不同类型的值要求做比较的时候，它首先会将其弱化成相同的类型。<span class="code">false</span>,<span class="code">undefined</span>,<span class="code">null</span>,<span class="code">0</span>,<span class="code">""</span>,<span class="code">NaN</span>
						都弱化成 <span class="code">false</span></p>

                    <p>无关键字的数组等同于 <span class="code">false</span>，如：</p>

                    <pre class="brush:js">
                        var arr = [];
                        arr == false;   // true
                    </pre>

                    <p>为避免引起混乱的隐含类型转换，在比较值和表达式类型的时候始终使用 <span class="code">===</span> 和
						<span class="code">!==</span> 操作符</p>
                </dd>
                <dt class="icon icon-arrow-r">对象比较</dt>
                <dd>
                    <p>当在进行比较时，如果其中一个值是对象而另一个不是，则会首先调用对象的 <span class="code">valueOf()</span>
						方法，得到原始类型值再进行比较，如果没有定义 <span class="code">valueOf()</span>，则调用
						<span class="code">toString()</span>，如：</p>

                    <pre class="brush:js">
                        var obj = {
                            valueOf:function(){
                                return 5;
                            }
                        }
                        obj == 5;    // true
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">命名语义化</dt>
                <dd>尽可能利用英文单词或其缩写</dd>
                <dt class="icon icon-arrow-r">变量命名</dt>
                <dd>
                    <p>驼峰式命名</p>

                    <p>原生 JavaScript 变量要求是纯英文字母，首字母须小写，如：<span class="code">var value = 1;</span></p>

                    <p>jQuery 变量要求首字符为 '<span class="code">$</span>'，其它与原生 JavaScript
						规则相同，如：<span class="code">var $container = $('div.container');</span></p>

                    <p>建议对象私有属性和私有方法以下划线开头</p>

                    <p>使用对象及数组字面量而不是更冗长的声明</p>

                    <p>变量名应该尽可能短，尽量在变量名字体现出值得数据类型，如：<span class="code">count</span>、<span class="code">length</span>
						和 <span class="code">size</span> 表明数据类型是数字，而命名 <span class="code">name</span>、<span class="code">title</span>
						和 <span class="code">message</span> 表明数据类型是字符串，单个字符命名的变量如
						<span class="code">i</span>、<span class="code">j</span> 等通常用在循环中</p>
                </dd>
                <dt class="icon icon-arrow-r">类/构造函数命名</dt>
                <dd>
                    <p>首字母大写，驼峰式命名，构造函数的命名常常是名词，因为它们是用来创建某个类型的实例的。如：</p>

                    <pre class="brush:js">
                        function Person(){
                            // do something
                        }

                        var user1 = new Person();
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">函数/方法命名</dt>
                <dd>
                    <p>首字母小写，驼峰式命名，方法名应该尽可能完整</p>

                    <p>对于函数和方法命名来说，第一个单词应该是动词，如以
						<span class="code">can</span>、<span class="code">has</span>、<span class="code">is</span>
						开头的函数或方法应返回一个布尔值，以 <span class="code">get</span> 开头返回一个非布尔值，以
						<span class="code">set</span> 开头的函数或方法用来保存一个值，如：</p>

                    <pre class="brush:js">
                        function getValue(){
                            // do something

                            return value;
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">定义字符串</dt>
                <dd>用单引号定义字符串，JavaScript 中可以用单引号或者双引号定义字符串，但是因为习惯于在 HTML
					中元素的属性值的定义使用双引号，而 JavaScript 中又经常包含 HTML
					代码，所以字符串定义使用单引号也是方便于在字符串内部包含含有双引号的 HTML 代码</dd>
                <dt class="icon icon-arrow-r">字符串拼接</dt>
                <dd>
                    <p>对于 IE6/7 使用 <span class="code">Array.join()</span> 连接大量字符串的效率要高于使用
						<span class="code">+</span> 元素运算符。但目前主流的浏览器，包括 IE8 以后的版本，都对
						<span class="code">+</span> 元素运算符连接字符串做了特别优化，性能已经显著高于
						<span class="code">Array.join()</span>。目前大多数情况下，建议连接字符串首选使用
						<span class="code">+</span> 元素运算符</p>

                    <p>使用 <span class="code">Array.join()</span> 方法连接字符串，如：</p>

                    <pre class="brush:js">
                        var arr = [],
                            name = 'Brady',
                            str;

                        // 不推荐的用法
                        str = '&lt;li&gt;here is the story,of a \
                                man ' + name +'.&lt;/li&gt;';  // 这种写法是非法的 JavaScript 语法，但在几乎所有的 JavaScript 引擎中正常工作

                        // 推荐的用法
                        str = '&lt;li&gt;here is the story,of a man '+ name +'.&lt;/li&gt;';

                        arr.push('&lt;li&gt;here is the story,of a man ', name, '.&lt;/li&gt;');
                        str = arr.join(''); // &lt;li&gt;here is the story,of a man Brady.&lt;/li&gt;
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">数字</dt>
                <dd>
                    <p>为了避免歧义，不要省略小数点之前或之后的数字；代码中禁止八进制直接量</p>

                    <pre class="brush:js">
                        // 不推荐的用法
                        var num1 = 10.,
                            num2 = .1,
                            num3 = 010; // 八进制写法已经被弃用了
                    </pre>

                    <p>二进制的浮点数不能正确处理十进制的小数，因此 <span class="code">0.1 + 0.2</span> 不等于
						<span class="code">0.3</span>。这是 JavaScript 中最常见的
						bug，但它是遵循二进制浮点数算术标准（IEEE 754）而有意导致的结果</p>

                    <p><span class="code">NaN</span> 是一个特殊的数量值，它表示不是一个数字，但
						<span class="code">typeof NaN</span> 的结果是 <span class="code">"number"</span>，而且
						<span class="code">NaN</span> 不等同于它自己，可以用 <span class="code">isNaN()</span>
						来判断数字与 <span class="code">NaN</span>，但它会试图把参数转换为一个数值，如：</p>

					<pre class="brush:js">
						isNaN( NaN );	// true
						isNaN( 123 );	// false
						isNaN( '123' );	// false
						isNaN( 'abc' );	// true
                    </pre>

                    <p>判断一个值是否可用做数字的最佳方法是 <span class="code">isFinite</span> 函数，它会筛除掉
						<span class="code">NaN</span> 和
						<span class="code">Infinity</span>，但它会试图把参数转换为一个数值，所以可以这样定义
						<span class="code">isNumber</span> 函数：</p>

                    <pre class="brush:js">
                        var isNumber = function(value){
                            return typeof value === 'number' && isFinite(value);
                        }
                    </pre>
                </dd>
				<dt class="icon icon-arrow-r">new 操作符</dt>
				<dd>如果在一个函数前面带上 <span class="code">new</span>
					操作符来调用，这个函数会被认为是构造函数，将会会创建一个连接到该函数的 <span class="code">prototype</span>
					成员的新对象，同时 <span class="code">this</span> 会被绑定到那个新对象上，<span class="code">new</span>
					操作符也会改变 <span class="code">return</span> 语句的行为：当返回值不是一个对象时，则返回
					<span class="code">this</span></dd>
				<dt class="icon icon-arrow-r">delete 操作符</dt>
				<dd>
					<p><span class="code">delete</span> 操作符是将属性从一个对象中删除的唯一方法，将属性设置为
						<span class="code">undefined</span> 或 <span class="code">null</span>
						只能改变属性的值，而不会将属性从对象中删除，<span class="code">delete</span>
						操作符只能对实例的属性和方法起作用，不会删除 <span class="code">prototype</span> 的属性或方法，如：</p>

					<pre class="brush:js">
						var foo = {bar: 'bar'};

						delete foo.bar
						console.log('bar' in foo);	// false
                    </pre>
				</dd>
                <dt class="icon icon-arrow-r">typeof 运算符</dt>
                <dd>
					<p><span class="code">typeof</span>
						运算符的基本语法是：<span class="code">typeof variable</span>。但也可以这样用：<span class="code">typeof(variable)</span>，尽管这个是合法的
						JavaScript 语法，但这种用法让 <span class="code">typeof</span>
						看起来像一个函数而非运算符，所以推荐使用无括号的写法</p>

					<p><span class="code">typeof</span>
						只有一个实际的应用，用来检测一个对象是否已经定义或者是否已经赋值，而不是用来检查对象的类型</p>
				</dd>
                <dt class="icon icon-arrow-r">instanceof 运算符</dt>
                <dd>
                    <p>在 JavaScript 中除了原始值之外的值都是引用，<span class="code">typeof</span>
						运算符在判断这些引用类型时除了函数类型会返回 <span class="code">"function"</span>，其它都会返回
						<span class="code">"object"</span>（部分浏览器在判断 <span class="code">RegExp</span> 类型时会返回
						<span class="code">"function"</span>），这时检测某个引用值得类型的最好方法是使用
						<span class="code">instanceof</span> 运算符</p>

                    <p><span class="code">instanceof</span>
						的一个特性是它不仅检测这个对象的构造器，还检测原型链，原型链包含了很多信息，包括定义对象所采用的继承模式，如：</p>

                    <pre class="brush:js">
                        var now = new Date();

                        console.log( now instanceof Object );   // true
                        console.log( now instanceof Date ); // true
                        // 默认情况下，每个对象都继承自 Object，因此每个对象的 value instanceof Object 都会返回 true
                        // 因此，使用 instanceof 来判断对象是否属于某个特定类型的做法并非最佳
                    </pre>

                    <p><span class="code">instanceof</span> 运算符也可以检测自定义的类型，如：</p>

                    <pre class="brush:js">
                        function Person(name){
                            this.name = name;
                        }

                        var me = new Person('ZwB');

                        console.log( me instanceof Object );    // true
                        console.log( me instanceof Person );    // true
                    </pre>

                    <p>在 JavaScript 中检测自定义类型时，最好的方法就是使用 <span class="code">instanceof</span>
						运算符。但是，有一个严重的限制，假设一个浏览器帧（frameA）里的一个对象被传入另一个帧（frameB）中。两个帧里都定义了构造函数
						<span class="code">Person</span>。如果来自帧 A 的对象是帧 A 的 <span class="code">Person</span>
						的实例，则有如下结果：</p>

                    <pre class="brush:js">
                        frameAPersonInstance instanceof frameA.Person   // true

                        frameAPersonInstance instanceof frameB.Person   // false
                    </pre>

                    <p>因为每个帧（frame）都拥有 <span class="code">Person</span> 的一份拷贝，它被认为是该帧（frame）中的
						<span class="code">Person</span> 的拷贝的实例，尽管两个定义可能完全一样，函数和数组也有这个问题</p>
                </dd>
                <dt class="icon icon-arrow-r">检测函数</dt>
                <dd>
                    <p>检测函数最好的方法是使用 <span class="code">typeof</span>，但有一个限制，在 IE8 和更早版本 IE
						浏览器中，使用 <span class="code">typeof</span> 来检测 DOM 节点（比如
						<span class="code">document.getElementById()</span>）中的函数都会返回
						<span class="code">"object"</span>，这种怪异现象是因为浏览器对 DOM 的实现有差异，所以要通过
						<span class="code">in</span> 运算符来检测 DOM 的方法，如：</p>

                    <pre class="brush:js">
                        if( 'querySelectorAll' in document ){   // 检测 DOM 方法
                            images = document.querySelectorAll('img');
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">检测数组</dt>
                <dd>
                    <p>ECMAScript5 将 <span class="code">Array.isArray()</span> 正式引入
						JavaScript，但为为了兼容低版本浏览器，使用：</p>

                    <pre class="brush:js">
                        function isArray(value){
                            if( typeof Array.isArray === 'function' ){
                                return Array.isArray( value );
                            }
                            else{
                                return Object.prototype.toString.call(value) === '[object Array]';
                            }
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">in 运算符</dt>
                <dd>
                    <p>判断属性是否存在的最好方法是使用 <span class="code">in</span> 运算符，<span class="code">in</span>
						运算符仅仅会判断属性是否存在，而不会去读属性的值</p>

                    <pre class="brush:js">
                        if( navigator.geolocation ){
                            // TODO do something
                        }
                        // 这个对象探测方法会在浏览器中初始化资源，有可能导致内存泄露，更好的办法为：
                        if( 'geolocation' in navigator ){
                            // TODO do something
                        }
                    </pre>

                    <p>如果实例对象的属性存在或者继承自对象的原型，<span class="code">in</span> 运算符都会返回
						<span class="code">true</span></p>
                </dd>
                <dt class="icon icon-arrow-r">检测属性</dt>
                <dd>如果只想检测实例对象的某个属性是否存在，使用 <span class="code">hasOwnProperty()</span> 方法。所有继承自
					<span class="code">Object</span> 的 JavaScript 对象都有这个方法，需要注意的是 IE8 以及更早版本的 IE
					中，DOM 对象并非继承自 <span class="code">Object</span>，因此不包含此方法</dd>
                <dt class="icon icon-arrow-r">null</dt>
                <dd>
                    <p>在下列场景中应当使用 <span class="code">null</span></p>

                    <ul>
                        <li>用来初始化一个变量，这个变量可能赋值为一个对象，这样即使未赋值，<span class="code">typeof</span>
							运算符也会返回 <span class="code">"object"</span></li>
                        <li>用来和一个已经初始化的变量比较，这个变量可以是也可以不是一个对象</li>
                        <li>当函数的参数期望是对象时，用作参数传入</li>
                        <li>当函数的返回值期望是对象时，用作返回值传出</li>
                    </ul>

                    <p>下列场景不应当使用 <span class="code">null</span></p>

                    <ul>
                        <li>不要用 <span class="code">null</span> 来检测是否传入了某个参数</li>
                        <li>不要用 <span class="code">null</span> 来检测一个未初始化的变量</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">undefined</dt>
                <dd>避免在代码中使用 <span class="code">undefined</span>，可以有效地确保只在一种情况下
					<span class="code">typeof</span> 才会返回 <span class="code">"undefined"</span>：当变量未声明时</dd>
                <dt class="icon icon-arrow-r">直接量</dt>
                <dd>
                    <p>当声明数组和对象时，使用数组直接量和对象直接量，如：</p>

                    <pre class="brush:js">
                        // 不推荐的写法
                        var obj = new Object(),
                            arr = new Array();

                        // 推荐的写法
                        var obj = {},
                            arr = [];
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">原始包装类型</dt>
                <dd>
                    <p>JavaScript 中有 3
						中原始包装类型：<span class="code">Boolean</span>、<span class="code">Number</span>、<span class="code">String</span>。每种类型都代表全局作用域中的一个构造函数，并分别表示各自对应的原始值的对象。原始包装类型的主要作用是让原始值具有对象般的行为，如：</p>

                    <pre class="brush:js">
						console.log( 'zwb'.toUpperCase() );	// ZWB

                        var name = 'zwb';
                        console.log( name.toUpperCase() );  // ZWB
                        // 在调用方法时，JavaScript 引擎创建了 String 类型的新实例

                        name.id = 1;    // 对原始类型添加属性不会报错，但当使用时会返回 undefined
                        console.log( name.id ); // undefined
                        // 在对原始类型添加属性时，JavaScript 引擎创建了 String 类型的新实例，并添加了属性，但是紧跟着就被销毁了
                        // 而使用添加的属性时，又创建了 String 类型的新实例，但并没有 id 属性，所以返回 undefined

						// 需要注意的是数字的字面值，因为 JavaScript 解析器的一个错误， 它试图将点操作符解析为浮点数字面值的一部分
						console.log( 2.toString() );	// error 报错

						// 以下方法可以正确执行
						console.log( 2..toString() );	// "2"
						console.log( 2 .toString() );	// "2"
						console.log( (2).toString() );	// "2"
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">中文字符</dt>
                <dd>后期优化中，JavaScript 非注释类中文字符须转换成 unicode 编码使用，以避免编码错误时乱码显示</dd>
                <dt class="icon icon-arrow-r">变量提升（hoisting）</dt>
                <dd>
                    <p>代码处理分两个阶段，第一阶段是变量，函数声明，以及正常格式的参数创建，这是一个解析和进入上下文的阶段。第二个阶段是代码执行，函数表达式和不合格的标识符（未声明的变量）被创建，在第一阶段，所有使用
						<span class="code">var</span> 声明的变量都会被创建，所以当该变量在 <span class="code">var</span>
						语句前即被使用时，该变量的值会是 <span class="code">undefined</span>，这就是变量提升。</p>

                    <p>变量提升意味着：在函数内部任意地方定义变量和在函数顶部定义变量是完全一样的。为了防止变量提升，应先声明后使用，并遵循单一
						<span class="code">var</span> 模式</p>
                </dd>
                <dt class="icon icon-arrow-r">引用</dt>
                <dd>若两次以上引用同一对象的属性，应该定义到局部变量再引用</dd>
                <dt class="icon icon-arrow-r">全局变量</dt>
                <dd>
                    <p>尽量不要定义全局变量，全局变量的问题在于，你的 JavaScript 应用程序和 Web
						页面上的所有代码都共享了这些全局变量，他们住在同一个全局命名空间，所以当程序的两个不同部分定义同名但不同作用的全局变量的时候，命名冲突在所难免</p>

                    <p>为防止意料之外的全局变量，所有变量都要使用 <span class="code">var</span>
						来声明，以防隐式全局变量的出现，也不要使用任务链进行部分 <span class="code">var</span> 声明，如：</p>

                    <pre class="brush:js">
                        var a = b = 0;
                        // 其中 a 是局部变量，但 b 却是全局变量，原因在于这个从右到左的赋值
                    </pre>

                    <p>需要注意的是，全局变量的命名不能覆盖 <span class="code">window</span> 的默认属性，如
						<span class="code">name</span> 等，<span class="code">window.name</span>
						属性经常用于框架（frame）和 <span class="code">iframe</span>
						的场景中，当点击链接时，可以通过指定打开链接的目标容器来控制其在特定的框架或选项卡（浏览器的标签页）中显示，不小心修改
						<span class="code">name</span> 会影响到站点的链接导航</p>
                </dd>
				<dt class="icon icon-arrow-r">零全局变量</dt>
				<dd>
					<p>JavaScript
						代码注入到页面时是可以做到不用创建全局变量的，这种方法应用的场景不多，只有某些特殊场景才会使用，最常见的情形是一段不会被其它脚本访问到的完全独立的脚本，实现方法就是使用一个立即执行的函数调用并将所有脚本放置其中，之后可以通过将函数设置为严格模式来避免创建全局变量，如：</p>

                    <pre class="brush:js">
                        ;(function(win, doc){
                            'use strict';

                            // do something

                        })(window, document);
                    </pre>

					<p>注意在括号前面的分号，这是为了防止之前的代码中缺少分号而使这段代码被理解成一个传入一个函数做参数的自调用函数</p>
				</dd>
                <dt class="icon icon-arrow-r">单全局变量模式</dt>
                <dd>
                    <p>单全局变量模式，是指创建唯一一个全局对象，命名是独一无二的，不会和内置 API
						冲突，并将你所有的功能代码都挂载到这个全局对象上。因此每个可能的全局变量都会成为全局对象的属性，从而不会创建多个全局变量，目前各种流行的
						JavaScript 类库都广泛使用。建议使用 <span class="code">GLOBAL</span>
						命名，常量、全局变量、全局函数作为其的属性方法，如：</p>

                    <pre class="brush:js">
                        var GLOBAL = GLOBAL || {};

                        GLOBAL.userId = 123;
                        GLOBAL.setName = function(name){};
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">常量</dt>
                <dd>
                    <p>全部字符大写，单词间用下划线连接，同时也要定义在全局对象下，如：</p>

                    <pre class="brush:js">
                        GLOBAL.CONNECTION_URL = 'connection.php';   // 常量
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">命名空间</dt>
                <dd>
                    <p>即使只有一个全局对象，也存在着全局污染的可能性，所以单全局变量模式的项目同样包含“命名空间”的概念。命名空间是简单的通过全局对象的单一属性表示的功能性分组，如：</p>

                    <pre class="brush:js">
                        var GLOBAL = GLOBAL || {};
                        GLOBAL.namespace = function(ns_string){
                            var parts = ns_string.split('.'),
                                parent = GLOBAL,
                                i = 0, j, temp;

                            if( parts[0] === 'GLOBAL' ){
                                parts = parts.slice(1);
                            }
                            for(i = 0, j = parts.length; i &lt; j; i++){
                                temp = parts[i];

                                if( typeof parent[temp] === 'undefined' ){
                                    parent[temp] = {};
                                }
                                parent = parent[temp];
                            }
                            return parent;
                        }

                        // 使用命名空间
                        GLOBAL.namespace('GLOBAL.code.js');
                        GLOBAL.code.js.author = 'ZwB';
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">单一 var 模式</dt>
                <dd>
                    <p>在一个函数中只使用一个
						<span class="code">var</span>，即在函数顶部进行变量声明，提供一个单一的地址以查找到函数需要的所有局部变量，防止出现变量在定义前就被使用的逻辑错误，如：</p>

                    <pre class="brush:js">
                        function doSomething(){
                            var a = 1, b = 2,
                                sum = a + b,
                                myObject = {},
                                i, j;

                            // do something
                        };
                    </pre>

                    <p>如果为了更高的容错性，可以使用以下方式来书写单一 <span class="code">var</span> 模式：</p>

                    <pre class="brush:js">
                        function doSomething(){
                            var a = 1
                                , b = 2
                                , c = 3
                                , d = 4
                                ;
                            // 这样的好处是可以保证不会将逗号写错成分号
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">条件判断</dt>
                <dd>
                    <p>条件判断不要省略大括号，将开放的大括号放置在前面语句的同一行，当条件判断不超过 3 个的时候使用
						<span class="code">if</span>/<span class="code">else</span>，若超过 3 个使用
						<span class="code">switch</span>，条件越多时 <span class="code">switch</span>
						效率越高，同时条件判断按概率从最大到最小的顺序排列</p>

                    <p>使用 <span class="code">switch</span> 时遵循如下风格:
                        <br/>每个 <span class="code">case</span> 和 <span class="code">switch</span>
						对齐（花括号缩进规则除外）
                        <br/>每个 <span class="code">case</span> 中代码缩进
                        <br/>每个 <span class="code">case</span> 以 <span class="code">break</span>
						清除结束，避免贯穿（switch Fall Through，故意忽略 <span class="code">break</span>，使执行完一个
						<span class="code">case</span> 后续连续执行下一个 <span class="code">case</span>）
                        <br/>以 <span class="code">default</span> 结束
						<span class="code">switch</span>，确保总有健全的结果，即使无情况匹配
                    </p>

					<p>如下使用 <span class="code">switch</span>/<span class="code">case</span>
						判断数值范围的时候是合理的，但一般对于数值范围的判断，用
						<span class="code">if</span>/<span class="code">else</span>
						会比较合适。<span class="code">switch</span>/<span class="code">case</span>
						更适合对确定数值的判断</p>

					<pre class="brush:js">
						var age, msg;
						switch(true){
						case isNaN(age):
							msg = 'error';
							break;
						case (age >= 50):
							msg = 'Old';
							break;
						case (age <= 20):
							msg = 'Baby';
							break;
						default:
							msg = 'Young';
							break;
						}
					</pre>
                </dd>
                <dt class="icon icon-arrow-r">循环</dt>
                <dd>
                    <p>循环无疑是和 JavaScript 性能非常相关的一部分。试着优化循环的逻辑，从而让每次循环更加的高效</p>

                    <p>循环不要省略大括号，将开放的大括号放置在前面语句的同一行</p>

                    <p>JavaScript 原生循环方法 <span class="code">for</span> 和 <span class="code">while</span>，要比
						<span class="code">$.each()</span> 方法快</p>

                    <p>不要循环引用</p>

                    <p>对循环进行优化，如访问数组时，存储数组长度，减少对数组的 <span class="code">length</span>
						访问（每次访问是都会对数组进行统计），尤其在访问
						<span class="code">var items = document.getElementsByTagName('a');</span> 等类似方法生成的 HTML
						节点数组（NodeList）时，存储数组长度尤为关键。这些集合通常被认为是“活的”，也就是说，当他们所对应的元素发生变化时，他们会被自动更新</p>

                    <p>同时如果可能，使用倒序访问数组（可以减少一次判断），当使用倒序访问时，也可以使用
						<span class="code">while</span> 循环，如：</p>

                    <pre class="brush:js">
                        var array = [], i = 0, j = array.length;
                        for(; i&lt;j; i++){}
                        for(i=array.length; i--;){}
                        do{
                            array[--j];
                        }while(j);
                        while(j--){}
                    </pre>

                    <p>建议使用 <span class="code">i = i + 1</span> 或 <span class="code">i += 1</span> 的表达式来替换
						<span class="code">i++</span></p>

                    <p><span class="code">for-in</span> 循环是用来遍历对象的，不允许用来遍历数组，同时尽量不使用
						<span class="code">for-in</span> 循环（<span class="code">for</span> 循环的效率比
						<span class="code">for-in</span> 快 7 倍），若使用则在遍历对象时过滤原型继承的属性，如：</p>

                    <pre class="brush:js">
                        var key, data = {};
                        for( key in data ) if( data.hasOwnProperty(key) ){
                            // do something
                        }
                    </pre>

					<p><span class="code">for-in</span>
						循环只能遍历可枚举的属性，即在遍历对象时可用的属性，例如原生的构造函数属性就不会显示，可以使用
						<span class="code">propertyIsEnumerable()</span> 方法检查哪些属性是可枚举的，如：</p>

					<pre class="brush:js">
						console.log( 'apply' in Function );	// true

						for(var k in Function){
							console.log(Function[k])
						}
						// 没有输出

						console.log( Function.propertyIsEnumerable('apply') );	// false 说明 apply 属性不可枚举
                    </pre>

                    <p>除 <span class="code">return</span> 和 <span class="code">throw</span>
						语句，有两种方法可以更改循环的执行过程，一是使用 <span class="code">break</span>，二是使用
						<span class="code">continue</span>。但事实上，使用 <span class="code">continue</span>
						的情况都可以使用条件语句，同时更具可读性，所以推荐避免使用 <span class="code">continue</span>，如：</p>

                    <pre class="brush:js">
                        var arr = [], i, j;
                        for(i=0, j=arr.length; i &lt; j; i++){
                            if( i === 2 ){
                                continue;   // 跳过本次迭代
                            }
                            // do something
                        }
                        // 上面的代码等价于下面的代码，但更方便理解
                        for(i=0, j=arr.length; i &lt; j; i++){
                            if( i !== 2 ){
                                // do something
                            }
                        }
                    </pre>

                    <p>大量 DOM 元素循环修改，在结束时一次性写入</p>
                </dd>
                <dt class="icon icon-arrow-r">函数</dt>
                <dd>
                    <p>和变量声明一样，函数声明也会被 JavaScript 引擎提前，一个 <span class="code">function</span>
						语句就是其值为一个函数的 <span class="code">var</span> 语句的速记形式，但两者有一些不同，如：</p>

					<pre class="brush:js">
						// 函数声明
						doSomething();	// 正常运行，因为 doSomething 在代码运行前已经被创建
						function doSomething(){}

						// 函数赋值表达式
						doOtherThing;	// undefined
						doOtherThing();	// 报错 TypeError
						var doOtherThing = function(){};

						// 命名函数的赋值表达式
						var callback = function doThings(){
							doThings();	// 正常运行
							// 函数名在函数内部总是可见
						}
						doThings();	// 报错 ReferenceError
                    </pre>

					<p>因此在代码中函数的调用可以出现在函数声明之前，但这应该是尽量避免的，建议内部函数应紧接着变量声明之后声明，如：</p>

                    <pre class="brush:js">
                        function doSomething(){
                            var i, j,
                                value = 10;

                            function doThings(index){
                                // do something
                            }

                            for(i=0, j=value; i < j; i++){
                                doThings( i );
                            }
                        }
                        // 上面的函数等价于下面
                        var doSomething = function doSomething(){
                            var i, j,
                                value = 10,
                                doThings = function doThings(index){
                                    // do something
                                };

                            for(i=0, j=value; i < j; i++){
                                doThings( i );
                            }
                        }
                    </pre>

                    <p>对于定义的函数，出入参数的类型固定，不要做多种类型处理，尤其是根据数据类型执行不同操作，不然建议写成闭包的形式</p>

                    <p>一个函数或方法应该只有一个 <span class="code">return</span> 语句</p>

					<p>当访问函数内的变量是，JavaScript 会按照下列顺序查找：</p>

					<ol>
						<li>当前作用域内是否有该变量的定义</li>
						<li>函数形式参数是否有使用该变量名称</li>
						<li>函数自身是否为该变量名称</li>
						<li>回溯到上一级作用域，然后从 #1 重新开始</li>
					</ol>

                    <p>不在块域中使用 <span class="code">function</span>，如：</p>

                    <pre class="brush:js">
                        if( condition ){
                            function doSomething(){
                                alert(1);
                            }
                        }
                        else{
                            function doSomething(){
                                alert(2);
                            }
                        }
                    </pre>

                    <p>虽然可以运行，但是在不同浏览器中的运行结果不同，大多数浏览器都会输出 2，同时在块域中声明函数在 ECMAScript 中是无效的</p>

					<p>原始运算符始终比函数调用要高效，如：</p>

					<pre class="brush:js">
						var min = Math.min(a, b);
						A.push( v );

						// 针对于优化，推荐使用下面的代码：
						var min = a < b ? a : b;
						A[A.length] = v;
                    </pre>
                </dd>
				<dt class="icon icon-arrow-r">arguments 对象</dt>
				<dd>
					<p>JavaScript 中每个函数内都能访问一个特别变量
						<span class="code">arguments</span>，这个变量维护着所有传递到这个函数的参数列表。<span class="code">arguments</span>
						变量不是一个数组，虽然有数组相关的属性 <span class="code">length</span>，但它不从
						<span class="code">Array.prototype</span> 继承</p>

					<p><span class="code">arguments</span>
						对象为其内部属性以及函数形式参数创建 <span class="code">getter</span> 和
						<span class="code">setter</span> 方法，因此改变形参的值会影响到 <span class="code">arguments</span>
						对象的值，反之亦然，如：</p>

					<pre class="brush:js">
						function doSomething(a, b, c){
							console.log( a );	// 1
							console.log( arguments[0] );	// 1

							a = 4;
							console.log( a );	// 4
							console.log( arguments[0] );	// 4

							arguments[1] = 5;
							console.log( b );	// 5
							console.log( arguments[1] );	// 5
						}
						doSomething(1, 2, 3);
                    </pre>

					<p><span class="code">arguments</span>
						对象总会被创建，除了两个特殊情况：作为局部变量声明和作为形式参数，自定义
						<span class="code">arguments</span> 参数将会阻止原生的 <span class="code">arguments</span>
						对象的创建，而不管它是否被使用</p>

					<p>使用 <span class="code">arguments.callee</span> 会显著影响现代 JavaScript 引擎的性能，如：</p>

					<pre class="brush:js">
						function doSomething(){
							arguments.callee;
							arguments.callee.caller;
						}
						function doOtherThing(){
							var i = 0;
							for(; i < 10000; i++){
						    	doSomething();
							}
						}
                    </pre>

					<p>上面代码中，<span class="code">doSomething</span> 不再是一个单纯的内联函数（inlining
						指的是解析器可以做内联处理），因为它需要知道自己和它的调用者。这不仅抵消了内联函数带来的性能提升，而且破坏了封装，因此现在的函数可能要依赖于特定的上下文</p>

					<p>因此建议不要使用 <span class="code">arguments.callee</span> 和它的属性，在 ES5 中
						<span class="code">arguments.callee</span> 属性已被取消</p>
				</dd>
                <dt class="icon icon-arrow-r">匿名函数</dt>
                <dd>
                    <p>匿名函数通常被用来当做立即调用的函数或用来做闭包，如：</p>

                    <pre class="brush:js">
                        var value = (function(){
							var hi = 'Hi';

                            // do something

                            return {
								sayHi: function(){
									return hi;
								}
                            };
                        })();
                    </pre>

					<p>匿名函数被认为是表达式，因此为了可调用性，它们会首先被执行</p>

					<p>其它的调用函数表达式的方法：</p>

					<pre class="brush:js">
						+function(){}();
						(function(){}());
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">闭包</dt>
                <dd>
					<p>闭包是 JavaScript 一个非常重要的特性，这意味着当前作用域总是能够访问外部作用域中的变量。因为函数是
						JavaScript 中唯一拥有自身作用域的结构，因此闭包的创建依赖于函数</p>

					<p>小心使用闭包，过度使用有可能造成内存泄露</p>
				</dd>
                <dt class="icon icon-arrow-r">递归</dt>
                <dd>不允许在在代码中使用递归，各个浏览器对函数的递归都有不同程度的限制，若函数运行时间过长，浏览器将会阻止</dd>
                <dt class="icon icon-arrow-r">异常</dt>
                <dd>
                    <p>在 JavaScript 中抛出错误要比在任何其它语言中做同样的事情更加有价值，这归咎于 Web 端调试的复杂性。使用
						<span class="code">throw</span>
						操作符，将提供的一个对象作为错误抛出，任何类型的对象都可以作为错误抛出，然而
						<span class="code">Error</span> 对象是最常用的，如果没有通过 <span class="code">try-catch</span>
						语句来捕获的，浏览器会直接显示该消息，如：</p>

                    <pre class="brush:js">
                        throw new Error('something bad happened');

                        // 不好的写法，如果没有 try-catch 语句捕获的话，有些浏览器不会显示字符串信息
                        throw 'something bad happened';
                    </pre>

                    <p>抛出错误最佳的地方是在工具函数中</p>

                    <p>用 <span class="code">try-catch</span> 语句来捕获异常，当在 <span class="code">try</span>
						块中发生一个错误时，程序立刻停止执行，然后跳到 <span class="code">catch</span>
						块，并传入一个错误对象，还可以增加一个 <span class="code">finally</span>
						块，<span class="code">finally</span> 块中的代码不管是否有错误发生，最后都会被执行，如：</p>

                    <pre class="brush:js">
                        try{
                            doSomething();
                        }
                        cache(ex){
                            // 不要将 catch 块留空
                            handleError( ex );
                        }
                        finally{
                            continueDoSomething();
                        }
                    </pre>

                    <p>在某些情况下，<span class="code">finally</span> 块工作起来有点复杂，如 <span class="code">try</span>
						块中包含了一个 <span class="code">return</span> 语句，实际上它必须等到
						<span class="code">finally</span> 块中的代码执行后才能返回</p>

                    <p>ECMA-262 规范指出了 7 种错误类型：</p>

                    <ul>
                        <li><span class="code">Error</span> 所有错误的基本类型，实际上引擎从来不会抛出该类型的错误</li>
                        <li><span class="code">EvalError</span> 通过 <span class="code">eval()</span>
							函数执行代码发生错误时抛出</li>
                        <li><span class="code">RangeError</span>
							一个数字超出它的边界时抛出，该错误在正常的代码执行中非常罕见</li>
                        <li><span class="code">ReferenceError</span> 期望的对象不存在时抛出</li>
                        <li><span class="code">SyntaxError</span> 给 <span class="code">eval()</span>
							函数传递的代码中有语法错误时抛出</li>
                        <li><span class="code">TypeError</span> 变量不是期望的类型时抛出</li>
                        <li><span class="code">URIError</span> 给
							<span class="code">encodeURI()</span>、<span class="code">encodeURIComponent()</span>、<span class="code">decodeURI()</span>
							或 <span class="code">decodeURIComponent()</span> 等函数传递格式非法的 URI字符串时抛出</li>
                    </ul>

                    <p>通过检查特定的错误类型可以更可靠的处理错误，如：</p>

                    <pre class="brush:js">
                        try{
                            doSomething();
                        }
                        catch(ex){
                            if( ex instanceof TypeError ){
                                // 处理 TypeError 错误
                            }
                            else if( ex instanceof ReferenceError ){
                                // 处理 ReferenceError 错误
                            }
                            else{
                                // 其它处理
                            }
                        }
                    </pre>

                    <p>抛出其它类型的的对象，可以区分于浏览器的错误，但也会错过 <span class="code">Error</span>
						对象附加的一些额外信息。解决方案是，创建自己的错误类型，让它继承自
						<span class="code">Error</span>，如：</p>

                    <pre class="brush:js">
                        function MyError(message){
                            this.message = message;
                        }
                        MyError.prototype = new Error();

                        throw new MyError('my error');
                    </pre>

					<p>避免在循环内部使用 <span class="code">try-catch</span></p>
                </dd>
                <dt class="icon icon-arrow-r">数组</dt>
                <dd>
                    <p>JavaScript
						的数组只是一种拥有一些类数组特性的对象，它把数组的下标转变成字符串，用其作为属性。它明显比一个真正的数组慢，但它使用起来更方便</p>

                    <p>可以直接设置 <span class="code">length</span> 的值，把 <span class="code">length</span>
						设小将导致所有下标大于等于新 <span class="code">length</span> 的属性被删除</p>

                    <p>数组的 <span class="code">splice()</span>
						方法可以删除一些元素并将它们替换为其它的元素，因为被删除属性后面的每个属性必须被删除，并且以一个新的键值重新插入，这对于大型数组来说可能会效率不高</p>

                    <p>数组中的 <span class="code">shift()</span> 方法通常比 <span class="code">pop()</span> 方法慢很多</p>

                    <p>数组中的默认比较函数，把要被排序的元素都视为字符串。它尚未足够智能到在比较这些元素之前先检查它们的类型，所以当它进行比较时，会把它们转化为字符串，排序结果很有可能不正确，所以应该使用自己的比较函数来替换默认的比较函数</p>

                    <p>通过编写智能的比较函数，也可以使对象数组排序，如：</p>

                    <pre class="brush:js">
                        var by = function(name){
                            return function(o, p){
                                var a, b, rs;

                                if( typeof o === 'object' && typeod p === 'object' && o && p ){
                                    a = o[name];
                                    b = p[name];
                                    if( a === b ){
                                        rs = 0;
                                    }
                                    if( typeof a === typeof b ){
                                        rs = a < b ? -1 : 1;
                                    }
                                    else{
                                        rs = typeof a < typeof b ? -1 : 1;
                                    }
                                }
                                else{
                                    rs = typeof o < typeof p ? -1 : 1;
                                }
                                return rs;
                            };
                        };

                        s.sort( by('name') );

                        // 数组的 sort 方法是不稳定的，所以下面的调用，不能保证产生正确的序列，这时候则需要编写更为复杂的比较函数
                        s.sort( by('name') ).sort( by('level') );
                    </pre>

                    <p>当需要拷贝数组的时候，可以用 <span class="code">slice()</span> 方法，如：</p>

					<pre class="brush:js">
						var arr = [];
						var arrCopy = arr.slice();
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">正则表达式</dt>
                <dd>
                    <p>如果正则表达式带有 <span class="code">g</span>
						标识，查找不是从这个字符串的起始位置开始，而是从正则表达式的 <span class="code">lastIndex</span>
						位置开始，如果匹配成功，那么 <span class="code">lastIndex</span>
						将设置为该匹配后的第一个字符的位置，不成功的匹配会重置 <span class="code">lastIndex</span> 为
						<span class="code">0</span></p>

                    <p>不要对 <span class="code">test()</span> 方法使用 <span class="code">g</span> 标识</p>

                    <p><span class="code">\1</span> 指向分组 1 所捕获的文本的一个引用，如：</p>

                    <pre class="brush:js">
                        var doubled_words = /([A-Za-z\u00C0-\u1FFF\u2800-\uFFFD]+)\s\1/gi;
                        // 该正则表达式可以用来搜索文本中重复的单词
                        // \2 是指向分组 2 的引用，\3 是指向分组 3 的引用，依此类推
                    </pre>

                    <p>当 <span class="code">String.split()</span> 方法的参数是一个正则表达式的时候，IE8
						及其以前版本浏览器会在输出的数组结果中排除空字符串</p>
                </dd>
                <dt class="icon icon-arrow-r">with</dt>
                <dd><span class="code">with</span> 语句可以更改包含的上下文解析变量的方式，通过
					<span class="code">with</span>
					可以用局部变量和函数的形式来访问特定对象的属性和方法，这样就可以将对象前缀省略掉。但是
					<span class="code">with</span> 带来的坏处很多，阅读代码时，很难分辨变量是局部变量还是对象的属性，JavaScript
					引擎和压缩工具无法对代码进行优化，而且在最新的严格模式中，<span class="code">with</span>
					语句是被禁止的，所以应避免使用 <span class="code">with</span> 语句</dd>
                <dt class="icon icon-arrow-r">JSON</dt>
                <dd>
                    <p>使用 JSON 格式进行数据交换，JSON 是 JavaScript 源生格式，处理 JSON 数据不需要特殊 API 或工具包</p>

                    <p>推荐使用标准的 JSON
						格式，要求必须只能使用双引号作为键或值得边界符号，不能使用单引号，而且键必须使用边界符，如：</p>

                    <pre class="brush:js">
                        var json = {
							"a": "abc",
							"b": 123
						};
                    </pre>

                    <p>可以去 <a class="link" href="http://jsonlint.com/">JSONLint</a> 检验一下 json 格式是否正确</p>
                </dd>
                <dt class="icon icon-arrow-r">parseInt</dt>
                <dd>使用 <span class="code">parseInt()</span>
					可以从字符串中获取数值，该方法接受另一个基数参数，这经常省略，但不应该。当字符串以
					<span class="code">"0"</span> 开头的时候就有可能出现问题，开头为 <span class="code">"0"</span>
					的字符串被当做 8 进制处理，这已在 ECMAScript5 中改变了，但为避免矛盾和意外的结果，应该指定基数参数</dd>
                <dt class="icon icon-arrow-r">Date</dt>
                <dd><span class="code">Date</span> 可以接受数值型的参数，可以为 13
					位数字的时间戳，也可以为年、月、日、时、分、秒的数值，但是也可以接受字符串参数，但是有严格的格式要求，以
					yyyy/mm/dd hh:ii:ss 形式，其中时分秒部分可以省略，也可以只省略最后秒的部分</dd>
                <dt class="icon icon-arrow-r">setInterval/setTimeout</dt>
                <dd>
                    <p>不要给 <span class="code">setInterval</span> 或 <span class="code">setTimeout</span>
						传递字符串参数</p>

                    <p>旧版本的 IE 浏览器，存在最小间隔 16ms 的问题</p>
                </dd>
                <dt class="icon icon-arrow-r">对象</dt>
                <dd>
                    <p>提取对象属性时，点表示法比下标表示法效率更高</p>

                    <p>不要修改并非你代码所创建的对象，包括：</p>

                    <ul>
                        <li>原生对象（如：<span class="code">Object</span>、<span class="code">Array</span>）</li>
                        <li>DOM 对象（如：<span class="code">document</span>）</li>
                        <li>浏览器对象模型（BOM）对象（如：<span class="code">window</span>）</li>
                        <li>类库对象</li>
                    </ul>

                    <p>应该把已存在 JavaScript 对象当成一个实用的工具函数一样对待，不覆盖方法，不新增方法，不删除方法</p>
                </dd>
                <dt class="icon icon-arrow-r">继承</dt>
                <dd>
                    <p>在 JavaScript 中继承有两种基本的形式：基于类型的继承和基于对象的继承</p>

                    <p>在 JavaScript 中，继承仍有一些很大的限制。不能从 DOM 或 BOM 对象继承，由于数组索引和
						<span class="code">length</span> 属性之间错综复杂的关系，继承自 <span class="code">Array</span>
						是不能正常工作的</p>
                </dd>
                <dt class="icon icon-arrow-r">基于类型的继承</dt>
                <dd>
                    <p>基于类型的继承是通过构造函数实现的，而非对象。基于类型的继承一般需要两步：首先，原型继承；然后，构造器继承。构造器继承是调用超类的构造函数时传入新建的对象作为其
						<span class="code">this</span> 的值，如：</p>

                    <pre class="brush:js">
                        function Person(name){
                            this.name = name;
                        }

                        function Author(name){
                            Person.call(this, name);    // 继承构造器
                        }
                        Author.prototype = new Person();
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">基于对象的继承</dt>
                <dd>
                    <p>基于对象的继承，也经常叫作原型继承，一个对象继承另外一个对象是不需要调用构造函数的，ECMAScript5 的
						<span class="code">Object.create()</span> 方法是实现这种继承的最简单的方式，如：</p>

                    <pre class="brush:js">
                        var person = {
                            name: 'ZwB',
                            sayName: function(){
                                return this.name;
                            }
                        };

                        var me = Object.create( person );
                        me.sayName();   // ZwB

                        // 在低版本浏览器中可以如此实现 Object.create 方法
                        if( typeof Object.create !== 'function' ){
                            Object.create = function(o){
                                var F = function(){};
                                F.prototype = o;
                                return new F();
                            };
                        }
                    </pre>

                    <p>在一个纯粹的原型模式中，通常会摒弃类，转而专注于对象。基于对象的继承相比于基于类型的继承在概念上更为简单：一个新对象可以继承一个旧对象的属性</p>
                </dd>
                <dt class="icon icon-arrow-r">JavaScript polyfills( 也称 shims )</dt>
                <dd>
                    <p>随着 ECMAScript5 和 HTML5 的特性开始在各种浏览器中的实现，JavaScript polyfills 变得流行起来了。一个
						polyfill 是指一种功能（这些功能在新版本的浏览器中已经有完备定义并原生实现了）的模拟，以便在老版本的浏览器中如同新版本一样使用。polyfills
						的关键是它们模拟的原生功能要以完全兼容的方式来实现，因此在有些浏览器中存在了这些功能，所以有必要检测不同情况下它们的处理是否符合标准的方式。为了达到目的，polyfills
						经常会给非自己拥有的对象新增一些方法。polyfills
						的优点是，当只支持浏览器的原生功能时，它们非常容易删除；缺点是，它们可能没有精确地实现它们（原生浏览器环境）所缺失的功能，从而带来的麻烦比缺失的功能要多得多</p>

                    <p>从最佳的可维护性角度而言，避免使用 polyfills，如果选择使用某个
						polyfill，要做好严格审查，要保证它的功能和原生版本尽可能的近似</p>
                </dd>
                <dt class="icon icon-arrow-r">阻止修改</dt>
                <dd>
                    <p>ECMAScript5 引入了几个方法来防止对对象的修改，有三种锁定修改的级别：</p>

                    <ul>
                        <li>防止扩展 禁止为对象“添加”属性和方法，但已存在的属性和方法是可以被修改或删除</li>
                        <li>密封 类似“防止扩展”，而且禁止为对象“删除”已存在的属性和方法</li>
                        <li>冻结 类似“密封”，而且禁止为对象“修改”已存在的属性和方法（所有字段均只读）</li>
                    </ul>

                    <p>每种锁定的类型都拥有两个方法：一个用来实施操作，另一个用来检测是否应用了相应的操作</p>

                    <pre class="brush:js">
                        var person = {
                            name: 'ZwB'
                        };

                        // 防止扩展
                        Object.preventExtension( person );
                        // 对象是否可以扩展
                        console.log( Object.isExtensible( person ) );   // false
                        person.age = 25;    // 正常情况下执行无效果，严格模式下报错

                        // 密封对象
                        Object.seal( person );
                        console.log( Object.isExtensible( person ) );   // false
                        // 对象是否被密封
                        console.log( Object.isSealed( person ) );   // true
                        delete person.name;    // 正常情况下执行无效果，严格模式下报错

                        // 冻结对象
                        Object.freeze( person );
                        console.log( Object.isExtensible( person ) );   // false
                        console.log( Object.isSealed( person ) );   // true
                        // 对象是否被冻结
                        console.log( Object.isFrozen( person ) );   // true
                        person.name = 'zhao';   // 正常情况下执行无效果，严格模式下报错
                    </pre>

                    <p>在全部定义好对象的功能之后，才能使用上述的锁定方法，一旦一个对象被锁定了，将无法解锁。若将对象锁定，推荐使用严格模式，当尝试修改对象时会抛出错误</p>
                </dd>
                <dt class="icon icon-arrow-r">特性检测</dt>
                <dd>
                    <p>因为各浏览器之间的行为的差异，我们经常需要获得浏览器的类型，通常通过 JavaScript 的
						<span class="code">navigator.userAgent</span>
						来判断，但随着每一个新浏览器出现，用于用户代理检测的代码都需要更新，最安全的方法是只检测旧的浏览器，如 IE8
						及以前版本</p>

                    <p>更好的方法是特性检测，为特定浏览器的特性进行测试，并仅当特性存在时即可应用特性检测。特性检测不依赖与所使用的浏览器，而仅仅依据特性是否存在，所以并不一定需要新浏览器的支持，特性检测的重要组成部分：</p>

                    <ul>
                        <li>探测标准的方法</li>
                        <li>探测不同浏览器的特定方法</li>
                        <li>当被探测的方法均不存在时提供一个合乎逻辑的备用方法</li>
                    </ul>

                    <p>一种不当的使用特性检测的情况是“特性推断”。特性推断尝试使用多个特性但仅验证里其中之一。推断是假设并非事实，而且可能导致维护性的问题</p>
                </dd>
                <dt class="icon icon-arrow-r">HTMLCollections</dt>
                <dd>
                    <p>HTMLCollections 指的是 DOM 方法返回的对象，如：</p>

                    <pre class="brush:js">
                        var name = document.getElementByName( 'text' ),
                            className = document.getElementsByClassName( 'text' ),
                            tagName = document.getElementsByTagName( 'div' );
                    </pre>

                    <p>还有其他一些 HTMLCollections，这些是在 DOM 标准之前引进并且现在还在使用的，如：</p>

                    <pre class="brush:js">
                        var imgs = document.images, // 页面上所有的图片元素
                            links = document.links,    // 所有的 a 标签元素
                            forms = document.forms,    // 所有表单
                            elems = document.forms[0].elements;    // 页面上第一个表单中的所有域
                    </pre>
                </dd>
				<dt class="icon icon-arrow-r">document.all</dt>
				<dd>
					<p><span class="code">document.all</span> 用来取得页面中所有元素，这个方法最初由 IE 实现，后来
						Firefox、Chrome 也实现了该方法，但由于早期开发中，人们会使用 <span class="code">document.all</span>
						来判断是否为 IE 浏览器，所以在 Firefox、Chrome 浏览器中
						<span class="code">typeof document.all</span> 会返回
						<span class="code">"undefined"</span>，但实际是可用的</p>

					<pre class="brush:js">
						console.log( typeof document.all );	// 在 Firefox、Chrome 中输出 undefined

						var dom = document.all;	// HTMLAllCollection[112] （112 为页面中元素总数）
                    </pre>
				</dd>
                <dt class="icon icon-arrow-r">减少 DOM 操作</dt>
                <dd>浏览器遍历 DOM 元素的代价是昂贵的。虽然 JavaScript
					引擎变得越来越强大，越来越快速，但是还是应该最大化的优化查询 DOM 树的操作，减少对 DOM
					元素的查询和修改，查询时可将其赋值给局部变量，这样就没必要每次都去查询 DOM 树了</dd>
                <dt class="icon icon-arrow-r">最小化重绘（repaint）和重排（reflow）</dt>
                <dd>
                    <p>当有任何属性或元素发生改变时，都会引起 DOM 元素的重绘或重排，毫无疑问，应当避免过多的重绘和重排</p>

                    <p>当一个元素的布局不变，外观发生改变时，就会引起重绘，例如改变
						<span class="code">background-color</span></p>

                    <p>当改变一个页面的布局时就会发生重排，例如改变一个元素的宽，重排的代价是最高的</p>

                    <p>例如：当你设置 <span class="code">style.width</span>
						时，浏览器需要重新计算布局。通常浏览器暂时是不需要知道改变了元素的样式的，直到它需要更新屏幕时，正因为如此，改变多个元素的样式只会产生一次重排。</p>

                    <p>优化方法：</p>

                    <ul>
                        <li>将多次改变样式属性的操作合并成一次操作，通过设置 DOM 节点的 <span class="code">class</span>
							的方式减少样式修改次数</li>
                        <li>减少 DOM 元素的几何属性变化</li>
                        <li>减少 DOM 树的结构变化</li>
                        <li>减少获取某些属性，包括
							<span class="code">offsetTop</span>、<span class="code">offsetLeft</span>、<span class="code">offsetWidth</span>、<span class="code">offsetHeight</span>、<span class="code">scrollTop</span>、<span class="code">scrollLeft</span>、<span class="code">scrollWidth</span>、<span class="code">scrollHeight</span>、<span class="code">clientTop</span>、<span class="code">clientLeft</span>、<span class="code">clientWidth</span>、<span class="code">clientHeight</span>、<span class="code">getComputedStyle()</span>(<span class="code">currentStyle</span>
							in IE)</li>
                        <li>将需要多次重排的元素，<span class="code">position</span> 属性设为
							<span class="code">absolute</span>,<span class="code">fixed</span> 或
							<span class="code">relative</span>，这样此元素就脱离了文档流，它的变化不会影响到其他元素。例如有动画效果的元素
							<span class="code">position</span> 设为 <span class="code">fixed</span> 或
							<span class="code">absolute</span></li>
                        <li>在内存中多次操作节点，完成后再添加到文档中去。例如要异步获取表格数据，渲染到页面。可以先取得数据后在内存中构建整个表格的
							HTML 片段，再一次性添加到文档中去，而不是循环添加每一行</li>
                        <li>由于 <span class="code">display</span> 属性为 <span class="code">none</span>
							的元素不在渲染树中，对隐藏的元素操作不会引发其他元素的重排。如果要对一个元素进行复杂的操作时，可以先隐藏它，操作完成后再显示。这样只在隐藏和显示时触发 2
							次重排</li>
                        <li>在需要经常取那些引起浏览器重排的属性值时，要缓存到局部变量</li>
                        <li>最简化 DOM 结构，将 HTML 标签数量降到最低，当 JS
							引发的浏览器重排与重绘事件不可避免时，只能减少所引发的操作量</li>
                        <li>合理规划 JS 的事件，使其影响到的 HTML 标签最少 DOM 树</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">高频执行事件/方法的防抖</dt>
                <dd>
                    <p>通常会在用户交互参与的地方添加事件，而往往这种事件会被频繁触发，比如
						<span class="code">scroll</span>、<span class="code">mouseover</span>
						事件，它们触发时，执行的非常迅速，并且触发很多次，如果回调过重，浏览器可能会 Down
						掉，引入防抖来限制一个方法在一定时间内的执行次数，如：</p>

                    <pre class="brush:js">
                        function debounce(func, wait, immediate){
                            var timeout;
                            return function(){
                                var context = this,
                                    args = arguments,
                                    later = function(){
                                        timeout = null;
                                        if( !immediate ) func.apply(context, args);
                                    },
                                    callNow = immediate && !timeout;

                                clearTimeout(timeout);
                                timeout = setTimeout(later, wait);

                                if( callNow ) func.apply(context, args);
                            };
                        }
                        // 调用方法如下：
                        $(window).on('scroll', debounce(function(e){
                            // do something
                        }, 300));
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">惰性载入</dt>
                <dd>
                    <p>因为各浏览器之间的行为的差异，我们经常会在函数中包含了大量的 <span class="code">if</span>
						语句，以检查浏览器特性，解决不同浏览器的兼容问题，解决的方案就是称之为惰性载入的技巧，如：</p>

                    <pre class="brush:js">
                        function doSomething(){
                            var IE, FF;
                            if( IE ){
                                doSomething = function(){
                                    //  do something IE 浏览器的操作
                                };
                            }
                            else if( FF ){
                                doSomething = function(){
                                    // do something FF 浏览器的操作
                                };
                            }

                            return doSomething();
                        };
                    </pre>

                    <p>在这个惰性载入的 <span class="code">doSomething()</span> 中，<span class="code">if</span>
						语句的每个分支都会为 <span class="code">doSomething</span>
						变量赋值，有效覆盖了原函数。最后一步便是调用了新赋函数。下一次调用
						<span class="code">doSomething()</span> 的时候，便会直接调用新赋值的函数，这样就不用再执行
						<span class="code">if</span> 语句了。</p>

                    <p>另一种实现惰性载入的方式是在声明函数时就指定适当的函数。这样在第一次调用函数时就不会损失性能了，只在代码加载时会损失一点性能，如：</p>

                    <pre class="brush:js">
                        var doSomething = (function(){
                            var IE, FF;
                            if( IE ){
                                return function(){
                                    //  do something IE 浏览器的操作
                                };
                            }
                            else if( FF ){
                                return function(){
                                    // do something FF 浏览器的操作
                                };
                            }
                        })();
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">级联</dt>
                <dd>
                    <p>级联，当自定义一个对象时，若其的方法没有特定的返回值时，使其返回
						<span class="code">this</span>，目的是分割函数，以创建更加简短、具有特定功能的函数，提高了代码的可维护性，同时也可以节省一些输入的字符，但缺点在于代码更加难以调试，如：</p>

                    <pre class="brush:js">
                        var obj = {
                            value: 0,
                            increment:function(){// value 增长 1
                                this.value++;
                                return this;
                            },
                            add:function(v){// value 增加 v
                                this.value += v;
                                return this;
                            },
                            get:function(){// 返回 value
                                return this.value;
                            }
                        };

                        var num = obj.increment().add(10).get();    // 11
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">控制 Cookie 大小和污染</dt>
                <dd>
                    <p>去除不必要的 Cookie，使 Cookie 体积尽量小以减少对用户响应的影响</p>

                    <p>使用 Cookie 跨域操作时注意在适应级别的域名上设置 Cookie 以便使子域名不受其影响</p>

                    <p>合理的设置 Cookie 过期时间，会改善用户的响应时间</p>
                </dd>
                <dt class="icon icon-arrow-r">注释</dt>
                <dd>
                    <pre class="brush:js">
                        /**
                         * 这是多行注释，星号后应该有一个空格
                         *
                         * 其中多行注释应该注意 JS 代码中的正表达式，因为其中有可能含有使多行注释结束的字符
                         */
                        function doSomething(){
                            var i = 3;  // 这是单行注释，在代码后面的单行注释应有一个缩进，'//' 后应该空一格

                            // 单行注释要与所注释的代码保持一致的缩进
                            while( i-- ){
                                func( i );
                            }
                        }
                    </pre>

                    <p>但在发布前应利用自动化工具删除注释、空格和缩进，压缩 JS 文件的体积，因为这些对浏览器不重要</p>
                </dd>
                <dt class="icon icon-arrow-r">文档注释</dt>
                <dd>
                    <p>强烈推荐使用文档生成工具来为你的 JavaScript
						生成文档，当使用文档注释时，应确保对所有的方法、所有的构造函数、所有包含文档化方法的对象添加注释。注释的详细格式和用法最终还是由所选择的文档生成工具所决定的，如：</p>

                    <pre class="brush:js">
                        /**
                         * @namespace  命名空间
                         * @module     模块
                         * @author     作者
                         * @param      参数
                         * @return     返回值
                         * @description    说明
                         * @example    例子
                         */
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">测试工具</dt>
                <dd>所有 JS 代码必须通过验证（可根据项目需要自定义标准）， 如：
                    <a class="link" target="_blank" href="//www.jslint.com/">JS Lint</a>、
                    <a class="link" target="_blank" href="//www.jshint.com/">JS Hint</a>
                </dd>
                <dt class="icon icon-arrow-r">单元测试</dt>
                <dd>为了编写可维护的
					JavaScript，测试驱动是必不可少的。因为每个测试都起到质量反馈的作用，给后期维护和修改创建了一个安全保护网并提供了一份可执行的文档。通过测试，我们可以保证所有的功能被覆盖，也避免了重写代码后再进行测试的高昂代价。</dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">图片优化
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">矢量图</dt>
                <dd>缩放、旋转不失真的图像格式。存储的文件较小，但是很难表现色彩层次丰富的逼真图像效果，图片格式：EPS、CDR、AI、WMF，主要应用于印刷</dd>
                <dt class="icon icon-arrow-r">位图</dt>
                <dd>又叫栅格图、像素图，最小单位由像素构成，缩放、旋转会失真，图片格式：JPG、GIF、PNG、BMP、PSD、TIF，主要用于网页</dd>
                <dt class="icon icon-arrow-r">GIF</dt>
                <dd>GIF 使用一种叫做 LZW
					的无损压缩格式，非常适合带有大块相同颜色区域的图像。单色插图、文本、色块等文件非常适合存为此格式。GIF
					使用颜色索引来实现无损压缩，该格式的色深只允许同一张图片中最多出现 256
					种颜色，对于超过范围的若干种颜色只能忍痛割爱。但对于少于 256
					种颜色的图像，其颜色索引也会相应地变小，这也就意味着图片文件的整体大小也将随之降低。当然，对于超过 256
					种颜色的图像，仍可以将其存为 GIF 格式，不过某些颜色信息将丢失——最终变成有损压缩。此外，GIF
					还支持基于帧的简单动画以及隔行加载技术，但这两者都将增加文件大小</dd>
                <dt class="icon icon-arrow-r">JPEG</dt>
                <dd>JPEG 的 24 位色深让其能够很好的显示照片等色彩、细节丰富的图像。JPEG
					支持有损压缩且可以设置压缩等级，压缩比很大的 JPEG
					图像将会高度失真，并引发一种叫做非自然痕迹的小像素缺陷问题。虽然图像中的丰富细节将会淡化非自然痕迹的影响，但在使用
					JPEG 是仍要把握好图像质量和文件大小之间的平衡关系，JPEG 不支持任何形式的透明度，最新的“渐进
					JPEG(Progressive JPEG)”版本能够和 GIF 一样实现隔行加载</dd>
                <dt class="icon icon-arrow-r">PNG</dt>
                <dd>PNG 格式在有些方面与 GIF 类似，但它提供了两种色深模式：24 位和 8 位。24 位色深的 PNG
					通常都很大，但却能保证完全无损，原始图片的所有细节都将被精确地保留。8 位色深的 PNG 文件使用了类似 GIF
					的颜色索引，但很多时候，同样设置下用 PNG 压缩的图像要比 GIF 更小。PNG 还支持两种模式的透明度设置：1
					位（bit）或 8 位。前者与 GIF 的行为一样，而后者则能够实现 256 级的透明度，但不幸的是，IE6 不能正确呈现出 PNG
					的透明度设置</dd>
                <dt class="icon icon-arrow-r">无损压缩</dt>
                <dd>图片文件中包含许多对于 Web 来说没用的东西，例如：JPEG 图片中可能包含 Exif
					元数据（数据，相机型号，坐标等），PNG
					图片会包含有关颜色，元数据的信息，有时甚至还包含一个缩略图，应利用自动化工具来删除这些信息，这个被称作无损压缩</dd>
                <dt class="icon icon-arrow-r">有损压缩</dt>
                <dd>以图片质量为代价进行压缩，称为有损压缩。例如：处理 PNG 图片时，常见的是减少颜色数量，或者将 PNG-24 格式转换为
					PNG-8 格式；处理 JPEG 图片时，可以选择导出质量（0 到 100），选择可接受范围内的最低值</dd>
                <dt class="icon icon-arrow-r">透明</dt>
                <dd>GIF 支持 1
					位的透明度，即某个像素要么完全透明，要么完全不透明，没有任何中间值，所以使用时必须格外小心。所有其他半透明的像素都要恰当地与背景颜色融合在一起，即所谓的“蒙版颜色”。蒙版必须与该
					GIF 周围的背景颜色协调一致，否则将呈现出明显的不协调边缘</dd>
                <dt class="icon icon-arrow-r">优化</dt>
                <dd>
                    <p>优化图片大小的诀窍在于适当牺牲一定的图像质量</p>

                    <p>优化 GIF 的步骤通常是从最低的颜色级别开始，逐步提高颜色数目。直至可以接受。若从 8
						种颜色开始，那么接下来就依次查看 16、32、64、128、256 种颜色的样子，直到你觉得满意。某些图像确实需要或超过
						256 种颜色，则考虑使用 JPEG 代替 GIF。还有一些设定能够影响到 GIF
						格式文件的大小。例如抖动技术（dither）即可在一块相同颜色区域中添加另一种颜色的像素，这个技术可以用于模拟出一些本不在文件颜色索引中的颜色。但抖动技术也将影响文件的压缩比率，若是只考虑降低文件大小，那么某些时候增加颜色种类可能要比使用抖动技术更为有效</p>

                    <p>优化 JPEG 很简单，在保存为 JPEG
						格式时，选择品质等级即可，最好的方式是从较低品质（即较高压缩比）的图像开始，逐步提高品质，直到对图像质量满意为止，同时从性能考虑，选择可接受范围内的最低值，为了提升用户体验，还应将你的
						JPEG 文件转换为渐进式的。现在大多数浏览器都支持渐进式 JPEG
						文件，并且这个格式文件创建简单，没有明显的性能损失问题，页面中这种格式的图片能够更快的展现</p>

                    <p>使用 PNG 图片时，要求图片格式为 png-8 格式，若 png-8 实在影响图片质量，再使用其它格式，优化 8 位 PNG
						图像的步骤与优化 GIF 完全一致，24 位 PNG 图像的优化更为简单——无需任何关注。因为 PNG
						的唯一压缩方式固化在文件格式中，根本无法更改</p>
                </dd>
                <dt class="icon icon-arrow-r">减少图像的数目</dt>
                <dd>
                    <ul>
                        <li>尽可能使用文本样式代替图像</li>
                        <li>只保留图像中为实现预期效果所必需的部分</li>
                        <li>使用细条图像填充背景</li>
                        <li>尽可能地重复使用图像</li>
                        <li>合理地选用图像或颜色</li>
                        <li>图片较多的页面可以使用 lazyLoad 等技术</li>
                    </ul>
                </dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">服务器端优化
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">请减少 HTTP 请求</dt>
                <dd>
                    <p>合并图片，图片较多的页面可以使用 lazyLoad 等技术</p>

                    <p>合并 CSS 文件</p>

                    <p>合并 JS 文件 </p>
                </dd>
				<dt class="icon icon-arrow-r">精简文件</dt>
				<dd>在发布前，压缩 HTML、CSS 与 JS 文件，降低图片保存质量</dd>
				<dt class="icon icon-arrow-r">使用 CDN(内容分发网络) 加速</dt>
                <dd>
                    <p>可将网站的图片、CSS、JS、资料、资源放到独立的站点，做下 CDN 加速，二级域名会有 Cookies，最好使用一级域名</p>

                    <p>实时性不太好是 CDN
						的致命缺陷，解决方法是在网络内容发生变化时将新的网络内容从服务器端直接传送到缓存器，或者当对网络内容的访问增加时将数据源服务器的网络内容尽可能实时地复制到缓存服务器</p>
                </dd>
                <dt class="icon icon-arrow-r">GZIP</dt>
                <dd>服务器端启用 GZIP 压缩</dd>
				<dt class="icon icon-arrow-r">支持浏览器缓存</dt>
				<dd>如果浏览器能缓存一个文件，那就无需反复下载该文件了，在 HTTP 头中设置合适的 Expires
					Header、上一次修改时间或采用的 ETags</dd>
                <dt class="icon icon-arrow-r">引擎渲染网页</dt>
                <dd>
                    <p>在服务器端设置让服务器告诉 IE 采用何种引擎来渲染</p>

                    <p>Apache:</p>

                    <pre class="brush:xml">
                        &lt;IfModule mod_setenvif.c&gt;
                        &lt;IfModule mod_headers.c&gt;
                        BrowserMatch MSIE ie Header set X-UA-Compatible "IE=Edge" env=ie BrowserMatch chromeframe gcf Header append X-UA-Compatible "chrome=1" env=gcf
                        &lt;/IfModule&gt;
                        &lt;/IfModule&gt;
                    </pre>

                    <p>Nginx:
                        <br/>在 <span class="code">server{}</span> 区域里（最好是闭合符前面起一行）添加
						<span class="code">add_header "X-UA-Compatible" "IE=Edge,chrome=1";</span></p>
                </dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">基于 jQuery 的规范和优化
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">版本</dt>
                <dd>总是使用最新的版本，因为新版本会改进性能，还有很多新功能</dd>
                <dt class="icon icon-arrow-r">选择器</dt>
                <dd>
                    <p>最快的选择器：<span class="code">id</span> 选择器和元素标签选择器</p>

                    <p>较慢的选择器：<span class="code">class</span> 选择器（取决于浏览器版本，新版本会有
						<span class="code">getElementsByClassName()</span> 方法，所以也许并不慢。。。是的，就是低版本的 IE
						会很慢）</p>

                    <p>最慢的选择器：伪类选择器和属性选择器（因为浏览器没有针对它们的原生方法，一些浏览器的新版本，增加了
						<span class="code">querySelector()</span> 和 <span class="code">querySelectorAll()</span>
						方法，没错。。。同上）</p>

                    <p>在 <span class="code">class</span> 前面使用标签（这条是针对低版本的 IE
						浏览器的，在现代浏览器中，这样做会使 <span class="code">jQuery</span> 使用
						<span class="code">querySelector()/querySelectorAll()</span>，而不去使用
						<span class="code">getElementsByClassName()</span>，从而可能会降低一些性能）</p>

                    <p>优化选择器以适用 <span class="code">Sizzle</span>
						的“从右至左”模型，确保最右的选择器具体些，而左边的选择器选择范围较宽泛些，如：</p>

                    <pre class="brush:js">
						// 不推荐
                        var linkContacts = $('a.contact-links .side-wrapper');

                        // 推荐
                        var linkContacts = $('.contact-links div.side-wrapper');
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">关于 jQuery 对象与 jQuery 函数</dt>
                <dd>尽量少生成 jQuery 对象</dd>
                <dt class="icon icon-arrow-r">父元素与子元素</dt>
                <dd>
                    <p>以下为按速度排序（以 <span class="code">$</span> 开头的为 jQuery 对象）</p>

                    <ol>
                        <li><span class="code">$parent.find('.child')</span></li>
                        <li><span class="code">$('.child', $parent)</span></li>
                        <li><span class="code">$('.child', $('#parent') )</span></li>
                        <li><span class="code">$parent.children('.child')</span></li>
                        <li><span class="code">$('#parent > .child')</span></li>
                        <li><span class="code">$('#parent .child')</span></li>
                    </ol>
                </dd>
                <dt class="icon icon-arrow-r">for 与 each</dt>
                <dd>原生 JavaScript 的执行几乎总是要比 jQuery 快一些。正因为如此，请使用 JavaScript 的
					<span class="code">for</span> 循环，不要使用 <span class="code">$.each()</span>
					方法。但是请注意，虽然 <span class="code">for-in</span> 循环是原生的，可是在许多情况下，它的性能要比
					<span class="code">$.each()</span> 差一些</dd>
                <dt class="icon icon-arrow-r">缓存变量</dt>
                <dd>选择器的使用次数应该越少越好，尽可能缓存选择器的结果，便于以后反复使用</dd>
                <dt class="icon icon-arrow-r">链式调用</dt>
                <dd>
                    <p>采用链式写法时，jQuery 自动缓存每一步的结果，比非链式写法要快</p>

                    <p>值得注意的是链式调用中的对象是有可能改变，这时为了方便团队开发应该使用缩进来标示对象的改变，如：</p>

                    <pre class="brush:js">
                        $('div#container')
                            .attr('lang', 'en')
                                .find('h1') // 用额外的缩进标示对象的改变
                                .css('background', 'red')
                                .attr('title', 'h1')
                            .end() // 当对象回到最初值时，缩进重新回归
                                .find('a')
                                .on('click', function(){});
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">DOM 结构</dt>
                <dd>
                    <p>改动 DOM 结构开销很大，不要频繁使用
						<span class="code">append()</span>、<span class="code">insertBefore()</span> 和
						<span class="code">insertAfter()</span> 等方法</p>

                    <p>如果要插入多个元素，就把它们合并，一次性插入</p>

                    <p>如果对一个 DOM 元素进行大量处理，应先使用 <span class="code">detach()</span>
						方法，处理完毕后，再重新插回文档</p>

                    <p>插入 HTML 代码的时候，源生的 <span class="code">innerHTML</span> 比 jQuery 的
						<span class="code">html()</span> 方法更快</p>

                    <p>jQuery 的文档操作接口根据编程的不同场景来划分使用它们</p>

                    <p>如果需要插入硬编码的元素或者跟在静态实例后面的元素，使用 <span class="code">append()</span> 方法</p>

                    <p>如果需要处理包含多个元素或者动态数据的对象，使用 <span class="code">appendTo()</span> 方法</p>
                </dd>
                <dt class="icon icon-arrow-r">样式变更</dt>
                <dd>
                    <p>要给少数的元素加样式，通常的方法是使用 jQuery 的 <span class="code">css()</span> 方法，然而更新 15
						个以上的较多的元素添加样式时，直接给 DOM 添加 <span class="code">style</span>
						标签更有效些。这个方法可以避免在代码中使用硬编码（hard code）。如：</p>

                    <pre class="brush:js">
                        $('&lt;style type="text/css"&gt;div.class{color: red;}&lt;/style&gt;').appendTo('head');
                    </pre>

                    <p>不建议使用 <span class="code">css()</span> 方法直接改变 CSS 属性，建议将需要更改的 CSS
						属性定义为一个类，使用
						<span class="code">addClass()</span>、<span class="code">removeClass()</span>
						函数来控制，所以布局编写 CSS 时，要考虑各种情况</p>
                </dd>
				<dt class="icon icon-arrow-r">不要处理不存在的元素</dt>
				<dd>
					<p>不要处理不存在的元素</p>

					<pre class="brush:js">
						// 糟糕的做法，jQuery 内部要执行三个函数后才知道这个元素其实不存在
						$('#noSuchThing').slideUp();

						// 推荐的做法
						var $selector = $('#noSuchThing');
						if( $selector.length ){
							$selector.slideUp();
						}
                    </pre>
				</dd>
                <dt class="icon icon-arrow-r">动画与特效</dt>
                <dd>
					<p>使用 CSS 动画比起 JavaScript 驱动的动画效率更高，在不支持 CSS 动画的情况下（IE8
						及以下版本的浏览器），你可以引入 JavaScript 动画逻辑</p>

					<p>保持一个始终如一风格统一的动画实现</p>
				</dd>
                <dt class="icon icon-arrow-r">事件</dt>
                <dd>
                    <p>基于 jQuery 1.7 以后的版本开发时，绑定事件使用 <span class="code">on()</span> 方法，解绑使用
						<span class="code">off()</span> 方法，因为
						<span class="code">bind()</span>、<span class="code">live()</span>、<span class="code">delegete()</span>
						方法均为调用 <span class="code">on()</span> 函数，减少不必要的开销，并且这些方法将会在未来的版本中取消</p>

                    <p>绑定事件时，将事件绑定到离事件触发点最近的父级，事件冒泡也会影响效率，且有可能触发非预期的事件</p>

                    <p>父级代理多个子级事件时，不要使用 CSS 中已定义的 <span class="code">class</span>
						样式名称，而要自定义，防止结构变化对功能的影响</p>

                    <p>绑定事件，若绑定无名函数，一定要加命名空间，方便解绑时使用，如：</p>

                    <pre class="brush:js">
                        // 绑定函数
                        $('a').on('click.update', function(){
                            // do something
                        });

                        // 解除绑定时
                        $('a').off('click.update');
                    </pre>

                    <p>将事件绑定与事件定义分离（所以不推荐上一条的无名函数，但不得不使用则请遵守，同时本条也推荐使用命名空间），同时将事件定义在同一个命名空间下，如：</p>

                    <pre class="brush:js">
                        var clickEvent = {
                            show:function(){
                                // do something
                            }
                        };

                        $('a').on('click.show', clickEvent.show);
                    </pre>

                    <p>在绑定的事件中，可以使用 DOM 的源生属性，而尽量不要将 <span class="code">this</span> 封装为 jQuery 对象
						<span class="code">$(this)</span>，如：</p>

                    <pre class="brush:js">
                        var clickEvent = {
                            show:function(){

								// 不推荐
								console.log( $(this).html() );

								// 推荐
								console.log( this.innerHTML );
							}
                        }
                    </pre>

                    <p>不要对非交互型的标签绑定键盘事件（<span class="code">keydown</span>，<span class="code">keyup</span>，<span class="code">keypress</span>），尤其不要对
						<span class="code">document</span> 绑定，仅仅建议对
						<span class="code">input:text</span>,<span class="code">textarea</span>
						等用户可输入类型的控件进行键盘事件绑定</p>
                </dd>
                <dt class="icon icon-arrow-r">结构、样式与功能分离</dt>
                <dd>
                    <p>为防止 CSS 代码样式变更，对一个 <span class="code">class</span> 绑定事件时，不要使用 CSS
						样式文件中已定义的样式 <span class="code">class</span>，而使用自定义的
						<span class="code">class</span> 名，最好遵从某些规律，推荐以 <span class="code">j-</span> 或
						<span class="code">js-</span> 为前缀</p>

                    <p>同时为防止 HTML 代码层级结构变化，尽量不使用固定结构的方法，如：<span class="code">next()</span>,<span class="code">prev()</span>,<span class="code">parent()</span>
						等。而使用 <span class="code">parents()</span> 找到模块级别的父级再使用
						<span class="code">find()</span> 来执行</p>
                </dd>
                <dt class="icon icon-arrow-r">Ajax</dt>
                <dd>
					<p>不推荐使用 <span class="code">$.get()</span>、<span class="code">$.post()</span> 或
						<span class="code">$.getJSON()</span> 等方法，因为最终将转为
						<span class="code">$.ajax()</span>
						方法</p>

                    <p>触发功能型数据交互 Ajax
						的一定是一个链接（<span class="code">&lt;a&gt;&lt;/a&gt;</span>）的点击事件或表单（<span class="code">&lt;form&gt;&lt;/form&gt;</span>）的提交事件，Ajax
						一定要写错误处理</p>

                    <p>表单：所有想要提交的数据同时必须在该表单中，对其绑定 <span class="code">submit</span> 事件，Ajax 的 URL
						放在 <span class="code">form</span> 标签的 <span class="code">action</span>
						属性中，<span class="code">type</span> 属性使用 <span class="code">POST</span>
						方式（可视具体情况而定，例如搜索可以使用 <span class="code">GET</span>）</p>

                    <p>链接：<span class="code">type</span> 使用 <span class="code">GET</span>
						方式（可视具体情况而定），所要传递的参数直接写在 <span class="code">href</span>
						属性中，若想传递其它参数可通过其它触发事件来改变该链接的 <span class="code">href</span> 属性的值</p>

                    <p>若为获取页面数据型的 Ajax 建议以模块划分，以事件的形式绑定到模块的最顶级标签上：如：</p>

                    <pre class="brush:js">
                        var $header = $('#module_header').on('getUserData', function(e, uid){
                            $.ajax({
                                url: 'getUserData.php',
                                data: 'userId='+ uid,
                                dataType: 'json',
                                success:function(data){
                                    // do something
                                }
                            });
                        });

                        $header.triggerHandler('getUserData', [1]);
                    </pre>

					<p>Ajax 方法的参数集中有
						<span class="code">context</span>(上下文)，若设置，参数集中定义的函数（如：<span class="code">success</span>
						等）的 <span class="code">this</span> 会被指向
						<span class="code">context</span>，建议使用节省资源消耗</p>

					<p>当需要发送多个 Ajax 到服务器端验证时，不要对 Ajax 进行嵌套，也可使用
						<span class="code">triggerHandler()</span> 方法，如：</p>

                    <pre class="brush:js">
                        $validItem.on({
                            checkName:function(e){
                                $.ajax({
                                    url: 'checkName.php',
                                    data: '',
                                    dataType: 'json',
                                    context: $validItem,
                                    success:function(data){
                                        // do something

                                        if( data ){

                                            this.triggerHandler('checkEmail');
                                        }
                                    }
                                });
                            },
                            checkEmail:function(e){
                                $.ajax({
                                    url: 'checkEmail.php',
                                    data: '',
                                    dataType: 'json',
                                    context: $validItem,
                                    success:function(data){
                                        // do something

                                        if( data ){

                                            this.triggerHandler('checkPhone');
                                        }
                                    }
                                });
                            },
                            checkPhone:function(e){
                                $.ajax({
                                    url: 'checkEmail.php',
                                    data: '',
                                    dataType: 'json',
                                    context: $validItem,
                                    success:function(data){
                                        // do something

                                        if( data ){
                                            // 通过验证
                                        }
                                    }
                                });
                            }
                        });

                        $validItem.triggerHandler('checkName');
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">data()</dt>
                <dd>采用 jQuery 的内部方法 <span class="code">data()</span> 来存储状态</dd>
                <dt class="icon icon-arrow-r">jQuery utility</dt>
                <dd>使用 jQuery 的 utility 方法，如
					<span class="code">$.isFunction()</span>,<span class="code">$.isArray()</span> 等</dd>
				<dt class="icon icon-arrow-r">$.Deferred()</dt>
				<dd><span class="code">$.Deferred()</span> 是 jQuery 基于 Promise
						规范的实现，使用可以降低异步编程的复杂度</dd>
                <dt class="icon icon-arrow-r">$.Callbacks()</dt>
                <dd>
                    <p>jQuery 多用途的回调函数列表对象 <span class="code">$.Callbacks()</span></p>

                    <pre class="brush:js">
                        function fn1(){
                            console.log(1);
                        }
						function fn2(){
							console.log(2);
						}

                        var callbacks = $.Callbacks();

                        callbacks.add(fn1);
						callbacks.add(fn2);
						callbacks.add(fn1);
                        callbacks.fire();   //  1 2 1
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">模块化 组件化</dt>
                <dd>
                    <p>对一个模块的所有交互事件绑定到该模块最顶级的标签上，如：</p>

                    <pre class="brush:js">
                        $('#module_header').on({
                            getListData:function(e, param){// 消息 接收参数 获取数据/组建数据
                                var data = {};
                                return data;
                            },
                            showListData:function(e, data, $target){// 接收数据 构建 UI 组件 显示数据
                                $target.html(data.info);
                            }
                        // 事件 UI 交互
                        }).on('click', '#loginBth', function(){// 登录按钮
                            // do something
                        }).on('click', '#registBtn', function(){// 注册按钮
                            // do something
                        });
                    </pre>

                    <p>通过事件和消息实现组件通信</p>

                    <p>在 Web 应用中可以使用事件和消息实现组件通信。</p>

                    <p>事件允许一个组件同自身通信</p>

                    <p>消息则允许一个组件以非硬编码的方式监听其他组件</p>
                </dd>
				<dt class="icon icon-arrow-r">插件相关</dt>
				<dd>
					<p>始终选择一个有良好支持，完善文档，全面测试过并且社区活跃的插件</p>

					<p>注意所用插件与当前使用的 jQuery 版本是否兼容</p>

					<p>一些常用功能应该写成 jQuery 插件</p>
				</dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">浏览器兼容
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">浮动元素的双倍 margin</dt>
                <dd>
                    <p>浏览器版本：IE6</p>

                    <p>触发条件：给元素设置了 <span class="code">float</span> 并且同时和 <span class="code">float</span>
						同一方向设置了 <span class="code">margin</span> 值</p>

                    <p>解决方案：浮动元素中增加一个 <span class="code">display:inline;</span> 属性</p>
                </dd>
                <dt class="icon icon-arrow-r">不识别 min-height、min-width 属性</dt>
                <dd>
                    <p>浏览器版本：IE6</p>

                    <p>触发条件：使用了 <span class="code">min-height</span>、<span class="code">min-width</span> 属性</p>

                    <p>解决方案：使用 <span class="code">height:auto !important;</span> 解决</p>
                </dd>
<!--                <dt class="icon icon-arrow-r">不正确的浮动伸缩</dt>-->
<!--                <dd>浏览器版本：IE 6、7-->
<!--                    <p>触发条件：跟随在其它浮动元素之后的浮动元素，设置 clear 属性时不能正确伸缩</p>-->
<!--                    <p>解决方案：</p>-->
<!--                </dd>-->
                <dt class="icon icon-arrow-r">页面上小于 12px 的字都以 12px 显示</dt>
                <dd>
                    <p>浏览器版本：Chrome 全版本</p>

                    <p>触发条件：设置元素的字体大小小于 <span class="code">12px</span></p>

                    <p>解决方案：使用 webkit 内核私有属性 <span class="code">-webkit-text-size-adjust:none;</span>
						再设置字体大小</p>
                </dd>
                <dt class="icon icon-arrow-r">页面内容的瞬间闪烁（FOUC）</dt>
                <dd>
                    <p>如果使用 <span class="code">@import</span> 方法对 CSS 进行导入，会导致某些页面在 Windows 下的
						IE 出现一些奇怪的现象：以无样式显示页面内容的瞬间闪烁，这种现象称之为文档样式短暂失效（Flash of Unstyled
						Content），简称为 FOUC</p>

                    <p>浏览器版本：IE</p>

                    <p>触发条件：
                        <br/>使用 <span class="code">@import</span> 方法导入样式表
                        <br/>将样式表放在页面底部
                        <br/>有几个样式表，放在 HTML 结构的不同位置
                    </p>

                    <p>解决方案：使用 <span class="code">link</span> 标签将样式表放在文档 <span class="code">head</span> 中</p>
                </dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">JavaScript 设计模式
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">单例模式</dt>
                <dd>
                    <pre class="brush:js">
                        /**
                         * 基类
                         * @class  Robot
                         */
                        function Robot(){}
                        Robot.prototype.hi = function(){
                            return this.hello;
                        };

                        /**
                         * 继承类
                         * @class  RobotMaker
                         */
                        function RobotMaker(name){  // 构造函数
                            if( !(this instanceof RobotMaker) ){
                                return new RobotMaker(name);
                            }

                            var onlyOne, makeNum = 0,
                                Robots = [],
                                index = 0;

                            if( typeof RobotMaker.onlyOne === 'object' ){
                                return RobotMaker.onlyOne;
                            }

                            this.name = name;
                            this.type = 'RobotMaker';
                            this.makeNum = 0;
                            this.hello = 'Hi, I\'m a Robot, and I\'m the only one RobotMaker, you don\'t need the second, my name is '+ this.name;

                            RobotMaker.onlyOne = this;
                            return this;
                        }
                        RobotMaker.prototype = new Robot();

                        // test
                        var r1 = new RobotMaker('r1');
                        var r2 = new RobotMaker('r2');

                        console.log(r1.hi());
                        console.log(r2.hi());
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">工厂模式</dt>
                <dd>
                    <pre class="brush:js">
                        RobotMaker.prototype.createId = function(){
                            this.makeNum++;
                            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c){
                                var r = Math.random()*16|0, v = c==='x'? r : (r&0x3|0x8);
                                return v.toString(16);
                            }).toUpperCase();
                        };
                        RobotMaker.prototype.MakeRobot = function(type){
                            var newRobot, robotType;

                            if( type in RobotMaker && typeof RobotMaker[type] === 'function' ){
                                robotType = RobotMaker[type];
                                newRobot = new Robot();
                                newRobot.maker = this;
                                newRobot.id =  this.createId();
                                newRobot.power = 0;
                                newRobot.weapons = [];
                                newRobot.hello = 'Hi, I\'m a Robot, created by RobotMaker '+ this.name +', my id is '+ newRobot.id +', my type is '+ type;
                                robotType(newRobot);

                                this.CreatedRobots.add( newRobot );
                            }
                            else{
                                newRobot = null;
                            }
                            return newRobot;
                        };
                        RobotMaker.Tank = function(robot){
                            robot.type = 'Tank';
                            RobotMaker.addWeapon(robot, ['missile', 'gun']);
                        };
                        RobotMaker.Plant = function(robot){
                            robot.type = 'Plant';
                            RobotMaker.addWeapon(robot, ['bomb']);
                        };
                        RobotMaker.Boat = function(robot){
                            robot.type = 'Boat';
                            RobotMaker.addWeapon(robot, ['missile']);
                        };

                        // test
                        var robot1 = r1.MakeRobot('Tank');
                        var robot2 = r1.MakeRobot('Plant');
                        var robot3 = r1.MakeRobot('Boat');
                        var robot4 = r1.MakeRobot('Tank');
                        var robot5 = r1.MakeRobot('Plant');
                        var robot6 = r1.MakeRobot('Boat');

                        console.log(robot1.hi());
                        console.log(robot2.hi());
                        console.log(robot3.hi());
                        console.log(robot4.hi());
                        console.log(robot5.hi());
                        console.log(robot6.hi());
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">迭代器模式</dt>
                <dd>
                    <pre class="brush:js">
                        RobotMaker.prototype.CreatedRobots = {
                            robots:[],
                            index:0,
                            add:function(robot){
                                this.robots.push(robot);
                            },
                            next:function(){    // 下一个
                                return this.hasNext() ? this.robots[this.index++] : null;
                            },
                            prev:function(){    // 上一个
                                return this.index === 0 ? null : this.robots[this.index--];
                            },
                            hasNext:function(){ // 是否存在下一个
                                return this.index < this.robots.length;
                            },
                            rewind:function(){
                                this.index = 0;
                            },
                            current:function(){
                                return this.robots[this.index];
                            }
                        };

                        // test
                        var temp, robots = r1.CreatedRobots;
                        while( temp = robots.next() ){
                            console.log( temp.hi() );
                        }
                        robots.rewind();
                        console.log( robots.current().hi() );
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">装饰者模式</dt>
                <dd>
                    <pre class="brush:js">
                        RobotMaker.addWeapon = function(robot, weaponList){
                            var weapon = this.Weapon,
                                i = 0, j = weaponList.length;

                            for(; i < j; i++){
                                if( weaponList[i] in weapon ){
                                    weapon[weaponList[i]](robot);
                                }
                            }
                        };
                        RobotMaker.Weapon = {
                            missile:function(robot){
                                robot.power += 100;
                                robot.weapons.push({'name':'missile', 'power':100});
                            },
                            bomb:function(robot){
                                robot.power += 50;
                                robot.weapons.push({'name':'bomb', 'power':50});
                            },
                            gun:function(robot){
                                robot.power += 20;
                                robot.weapons.push({'name':'gun', 'power':20});
                            }
                        };

                        // test
                        while( temp = robots.next() ){
                            console.log( temp.power );
                        }
                    </pre>
                </dd>
                <dt class="icon icon-arrow-r">策略模式</dt>
                <dd>
					<pre class="brush:js">
						// 待补充
					</pre>
                </dd>
                <dt class="icon icon-arrow-r">外观模式</dt>
                <dd>
					<pre class="brush:js">
						// 待补充
					</pre>
				</dd>
                <dt class="icon icon-arrow-r">代理模式</dt>
                <dd>
					<pre class="brush:js">
						// 待补充
					</pre>
				</dd>
                <dt class="icon icon-arrow-r">中介者模式</dt>
                <dd>
					<pre class="brush:js">
						// 待补充
					</pre>
                </dd>
                <dt class="icon icon-arrow-r">观察者模式</dt>
                <dd>
					<pre class="brush:js">
						// 待补充
					</pre>
				</dd>
            </dl>
        </section>
        <section class="document_section section">
            <h3 class="section_title">设计建议
                <span class="icon-CSS icon-minus"></span>
            </h3>
            <dl>
                <dt class="icon icon-arrow-r">阴影</dt>
                <dd>
                    <p>注意阴影颜色的深浅</p>

                    <p>阴影的亮度表示物体与阴影投射表面的距离</p>

                    <p>深色的阴影代表物体与背景较近</p>

                    <p>浅色的阴影表示物体与背景较远，即更靠近观察者</p>

                    <p>阴影的长宽也会给用户造成不同的距离感</p>

                    <p>细小的阴影让人觉得物体与背景较近</p>

                    <p>宽大的阴影则让物体看起来离背景稍远</p>

                    <p>要确保光源的真实性</p>

                    <p>若页面中包含多个对象，则阴影方向要保持统一，以体现光源的一致性</p>
                </dd>
                <dt class="icon icon-arrow-r">形状</dt>
                <dd>
                    <p>圆弧形经常与女性、阴柔关联起来，表示温暖、舒适、暧昧以及爱情等</p>

                    <p>圆弧形也能用来代表社区、全体、忍耐、运动以及安全等含义</p>

                    <p>三角形则通常会让人联想到男性、阳刚，用来表达强壮、攻击以及运动感等含义</p>

                    <p>棱角的方向也会影响形状的含义——浏览者的目光通常会被吸引至处于支配地位的棱角所指的方向</p>

                    <p>指向上方体现了向上的趋势以及攻击性</p>

                    <p>指向下方则通常暗示出消极的意味，表示被动和无力</p>

                    <p>方形暗示了力量和根基，很可能因为看上去足够坚实稳重</p>

                    <p>方形的设计能给浏览者带来有序、逻辑、严密以及安全的感觉</p>
                </dd>
                <dt class="icon icon-arrow-r">间隔空间</dt>
                <dd>
                    <p>适当的空间可以将浏览者的目光引导至页面中的关键位置</p>

                    <p>空间还能够对文本和图像的过密产生一定的缓冲，让眼睛有休息的余地，将大大提高内容的可读性，并给浏览者足够的思考内容的时间</p>

                    <p>合适的行间距可以提高阅读速度</p>
                </dd>
                <dt class="icon icon-arrow-r">正空间与负空间</dt>
                <dd>
                    <p>正空间是指组成作品的对象所占据的空间</p>

                    <p>负空间则是指非作品对象部分（即背景）占据的空间</p>

                    <p>二者相互依赖、相辅相成</p>

                    <p>负空间起到定义正空间边界的作用</p>

                    <p>作品中对象的边界也正是负空间的开始，这个边界本身就是一种形状</p>
                </dd>
                <dt class="icon icon-arrow-r">色彩</dt>
                <dd>
                    <p>色彩表达的含义与图像或文本一样令人信服，某些时候甚至还要强于他们</p>

                    <p>浅绿色能唤起某种较愉悦的感觉，但深绿色却恰恰相反</p>

                    <p>若要显示高雅使用褐色和银色的组合</p>

                    <p>若想要吸引男性浏览者的关注，通常来说使用蓝色</p>

                    <p>若想要吸引女性浏览者的兴趣，使用红色和粉色会更好</p>

                    <p>想要设计大自然主题相关的网站，那么绿色、蓝色、棕色将是最好的选择</p>

                    <p>文化背景和性别差异都会让人对相同的颜色产生不同的联系，常见的颜色与其心理联想</p>

                    <p>红色：力量、活力、爱、激情、进攻、危险，在亚洲一些地区，红色是好运的象征。红色与白色同时使用将加强这种意味。相对于蓝色，很多女性更偏好红色</p>

                    <p>蓝色：信任、保守、安全、清洁、悲伤、有序，总的说来，蓝色在时间范围内都是一种被尊敬的、表示崇高的颜色</p>

                    <p>绿色：大自然、健康、嫉妒、复苏，在美国，绿色让人联想到金钱，但在其他文化背景中却不尽相同。与男性相比，女性可以分辨出更多色调的绿色</p>

                    <p>橙色：愉快、幸福，在美国一种包装设计上的惯例，即用橙色的物品较便宜。所以在用橙色设计商业网站之前，需考虑这个问题。与黄色相比，男性更喜欢橙色</p>

                    <p>黄色：乐观、希望、冷静、懦弱，在亚洲人眼里，黄色是神圣的。与橙色相比，女性更喜欢黄色，因为它让人联想到温暖和乐观</p>

                    <p>紫色：神秘，紫色会让欧洲人联想到悲哀，所以紫色的使用一直备受争议。自然界中紫色相对较少，仅在某些花以及一些咸水鱼上</p>

                    <p>褐色/棕色：可靠、舒适、忍耐、大地，对任何文化背景和性别的人来说，棕色都是一种中立颜色</p>

                    <p>灰色/银色：智慧、未来、谦虚、悲哀、腐朽、高雅</p>

                    <p>黑色：力量、性、完善、神秘、恐惧、忧愁、死亡，在大多数西方国家以及很多其他国家中，黑色都表示悲恸和死亡</p>

                    <p>白色：纯洁、干净、精确、清白、中性、不毛、死亡，在大多数亚洲国家中，白色表示悲恸和死亡。但在西方社会中却表示贞操、纯洁</p>
                </dd>
                <dt class="icon icon-arrow-r">图案</dt>
                <dd>
                    <p>图案是指重复填充到指定区域内的某一种（也可能多于一种）小块视觉元素</p>

                    <p>图案是体现材质感所必不可少的，能够模拟出材质的效果</p>

                    <p>网点类型的图案让人联想到凸凹不平的表面</p>

                    <p>弯曲花纹类型的图案则给人以怀旧风格的地毯或华丽的布料的感觉</p>

<!--                    <p>并非所有的图片都是可以平铺的，除非</p>-->
                </dd>
                <dt class="icon icon-arrow-r">对比度</dt>
                <dd>
                    <p>对比度差别可以用来区分不同的元素</p>

                    <p>若对比度过低，则元素将失去彼此的界限并混合在一起，文字也变得难以辨认，有时会给人带来压抑的感觉</p>

                    <p>若对比度过高，则将给浏览者带来压迫感，觉得不舒适；将让作品显得过于拥挤，有过度设计之嫌</p>

                    <p>若将两种互补色，例如橙色和蓝色或红色和绿色相邻，将显示出明显的边界以及强烈的对比效果，进而引发令人不愉快的视觉上的紧张感</p>

                    <p>需要表现浓烈色彩的情况中可以充分利用同时色对比所带来的效果。如黄色背景下的橙黄色将显得更接近橙色，但若是在橙色或红色背景下，则看起来会更接近黄色</p>

                    <p>在更加暗淡的颜色背景衬托下，偏暗的颜色也会明亮起来，如将某种比较暗淡的红色置于灰色背景中，则改红色看起来会鲜艳许多</p>

                    <p>降低对比度会让线条看上去变得更细一些，同样也可以实现一种柔和的效果，如某段不重要的文本，可以应用一些较浅的颜色</p>

                    <p>对某些非活动的图标或链接，同样可以通过降低对比度来实现“变灰（grayed
						out）”效果，让用户了解该选项当前不可用</p>

                    <p>色彩的对比度同样会影响到内容的可读性，不同的色调对应的可读性也不尽相同，无论何种情况，黑色的文字总能带来更好的可读性</p>

                    <p>对于颜色感知障碍的人，对比度通常不能达成效果，所以对于任何依赖于颜色传递的信息，我们都应该提供如下方式中的至少一种来告知用户：</p>

                    <p>蓝色且带有下划线的超链接、包含图标或文本的绿色按钮、带有实现边框的红色警告信息</p>
                </dd>
                <dt class="icon icon-arrow-r">用户界面设计基本法则</dt>
                <dd>
                    <ul>
                        <li>了解将浏览页面的用户</li>
                        <li>在页面和站点中给用户足够的向导</li>
                        <li>使用被人们熟知的象征符号，如：购物车</li>
                        <li>保证与功能相关的特性在页面中足够显眼，如：链接表达其功能的含义</li>
                        <li>保证设计元素的一致性，如：各页面间的导航链接应保持一致，LOGO 图片和标题的位置也要始终如一</li>
                        <li>了解页面中的关键元素</li>
                        <li>清楚地表达页面的内容，人类的注意力持续时间较短，通常来讲最多 9
							秒钟——若是在这个时间段之后还是不能了解页面的主要内容，那么用户就会彻底放弃</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">与布局相关的可用性</dt>
                <dd>
                    <ul>
                        <li>重要信息应放在显眼的位置，当然 Web
							设计中“显眼”只是个相对概念，但通常，将用户最需要的信息尽可能地放在页面的最上部</li>
                        <li>尽可能地保证页面中的导航链接有着一致的表现，同样也要确保页面中包含回到首页的链接，最好还要提供版权页面、隐私策略以及联系信息等内容（若此类信息对站点非常重要）</li>
                        <li>对于中型或大型站点来说，强烈建议提供搜索功能，用户通常非常乐于使用搜索功能，位置要让用户用直觉就能够发现，一般放在与其逻辑相关的位置上，如：导航条附近</li>
                        <li>用缩进和偏移将栏中内容分开，这一点在实现页面整体效果以及提高用户接受度中至关重要</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">表现真实感</dt>
                <dd>
                    <p>结合使用以下几种方法将会得到期望的物体的体积感，即为三维物体的二维表现样式</p>

                    <ul>
                        <li>要特别注意图形边缘的效果</li>
                        <li>注意形状</li>
                        <li>图像的材质能够为物体带来真实感</li>
                        <li>深度的确可以表现出额外维度的感觉，即使是在二维环境中也是如此</li>
                        <li>重力的模拟同样重要</li>
                    </ul>

                    <p>参考建议：封闭区域是由颜色和材质组成的，物体的体积是由长宽高组成的</p>
                </dd>
                <dt class="icon icon-arrow-r">层次</dt>
                <dd>
                    <ul>
                        <li>层次之间的线条、空间和大小要有区别</li>
                        <li>层与层之间仍是一个整体，并以某种方式保持联系</li>
                        <li>层与层之间的过渡要自然</li>
                        <li>作品中总是要包含焦点或重点</li>
                        <li>作品中绝对不能缺少重力感，人们都希望物体能够置于某个平面上</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">常用 Web 字体</dt>
                <dd>
                    <p>每个平台自带的字体</p>

                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Windows</th>
                            <th>Mac OS X</th>
                            <th>Unix/Linux</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Serif</td>
                            <td>Book Antiqua, Bookman Old Style, Garamond</td>
                            <td>New York, Palatino, Times</td>
                            <td>Bitstream Vera Serif, New Century Schoolbook, Times,Utopia</td>
                        </tr>
                        <tr>
                            <td>Sans Serif</td>
                            <td>Arial Narrow, Century Gothic, Lucida Sans Unicode, Tahoma</td>
                            <td>Charcoal, Chicago, Geneva, Helvetica, Lucida Grande</td>
                            <td>Bitstream VerSans, Helvetica, Lucida</td>
                        </tr>
                        <tr>
                            <td>Monospace</td>
                            <td>Courier, Lucida Console</td>
                            <td>Courier, Monaco</td>
                            <td>Bitstream Vera Mono, Courier</td>
                        </tr>
                        </tbody>
                    </table>

                    <p>微软核心 Web 字体</p>

                    <table>
                        <thead>
                        <tr>
                            <td>Serif</td>
                            <td>Sans Serif</td>
                            <td>Monospace</td>
                            <td>Special</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Georgia, Times New Roman</td>
                            <td>Arial, Arial Black, Trebuchet MS,Verdana</td>
                            <td>Courier New, Andale Mono</td>
                            <td>Comis Sans MS, Impact, Webdings</td>
                        </tr>
                        </tbody>
                    </table>

                    <p>关于字体选择请参考 CSS 规范通用字体族部分</p>
                </dd>
                <dt class="icon icon-arrow-r">字体格式</dt>
                <dd>参考 CSS 规范中字体格式部分</dd>
                <dt class="icon icon-arrow-r">字体对比度（type contrast）</dt>
                <dd>
                    <p>字体对比度指字型中粗的部分与细的部分之间的差异，不同字体的对比度相差很大，甚至有些字体没有任何粗细变化</p>

                    <p>通常做法中，圆滑、缺乏粗细对比的 sans serif 字体被用作标题用字，而 serif
						字体则常用作正文字体，这种设定在长段文章中的应用尤其广泛。不过在当今的 Web 时代，很多人的想法恰恰相反。</p>
                </dd>
                <dt class="icon icon-arrow-r">字体色深（type color）</dt>
                <dd>字体色深指的是文字的深浅程度。例如 Helvetica Light
					这样的字体相对较浅，是由于字体较细因而含墨量较小。其它因素如字间距调整（kerning）、字间距（tracking）和行间距（leading）等也会影响人们感受到的字体的色深</dd>
                <dt class="icon icon-arrow-r">文字之间的对比度</dt>
                <dd>
                    <p>文字色相和对比度的选择，传统的文字设计理论认为提高前景和背景的色相对比——例如使用白底黑字的设计——会大大提高文本的可读性，但有时使用低对比度会让页面显得更加柔和清晰，进而让读者更好的阅读其中的内容。毋庸置疑，低对比度的字体会造成视觉不便认识阅读困难。因而在制作受众面较宽的网站时，使用传统的高对比度设计依然是最好的选择。</p>

                    <p>字号对比和字体颜色，使用不同大小的字体可以增加文字区块间的对比</p>

                    <p>字号对比和粗细，利用字体大小、粗细差异形成反差</p>

                    <p>标题和正文的关系</p>
                </dd>
                <dt class="icon icon-arrow-r">文字排版</dt>
                <dd>
                    <p>排版的主流理论认为人类视觉会自然地偏向于页面的左上角，也就是所谓的视觉中心区。之后视线可以顺畅地向右移动，或是转向新的一行，这样逐渐趋近于页面底端。在这个过程中，视线会将页面的底端作为最终的停靠点。在日常的设计中，设计师们都会遵循上述视觉原理。</p>

                    <p>视线会被作品的布局导引。因此，将重要的站点标志放置于视觉中心区，而把文字等其它元素置于页面下部形成停靠的的设计规则是非常合理的。而视线从右方转向左侧时形成的折点通常也是较易被浏览者关注的地方。</p>

                    <p>另一个涉及可用性的问题是页面中能够容纳多少文章。虽然大多数用户不喜欢点击“下一页”按钮，但若是文字实在过多，还是要考虑适当地对内容分页</p>
                </dd>
                <dt class="icon icon-arrow-r">标题</dt>
                <dd>
					<p>标题文字用来指明段落的主要内容，标题的样式用于向浏览者传达作品的含义，同时也能起到强化作品整体效果的作用</p>

                    <ul>
                        <li>标题中使用的颜色必须是整个设计中较为强势的色彩</li>
                        <li>标题的色彩必须鲜明。在标题中亮色所带来的影响不如暗色，因而越是接近黑色的标题，越是能对浏览者产生强的冲击力</li>
                        <li>越是重要的标题，越是需要带有强烈冲击力的色彩</li>
                        <li>略为紧缩的字体更能凸显标题，所以建议使用正常字体 70%~90% 宽的标题文字</li>
                        <li>字体对比可以帮助增强标题效果</li>
                        <li>标题长度应该有所限制。过长的标题在视觉和理解上都容易让读者迷惑</li>
                        <li>通常情况下，应该避免在标题中使用句号，因为句号用来结束一段文字，而标题则是用来引出下面的内容文字</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">正文字体</dt>
                <dd>
                    <p>正文是页面文字的主体部分，浏览者会仔细阅读，或者至少扫过正文中的文字。而不恰当的排版布局将可能错误地传达文字要表示的信息</p>

                    <ul>
                        <li>保持一行在 60 个字符以内。虽然在流式布局的网站设计中（尤其是 CSS 中问题百出的
							<span class="code">min-width</span> 和 <span class="code">max-width</span>
							属性）很难控制每行字数，但过长的一行文字不但会让读者难以理解，甚至会使其根本不愿阅读下去</li>
                        <li>避免每行字数过少，若将段落分布于 20
							字的短行中，将导致行数激增，而过长的段落往往是人们无法忍受的，因而最好只在需要强调的文字中使用短行</li>
                        <li>英语书写的传统认为一个段落至少应由 3 到 4 句话组成。然而在 Web
							中，过长的段落却不被看好。较短的段落在快捷的网络时代更适合迅速传达重要的讯息</li>
                        <li>如果确实需要发布长篇文字，就得尽力让段落保持小巧，并且将长段分割为节并加以标题。这才能更好地引导读者，以便正确地理解文字</li>
                        <li>若段落之间的距离过大，读者在阅读时会有被打断的感觉，造成不必要的误解</li>
                        <li>避免在正文中使用鲜艳的色彩。鲜艳的色彩在正文中往往会造成负面影响而不是正面的帮助。应该只在重点文字和链接上使用鲜艳色彩</li>
                    </ul>
                </dd>
                <dt class="icon icon-arrow-r">重要文字</dt>
                <dd>
                    <p>重要文字指的是侧栏、引用和说明部分的文字。</p>

                    <ul>
                        <li>由于重要文字的目的是引起读者的注意，因此为重要文字应用鲜艳的色彩自然没什么问题，但必须保证所有重要文字的色彩保持统一</li>
                        <li>重要文字应当使用短行，且只能有很少的行数</li>
                        <li>重点文字不应阻断正文，而应增强正文的效果。如果重点文字扰乱了读者的视觉流向，那也会影响到读者对页面内容的理解。页面插图也应同样遵循这条规律</li>
                        <li>读者都希望插图附有相应的说明。说明文字能为插图提供上下文，起到帮助读者阅读的作用</li>
                    </ul>
                </dd>
            </dl>
        </section>
    </div>
</section>

<textarea class="newCodingStandards hidden" >
    28.     定义对象（待定，代码写的很漂亮，暂时没想到如何应用。。。）
    <script>
        var Gadget = (function(){
            var counter = 0;

            var NewGadget = function(){
                counter++;
            };
            NewGadget.prototype.getListId = function(){
                return counter;
            };
            return NewGadget;
        })();
    </script>

    30.     检测常量是否存在（待定，代码写的很漂亮，暂时没想到如何应用。。。）
    <script>
        var Global = (function(){
            var constants = {},
                    ownProp = Object.prototype.hasOwnProperty,
                    allowed = {
                        string:1,
                        number:1,
                        boolean:1
                    },
                    prefix = (Math.random()+'_').slice(2);

            return {
                set:function(name, value){
                    var success = true;
                    if( this.isDefined(name) ){
                        success = false;
                    }
                    else if( !ownProp.call(allowed, typeof value) ){
                        success = false;
                    }
                    else{
                        constants[prefix + name] = value;
                    }
                    return success;
                },
                isDefined:function(name){
                    return ownProp.call(constants, prefix + name);
                },
                get:function(name){
                    var result = null;
                    if( this.isDefined(name) ){
                        result = constants[prefix + name];
                    }
                    return result;
                }
            };
        })();
    </script>

33.     Ajax返回数据结构固定，数据结构一律使用JSON格式
<script>
    var responseData = {
        //主题，字符串
        topic:'',
        //总信息条数，数值
        count:0,
        //数据，JSON数组
        data:[{},{}],
        //反馈，数值
        feedback:1,
        //错误编码，字符串
        error:'doc_0001',
        //错误信息，字符串
        errorMsg:''
    };
</script>
</textarea>
<?php require_once('../footer.php');?>

<script data-main="../script/document/index" src="../script/lib/require/require.js"></script>
</body>
</html>