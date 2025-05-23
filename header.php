<!DOCTYPE HTML>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7">  <![endif]-->
<!--[if IE 7]>  <html class="no-js lt-ie9 lt-ie8">  <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9">  <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js">  <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php
    $this->archiveTitle(array('category' => _t('分类：%s'), 'search' => _t('关键字：%s'), 'tag'     =>  _t('标签：%s'), 'author' => _t('作者：%s')), '', ' - ');
    $this->options->title();
    if($this->is('index')):
      _e(' - ');
      echo $this->options->description();
      _e(' | ');
      _e('网站首页');
    endif;
    ?></title>
  <!-- 使用url函数转换相关路径 -->
  <link rel="stylesheet" href="<?php $this->options->adminUrl('css/normalize.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->adminUrl('css/grid.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
  <!--[if lt IE 9]>
  <script src="<?php $this->options->adminUrl('js/html5shiv.js'); ?>"></script>
  <script src="<?php $this->options->adminUrl('js/respond.js'); ?>"></script>
  <![endif]-->
  <script src="<?php $this->options->themeUrl('res/jquery.js'); ?>"></script>
  <script type="text/javascript">
  function startdoing()
  {
    <?php if($this->is('index')): ?>$("#autosc").focus();<?php else: ?>$("#autord").focus();<?php endif; ?>
	
	$("dl").replaceWith(function(){
	return '<div class="dl-dl" accesskey="x" role="text" tabindex="0">' + $(this).html() + '</div>';
	});
			
	$("dt").replaceWith(function(){
		return '<div class="dl-dt"><h3><strong>' + $(this).html() + '<strong></h3></div>';
	});
			
	$("dd").replaceWith(function(){
		return '<div class="dl-dd">' + $(this).html() + '</div>';
	});
	
    $(".comment-content").replaceWith(function(){
      return '<div class="comment-content" tabindex="0">' + $(this).html() + '</div>';
    });
  }
  </script>
  <link rel="pingback" href="<?php $this->options->xmlRpcUrl(); ?>" />
  <link rel="alternate" type="application/rss+xml" title="<?php $this->options->title(); ?> &raquo; Feed" href="<?php $this->options->feedUrl(); ?>" />
  <link rel="alternate" type="application/rss+xml" title="<?php $this->options->title(); ?> &raquo; 评论Feed" href="<?php $this->options->commentsFeedUrl(); ?>" />
  <?php $this->header('description=&keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&rss2=&rss1=&commentReply=&atom='); ?>
  <?php if($this->is('post') || $this->is('page')): ?><link rel="canonical" href="<?php $this->permalink(); ?>" /><?php endif; ?>
  <meta name="description" content="<?php echo $this->_description; if($this->is('index')): _e(','); $this->options->title(); _e('网站首页'); else: _e(','); echo $this->options->description(); endif; ?>">
  <meta name="keywords" content="<?php echo $this->_keywords; if($this->is('index')): _e(','); $this->options->title(); _e('网站首页'); else: _e(','); echo $this->options->description(); endif; ?>">
</head>
<body>
<!--[if lt IE 8]>
  <div class="eeyinfo"><?php _e('当前浏览器过旧，为了更好的体验，请升级到更新的浏览器。'); ?></div>
<![endif]-->

<div>
  <div style="headbar">
    <div id="wspan" style="float:left;">
        <span><a class="navbar-brand" href="/"><img alt="<?php $this->options->title(); ?>" src="usr/themes/VIMFS/img/logo.png"></a></span>
    </div>
    
  </div>
  
  </div>
  <div id="nav">
      <a <?php if($this->is('index')): ?>class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
    <?php $this->widget('Widget_Metas_Category_List')->to($pages); ?>
    <?php while($pages->next()): ?>
      <a <?php if($this->is('category',$pages->slug)): ?>class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->name(); ?></a>
    <?php endwhile; ?>
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
    <?php while($pages->next()): ?>
      <a <?php if($this->is('page',$pages->slug)): ?>class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
    <?php endwhile; ?>
  </div>
  <div style="display:block;clear:both;">
    <div id="main" style="margin:5px 0;">
      

    
	</div>
                  <span><a accesskey="z" href="#" onclick="alert('<?php _e('导航：\nAlt+Z：分类/板块切换；\nAlt+X：文章/正文/下载地址切换；\nalt+s：快速切换至搜索框；\n播放器控制：\nshift+空格：播放/暂停；\nshift+左右光标：快进/快退;\nshift+上下光标：音量增/减；\nEXC：停止/继续播放。'); ?>');">热键帮助</a></span>
  
  <div id="wspan" style="float:right;">
		<?php if($this->user->hasLogin()): ?>
        <span><a role="button" accesskey="z" href="<?php $this->options->adminUrl(); ?>">进入 <?php $this->user->screenName(); ?> 的后台</a></span>
        <span><a accesskey="z" role="button" href="<?php $this->options->logoutUrl(); ?>">退出</a></span>
		<?php else: ?>
        <span><a accesskey="z" role="button" href="<?php $this->options->adminUrl('login.php'); ?>">登录</a></span>
        <span><a accesskey="z" role="button" href="<?php $this->options->adminUrl('register.php'); ?>">注册</a></span>
<?php endif; ?>

    </div>		
    <div id="rightbar" style="padding-top:30px;;">
      <form id="search" method="post" action="./">
        <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
        <input id="autosc" accesskey="s" type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>">
        <button type="submit" class="submit"><?php _e('搜索'); ?></button>
      <div tabindex="0" class="accesskey-z" accesskey="z" class="top-time">今天是：<?php echo date('Y年m月d日'); ?><?php $weekarray=array("日","一","二","三","四","五","六"); echo "星期".$weekarray[date("w")]; ?></div>
	  </form>
    </div>
	<div class="here">
    <?php _e('当前位置：'); ?>
    <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a> ·
    <?php if ($this->is('index')): ?>
    <?php elseif ($this->is('post')): ?>
    <?php $this->category(); ?> ·
	<?php $this->title() ?>
    <?php else: ?>
    <?php $this->archiveTitle(' · ','',''); ?>
    <?php endif; ?>
  </div>
  <div class="description">
    <?php
      if($this->is('category')):
        echo $this->getDescription();
      else:
        echo $this->options->description();
      endif;
    ?>
  </div>

</div>
<div>