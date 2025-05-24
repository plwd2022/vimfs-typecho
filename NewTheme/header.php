<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="<?php $this->options->lang(); ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php
    $this->archiveTitle(array('category' => _t('分类：%s'), 'search' => _t('关键字：%s'), 'tag'     => _t('标签：%s'), 'author' => _t('作者：%s')), '', ' - ');
    $this->options->title();
    if($this->is('index')):
      echo ' - ';
      echo $this->options->description();
      echo ' | ';
      echo _t('网站首页');
    endif;
    ?></title>
  <!-- 使用url函数转换相关路径 -->
  <link rel="stylesheet" href="<?php $this->options->themeUrl('normalize.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('grid.css'); ?>">
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
  <meta name="description" content="<?php echo $this->_description; if($this->is('index')): _e(','); $this->options->title(); echo _t('网站首页'); else: _e(','); echo $this->options->description(); endif; ?>">
  <meta name="keywords" content="<?php echo $this->_keywords; if($this->is('index')): _e(','); $this->options->title(); echo _t('网站首页'); else: _e(','); echo $this->options->description(); endif; ?>">

    <?php // Open Graph and Twitter Card Meta Tags ?>
    <?php if ($this->is('single')): // For single posts or pages ?>
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php $this->title(); ?>" />
        <meta property="og:url" content="<?php $this->permalink(); ?>" />
        <meta property="og:description" content="<?php $this->excerpt(150, '...'); ?>" />
        <?php if ($this->fields->post_thumbnail): ?>
            <meta property="og:image" content="<?php $this->fields->post_thumbnail(); ?>" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:image" content="<?php $this->fields->post_thumbnail(); ?>" />
        <?php elseif ($this->options->defaultOgpImage): ?>
            <meta property="og:image" content="<?php $this->options->defaultOgpImage(); ?>" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:image" content="<?php $this->options->defaultOgpImage(); ?>" />
        <?php else: ?>
            <meta name="twitter:card" content="summary" />
        <?php endif; ?>
    <?php else: // For homepage, archives, etc. ?>
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php $this->options->title(); ?><?php if($this->is('archive')) $this->archiveTitle(array('category'=>'%s','search'=>'%s','tag'=>'%s','author'=>'%s'), '', ' - '); ?>" />
        <meta property="og:url" content="<?php $this->options->siteUrl(); ?><?php if($this->is('archive')) echo $this->request->getRequestUri(); // More robust archive URL ?>" />
        <meta property="og:description" content="<?php $this->options->description(); ?>" />
        <?php if ($this->options->defaultOgpImage): ?>
            <meta property="og:image" content="<?php $this->options->defaultOgpImage(); ?>" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:image" content="<?php $this->options->defaultOgpImage(); ?>" />
        <?php else: ?>
            <meta name="twitter:card" content="summary" />
        <?php endif; ?>
    <?php endif; ?>
    <meta property="og:site_name" content="<?php $this->options->title(); ?>" />
    <?php // Common Twitter tags (can use og:title and og:description by default if not specified) ?>
    <meta name="twitter:title" content="<?php if($this->is('single')) $this->title(); else $this->options->title(); ?><?php if($this->is('archive') && !$this->is('single')) $this->archiveTitle(array('category'=>'%s','search'=>'%s','tag'=>'%s','author'=>'%s'), '', ' - '); ?>" />
    <meta name="twitter:description" content="<?php if($this->is('single')) $this->excerpt(150, '...'); else $this->options->description(); ?>" />
    <?php // Optional: Add <meta name="twitter:site" content="@YourTwitterHandle" /> if you have one ?>

</head>
<body <?php $this->bodyClass(); ?>>
<!--[if lt IE 8]>
  <div class="eeyinfo"><?php echo _t('当前浏览器过旧，为了更好的体验，请升级到更新的浏览器。'); ?></div>
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

        <div class="user-status-links"> <?php // New wrapper for these links ?>
            <?php if($this->user->hasLogin()): ?>
                <span class="user-admin-link"><a role="button" accesskey="4" href="<?php $this->options->adminUrl(); ?>"><?php echo sprintf(_t('进入 %s 的后台'), $this->user->screenName()); ?></a></span>
                <span class="user-logout-link"><a role="button" accesskey="4" href="<?php $this->options->logoutUrl(); ?>"><?php echo _t('退出'); ?></a></span>
            <?php else: ?>
                <span class="user-login-link"><a role="button" accesskey="4" href="<?php $this->options->adminUrl('login.php'); ?>"><?php echo _t('登录'); ?></a></span>
                <span class="user-register-link"><a role="button" accesskey="4" href="<?php $this->options->adminUrl('register.php'); ?>"><?php echo _t('注册'); ?></a></span>
            <?php endif; ?>
        </div>

    <div class="header-search"> <?php // New wrapper for search in header ?>
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <label for="s-header" class="sr-only"><?php echo _t('搜索关键字'); ?></label>
            <input type="text" name="s" id="s-header" class="text" accesskey="1" placeholder="<?php echo _t('搜索全站...'); ?>" /> <?php // Changed accesskey to 1 ?>
            <button type="submit" class="submit"><?php echo _t('搜索'); ?></button>
        </form>
    </div>
    
    <div class="header-date-display">
         <?php echo date(_t('Y年m月d日')); ?> <?php $weekarray=array(_t("日"),_t("一"),_t("二"),_t("三"),_t("四"),_t("五"),_t("六")); echo _t("星期").$weekarray[date("w")]; ?>
    </div>
</div> <?php // End of #header .container ?>

  <div id="nav" class="container">
        <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-expanded="false" aria-controls="main-navigation" aria-label="<?php echo _t('主导航菜单'); ?>"> <?php // Hardcode Chinese for aria-label ?>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div id="main-navigation" class="main-navigation"> <?php // Wrapper for nav links ?>
            <a <?php if($this->is('index')): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php echo _t('首页'); ?></a> <?php // Hardcode Chinese ?>
            <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
            <?php while($categories->next()): ?>
            <a <?php if($this->is('category',$categories->slug)): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
            <?php endwhile; ?>
            <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
            <?php while($pages->next()): ?>
            <a <?php if($this->is('page',$pages->slug)): ?>class="current" aria-current="page"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
            <?php endwhile; ?>
        </div>
    </div>

<div id="hotkey-help-modal" class="hotkey-modal" style="display:none;" role="dialog" aria-labelledby="hotkey-modal-title" aria-hidden="true">
    <div class="hotkey-modal-content">
        <span id="hotkey-modal-status" class="visually-hidden-focusable" aria-live="assertive" aria-atomic="true"></span>
        <h3 id="hotkey-modal-title"><?php echo _t('键盘快捷键'); ?></h3>
        <p><?php echo _t('导航操作：'); ?></p>
        <ul>
            <li><?php echo _t('Alt+1：聚焦到搜索框'); ?></li>
            <li><?php echo _t('Alt+2：循环切换分类/板块'); ?></li>
            <li><?php echo _t('Alt+3：循环切换文章/内容/链接'); ?></li>
            <li><?php echo _t('Alt+4：用户操作 (登录/注册/后台/退出)'); ?></li> <?php // Ensure this line is present and correct ?>
        </ul>
        <p><?php echo _t('播放器控制：'); ?></p>
        <ul>
            <li><?php echo _t('Shift+空格：播放/暂停'); ?></li>
            <li><?php echo _t('Shift+左/右方向键：快退/快进'); ?></li>
            <li><?php echo _t('Shift+上/下方向键：音量增/减'); ?></li>
            <li><?php echo _t('Esc：停止/恢复 (适用情况下)'); ?></li>
        </ul>
        <button id="close-hotkey-modal" aria-label="<?php echo _t('关闭键盘快捷键帮助'); ?>"><?php echo _t('关闭'); ?></button>
    </div>
</div>

  <div class="site-content container"> <!-- Added site-content wrapper and container class -->
    <div id="main"> <!-- Removed inline style -->
      

    
	</div>
                  <span><a id="hotkey-help-trigger" class="visually-hidden-focusable" href="#" role="button"><?php echo _t('热键帮助'); ?></a></span>
  
  <?php // The login/logout links and the old #rightbar containing search/date are removed from this general area. 
        // Login/logout links might be better placed in a user menu or footer.
        // Search and date are now in the main #header.
  ?>
  
<!-- Removed a <div> that seemed to be an extra closing tag before site-content wrapper was added -->
<!-- The site-content div should wrap main and rightbar, and then footer comes after site-content -->