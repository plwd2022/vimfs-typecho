<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="rightbar" role="complementary">
    <div class="sidebar-inner">

        <?php // 1. Search Widget - Assuming this widget does not need a syntax update for now or will be handled separately ?>
        <aside class="widget widget_search">
            <h2 class="widget-title" accesskey="2"><?php echo _t('站内搜索'); ?></h2>
            <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <label for="s" class="sr-only"><?php echo _t('搜索关键字'); ?></label>
                <input type="text" name="s" id="s" class="text" placeholder="<?php echo _t('输入关键字搜索...'); ?>" />
                <button type="submit" class="submit"><?php echo _t('搜索'); ?></button>
            </form>
        </aside>

        <?php // 2. Recent Posts ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_posts">
            <h2 class="widget-title" accesskey="2"><?php echo _t('最新文章'); ?></h2>
            <ul class="widget-list">
                <?php \Widget\Contents\Post\Recent::alloc()->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 3. Recent Comments ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_comments">
            <h2 class="widget-title" accesskey="2"><?php echo _t('最近回复'); ?></h2>
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
            <h2 class="widget-title" accesskey="2"><?php echo _t('文章分类'); ?></h2>
            <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list&showCount=1&countFormat=(%d)'); ?>
        </aside>
        <?php endif; ?>

        <?php // 5. Archives ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_archive">
            <h2 class="widget-title" accesskey="2"><?php echo _t('文章归档'); ?></h2>
            <ul class="widget-list">
                <?php \Widget\Contents\Post\Date::alloc('type=month&format=F Y')->parse('<li><a href="{permalink}">{date}</a> ({count})</li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>
        
        <?php // 6. Other Section ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_other">
            <h2 class="widget-title" accesskey="2"><?php echo _t('其它'); ?></h2>
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
