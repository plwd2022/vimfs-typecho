<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="rightbar" role="complementary">
    <div class="sidebar-inner">

        <?php // 1. Search Widget - Assuming this widget does not need a syntax update for now or will be handled separately ?>
        <aside class="widget widget_search">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> <?php echo _t('站内搜索'); ?></h2>
            <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <label for="s" class="sr-only"><?php echo _t('搜索关键字'); ?></label>
                <input type="text" name="s" id="s" class="text" placeholder="<?php echo _t('输入关键字搜索...'); ?>" />
                <button type="submit" class="submit"><?php echo _t('搜索'); ?></button>
            </form>
        </aside>

        <?php // 2. Recent Posts ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_posts">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-recent-posts"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?php echo _t('最新文章'); ?></h2>
            <ul class="widget-list">
                <?php \Widget\Contents\Post\Recent::alloc()->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 3. Recent Comments ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_comments">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-recent-comments"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> <?php echo _t('最近回复'); ?></h2>
            <ul class="widget-list">
                <?php \Widget\Comments\Recent::alloc()->to($comments); ?>
                <?php while($comments->next()): ?>
                    <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?>:</a> <?php $comments->excerpt(35, '...'); ?></li>
                <?php endwhile; ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 4. Categories ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_categories">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-category"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg> <?php echo _t('文章分类'); ?></h2>
            <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list&showCount=1&countFormat=(%d)'); ?>
        </aside>
        <?php endif; ?>

        <?php // 5. Archives ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_archive">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> <?php echo _t('文章归档'); ?></h2>
            <ul class="widget-list">
                <?php \Widget\Contents\Post\Date::alloc('type=month&format=F Y')->parse('<li><a href="{permalink}">{date}</a> ({count})</li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>
        
        <?php // 6. Other Section ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_other">
            <h2 class="widget-title" accesskey="2"><svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-other"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg> <?php echo _t('其它'); ?></h2>
            <ul class="widget-list">
                <?php if($this->user->hasLogin()): ?>
                    <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php echo _t('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                    <li><a href="<?php $this->options->logoutUrl(); ?>"><?php echo _t('退出'); ?></a></li>
                <?php else: ?>
                    <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php echo _t('登录'); ?></a></li>
                <?php endif; ?>
                <li><a href="<?php $this->options->feedUrl(); ?>"><?php echo _t('文章 RSS'); ?></a></li>
                <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php echo _t('评论 RSS'); ?></a></li>
                <li><a href="http://www.staraudio.net/" target="_blank"><?php echo _t('星之音'); ?></a></li>
                <li><a href="https://typecho.org">Typecho</a></li>
            </ul>
        </aside>
        <?php endif; ?>

    </div><?php // .sidebar-inner ?>
</div><?php // #rightbar ?>
