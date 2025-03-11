<?php $this->need('Public/Config.php'); ?>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
    <?php if ($this->options->Favicon()) : ?>
    <link rel="shortcut icon" href="<?php $this->options->Favicon() ?>" />
    <?php else : ?>
    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text x=%22-0.125em%22 y=%22.9em%22 font-size=%2290%22>🌈</text></svg>" />
    <?php endif; ?>
    <title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php if ($this->is('single')) : ?>
      <meta name="keywords" content="<?php echo $this->fields->keywords ? $this->fields->keywords : htmlspecialchars($this->_keywords); ?>" />
      <meta name="description" content="<?php echo $this->fields->description ? $this->fields->description : htmlspecialchars($this->_description); ?>" />
      <?php $this->header('keywords=&description='); ?>
    <?php else : ?>
      <?php $this->header(); ?>
    <?php endif; ?>
    <!-- 通用 -->
    <link href="<?php _getAssets('Assets/Css/Style.css'); ?>" rel="stylesheet" />
    
    <!-- jquery -->
    <script src="<?php _getAssets('Assets/Js/jquery@3.6.0/jquery.min.js'); ?>"></script>
    <!-- 通用 -->
    <script src="<?php _getAssets('Assets/Js/Global.min.js'); ?>"></script>
    <!-- 加载 -->
    <script src="<?php _getAssets('Assets/Js/lazysizes@5.3.2/lazysizes.min.js'); ?>"></script>
    <!-- 提示 -->
    <link href="<?php _getAssets('Assets/Js/Message/message.min.css'); ?>" rel="stylesheet" />
    <script src="<?php _getAssets('Assets/Js/Message/message.min.js'); ?>"></script>
    <!-- 幻灯片 -->
    <link href="<?php _getAssets('Assets/Js/slick@1.8.1/slick.min.css'); ?>" rel="stylesheet" />
    <script src="<?php _getAssets('Assets/Js/slick@1.8.1/slick.min.js'); ?>"></script>
    <!-- 代码 -->
    <?php if ($this->options->PrismTheme) : ?>
    <link href="<?php $this->options->PrismTheme() ?>" rel="stylesheet">
    <?php else : ?>
    <link href="//npm.elemecdn.com/prismjs@1.29.0/themes/prism.min.css" rel="stylesheet">
    <?php endif; ?>
    <script src="<?php _getAssets('Assets/Js/Prism/prism.js'); ?>"></script>
    <!-- 灯箱 -->
    <script src="<?php _getAssets('Assets/Js/view-image.min.js'); ?>"></script>
    
    
    <?php $this->options->CustomHeadEnd() ?>

</head>
<body class="<?php if ($this->is('single')) : ?>post-page<?php endif; ?>">