<?php
/**
 *  "Where moments stream in cool serenity."
 *       （时光在冷静的静谧中流淌）
 * 
 *  “ 环境要求：PHP 7.4 ~ 8.4 ”
 * 
 * <style>p{line-height:2.2;}</style>
 * 
 * @package SlateFlow
 * 
 * @author 林翊
 * 
 * @version 1.2
 * 
 * @link //ouyu.me
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('Public/Include.php');
$this->need('Public/Header.php');
?>

<div class="layout-container">
    <?php $this->need('Public/Sidebar.php');?>
    <main class="articles">
        <div class="post__top">
            <div class="crumbs_patch">
                <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo;</li>
                <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
                    Latest Post
                <?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
                    <?php $this->category(); ?> &raquo; <?php $this->title() ?>
                <?php else: ?><!-- 页面为其他页时 -->
                    <?php $this->archiveTitle(' &raquo; ','',''); ?>
                <?php endif; ?>
            </div>
            <div class="title">
                <h3><?php $this->title() ?></h3>
            </div>
            <p class="headd">
                <span>作者: <?php $this->author(); ?></span>
                <span>时间: <?php echo time_diff($this->created); ?></span>
                <span>评论: <?php $this->commentsNum('0 条', '1 条', '%d 条'); ?></span>
            </p>
        </div>
        
        <article class="entry__layout formatted-content">
            <?php echo parseMarkTags($this->content); ?>
        </article>
        
        <?php $this->need('comments.php'); ?>
    </main>
</div>
<?php $this->need('Footer.php');?>