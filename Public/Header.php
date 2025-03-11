<header class="global-header">
    <div class="header__cover">
        <?php if ($this->options->index_img) : ?>
        <img src="<?php $this->options->index_img() ?>" class="header__cover-image lazyload" alt="封面图" data-src="<?php $this->options->index_img() ?>">
        <?php else: ?><!-- 默认样式 -->
        <img src="<?php _getAssets('Assets/Img/linwan.jpg'); ?>" class="header__cover-image lazyload" alt="封面图" data-src="<?php _getAssets('Assets/Img/linwan.jpg'); ?>">
        <?php endif; ?>
        <div class="loading">封面图加载中</div>
    </div>
</header>