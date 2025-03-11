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
        <div class="list">
            <?php if ($this->have()): ?>
            <?php while($this->next()): ?>
            <li>
                <i>#</i> <?php $this->category(' / '); ?>
                <a href="<?php $this->permalink() ?>" class="article__card">
                    <time class="time"><?php $this->date(); ?></time>
                    <h3 class="title"><?php $this->title() ?></h3>
                </a>
            </li>
            <?php endwhile; ?>
            <?php else: ?>暂无文章<?php endif; ?>
        </div>
        <!-- 分页 -->
        <div class="navigation page-navigation">
            
            <?php $this->pageLink('下页','next'); ?>
            
            <?php $this->pageLink('上页'); ?>
        </div>
    </main>
</div>
<?php $this->need('Footer.php');?>