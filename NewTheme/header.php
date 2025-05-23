<!DOCTYPE HTML>
<html lang="<?php $this->options->lang(); ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php
    $this->archiveTitle(array('category' => '分类：%s', 'search' => '关键字：%s', 'tag'     => '标签：%s', 'author' => '作者：%s'), '', ' - ');
    $this->options->title();
    if($this->is('index')):
      echo ' - ';
      echo $this->options->description();
      echo ' | ';
      echo '网站首页';
    endif;
    ?></title>
  <!-- 使用url函数转换相关路径 -->
  <!-- <link rel="stylesheet" href="<?php $this->options->adminUrl('css/normalize.css'); ?>"> -->
  <!-- <link rel="stylesheet" href="<?php $this->options->adminUrl('css/grid.css'); ?>"> -->
  <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
  <!--[if lt IE 9]>
  <script src="<?php $this->options->adminUrl('js/html5shiv.js'); ?>"></script>
  <script src="<?php $this->options->adminUrl('js/respond.js'); ?>"></script>
  <![endif]-->
  <!-- <script src="<?php $this->options->themeUrl('res/jquery.js'); ?>"></script> --> <?php // jQuery removed ?>
  <?php // The startdoing() function and its associated script tag will be moved to NewTheme/js/main.js ?>
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
  <div class="eeyinfo">当前浏览器过旧，为了更好的体验，请升级到更新的浏览器。</div>
<![endif]-->

<div id="header" class="container">
    <div class="site-branding"> <?php // Wrap logo/title ?>
        <span>
            <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>">
                <?php if ($this->options->logoUrl): ?>
                    <img src="<?php $this->options->logoUrl(); ?>" alt="<?php $this->options->title(); ?>" />
                <?php else: ?>
                    <img src="<?php $this->options->themeUrl('img/logo.png'); ?>" alt="<?php $this->options->title(); ?>" />
                <?php endif; ?>
            </a>
        </span>
        <?php // Optionally, add site title/description if not using a logo, or alongside ?>
    </div>

    <div class="header-search"> <?php // New wrapper for search in header ?>
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <label for="s-header" class="sr-only">搜索关键字</label>
            <input type="text" name="s" id="s-header" class="text" accesskey="1" placeholder="搜索全站..." /> <?php // Changed accesskey to 1 ?>
            <button type="submit" class="submit">搜索</button>
        </form>
    </div>
    
    <div class="header-date-display">
         <?php echo date('Y年m月d日'); ?> <?php $weekarray=array("日","一","二","三","四","五","六"); echo "星期".$weekarray[date("w")]; ?>
    </div>
</div> <?php // End of #header .container ?>

  <div id="nav" class="container"> <!-- Added container class for nav as well -->
      <a <?php if($this->is('index')): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">首页</a>
    <?php $this->widget('Widget_Metas_Category_List')->to($pages); ?>
    <?php while($pages->next()): ?>
      <a <?php if($this->is('category',$pages->slug)): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->name(); ?></a>
    <?php endwhile; ?>
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
    <?php while($pages->next()): ?>
      <a <?php if($this->is('page',$pages->slug)): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
    <?php endwhile; ?>
  </div>

<div id="hotkey-help-modal" class="hotkey-modal" style="display:none;" role="dialog" aria-labelledby="hotkey-modal-title" aria-hidden="true">
    <div class="hotkey-modal-content">
        <h3 id="hotkey-modal-title">键盘快捷键</h3>
        <p>导航操作：</p>
        <ul>
            <li>Alt+2：循环切换分类/板块</li>
            <li>Alt+3：循环切换文章/内容/链接</li>
            <li>Alt+1：聚焦到搜索框</li>
        </ul>
        <p>播放器控制：</p>
        <ul>
            <li>Shift+空格：播放/暂停</li>
            <li>Shift+左/右方向键：快退/快进</li>
            <li>Shift+上/下方向键：音量增/减</li>
            <li>Esc：停止/恢复 (适用情况下)</li>
        </ul>
        <button id="close-hotkey-modal" aria-label="关闭键盘快捷键帮助">关闭</button>
    </div>
</div>

  <div class="site-content container"> <!-- Added site-content wrapper and container class -->
    <div id="main"> <!-- Removed inline style -->
      

    
	</div>
                  <span><a id="hotkey-help-trigger" class="visually-hidden-focusable" href="#" role="button">热键帮助</a></span>
  
  <?php // The login/logout links and the old #rightbar containing search/date are removed from this general area. 
        // Login/logout links might be better placed in a user menu or footer.
        // Search and date are now in the main #header.
  ?>
  
	<div class="here">
    当前位置：
    <a href="<?php $this->options->siteUrl(); ?>">首页</a> ·
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

<!-- Removed a <div> that seemed to be an extra closing tag before site-content wrapper was added -->
<!-- The site-content div should wrap main and rightbar, and then footer comes after site-content -->