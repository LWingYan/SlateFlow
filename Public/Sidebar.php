<div class="menu_off"></div>
    <div class="aside">
        <!-- 博主 -->
        <section class="aside__author">
            <div class="left">
                <?php if ($this->options->index_img) : ?>
                <img class="lazyload aside__bj" data-src="<?php $this->options->index_img() ?>" alt="站点背景图" src="<?php $this->options->index_img() ?>">
                <?php else: ?>
                <img class="lazyload aside__bj" data-src="<?php _getAssets('Assets/Img/linwan.jpg'); ?>" alt="站点背景图" src="<?php _getAssets('Assets/Img/linwan.jpg'); ?>">
                <?php endif; ?>
                <div class="absolute">
                    <img src="<?php _getAvatarLazyload(); ?>" data-src="<?php $this->options->Aside_Author_Avatar ? $this->options->Aside_Author_Avatar() : _getAvatarByMail($this->authorId ? $this->author->mail : $this->user->mail) ?>" alt="头像" class="lazyload avatar" width="40px" height="40px">
                    <div class="title"><?php $this->author(); ?></div>
                    <p class="description" title="<?php $this->options->description() ?>"><?php $this->options->description() ?></p> 
                </div>
            </div>
        </section>
        <!-- 搜索 -->
        <section class="aside__search w-full">
            <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <button type="submit" class="submit search-button"><?php _e('搜索'); ?></button>
                <input type="text" id="s" name="s" class="text search-input" placeholder="<?php _e('输入关键字搜索'); ?>" />
            </form>
        </section>
        <!-- 分类 -->
        <nav class="aside__navbar">
            <span><i>#</i> 分类</span>
            <div class="category_list">
                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                <?php while($category->next()): ?>
                <li>
                    <a class="<?php if($this->is('category') && $this->getArchiveSlug() == $category->slug): ?>current<?php endif; ?> <?php echo isActiveMenu($this, $category->slug); ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                </li>
                <?php endwhile; ?>
            </div>
            <span><i>#</i> 页面</span>
            <div class="page_list">
                <li>
                    <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                </li>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                <li>
                    <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                </li>
                <?php endwhile; ?>
            </div>
        </nav>
        <!-- 更多 比如版权 -->
        <?php $this->need('Public/Copy.php');?>
    </div>
