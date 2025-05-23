<?php
function themeConfig($form) {
  $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, '站点LOGO地址', '在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO');
  $form->addInput($logoUrl);
  $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
  array('ShowRecentPosts' => '最新文章',
  'ShowRecentComments' => '最近回复',
  'ShowCategory' => '文章分类',
  'ShowArchive' => '文章归档'),
  array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive'), '侧边栏显示');
  $form->addInput($sidebarBlock->multiMode());
}