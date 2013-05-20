<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

<?php
    do_action('get_header');
    get_template_part('templates/header');
?>

    <div class="<?php echo roots_wrapper_classes('l-container'); ?>" role="document">
        <main class="content" role="main">
            <?php include roots_template_path(); ?>
        </main>
        <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar widget-area" role="complementary">
            <div class="inner">
            <?php include roots_sidebar_path(); ?>
            </div>
        </aside><!-- /.sidebar -->
        <?php endif; ?>
    </div><!-- /.l-container -->

    <?php get_template_part('templates/footer'); ?>

</body>
</html>
