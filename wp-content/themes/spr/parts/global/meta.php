<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="google" content="notranslate" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<script type="text/javascript">var ajaxurl = "<?= admin_url('admin-ajax.php') ?>";</script>
<?php wp_head(); ?>
<?php if (WP_ENV == 'production'): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168752549-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-168752549-2');
    </script>
<?php endif; ?>
