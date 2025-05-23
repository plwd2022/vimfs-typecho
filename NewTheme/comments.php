  <?php $this->comments()->to($comments); ?>
  <?php if ($comments->have()): ?>
  <h2 class="widget-title" accesskey="z" tabindex="0"><?php $this->commentsNum('暂无评论', '仅有 1 条评论', '已有 %d 条评论'); ?></h2>
  <?php $comments->listComments(); ?>
  <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
  <?php endif; ?>
  <?php if($this->allow('comment')): ?>
  <div id="<?php $this->respondId(); ?>" class="respond">
    <div class="cancel-comment-reply"><?php $comments->cancelReply(); ?></div>
    <h2 class="widget-title" id="response" accesskey="z" tabindex="0">添加新评论</h2>
    <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
      <?php if($this->user->hasLogin()): ?>
      <p>当前登录用户：<a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <a href="<?php $this->options->logoutUrl(); ?>" title="退出登录">退出</a></p>
      <?php else: ?>
      <p>
        <label for="author" class="required">昵称</label>
        <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
      </p>
      <p>
        <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>>邮箱</label>
        <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
      </p>
      <p>
        <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>>网站</label>
        <input type="url" name="url" id="url" class="text" placeholder="http://" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
      </p>
      <?php endif; ?>
      <p>
        <label for="textarea" class="required">内容</label>
        <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
      </p>
      <p>
        <span role="notify" tabindex="0">评论后，评论信息处于待审核状态，稍后我们会做出回复。</span>
      </p>
      <p>
        <button type="submit" class="submit">提交评论</button>
      </p>
    </form>
  </div>
  <?php else: ?>
  <?php endif; ?>