<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <script>
      window.L = {
        THEME_URL: `<?php Helper::options()->themeUrl() ?>`,
        BASE_API: `<?php echo $this->options->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/SlateFlow/api' : Helper::options()->rootUrl . '/SlateFlow/api' ?>`,
        LAZY_LOAD: `<?php _getLazyload() ?>`,
        PAGE_SIZE: `<?php $this->options->pageSize(); ?>`,
      }
    </script>
    
    <?php
        $fontUrl = $this->options->CustomFont ?? ''; // 使用空字符串作为默认值
        $fontFormat = '';
        
        if (strpos($fontUrl, 'woff2') !== false) {
            $fontFormat = 'woff2';
        } elseif (strpos($fontUrl, 'woff') !== false) {
            $fontFormat = 'woff';
        } elseif (strpos($fontUrl, 'ttf') !== false) {
            $fontFormat = 'truetype';
        } elseif (strpos($fontUrl, 'eot') !== false) {
            $fontFormat = 'embedded-opentype';
        } elseif (strpos($fontUrl, 'svg') !== false) {
            $fontFormat = 'svg';
        }
    ?>
    <style>
        @font-face {
            font-family: 'wodeziti';
            font-weight: 400;
            font-style: normal;
            font-display: swap;
            src: url('<?php echo $fontUrl ?>');
            <?php if ($fontFormat) : ?>src: url('<?php echo $fontUrl ?>') format('<?php echo $fontFormat ?>');
            <?php endif; ?>
        }
        @font-face{
            font-family: 'OPPOSans';
            font-weight: 400;
            src:  url('https://code.oppo.com/content/dam/oppo/common/fonts/font2/new-font/OPPOSansOS2-5000-Regular.woff2');
        }
        @font-face{
            font-family: 'OPPOSans';
            font-weight: 500;
            src:  url('https://code.oppo.com/content/dam/oppo/common/fonts/font2/new-font/OPPOSansOS2-5000-Medium.woff2');
        }
        
        body {
            <?php if ($fontUrl) : ?>
            font-family: 'wodeziti';
            <?php else : ?>
            font-family: 'OPPOSans','Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
        <?php endif; ?>
      }
      <?php $this->options->CustomCSS() ?>
    </style>