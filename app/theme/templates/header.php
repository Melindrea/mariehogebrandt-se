<header class="l-container site-header" role="banner">
    <?php if (get_field('contact_information', 'option')) : ?>
    <ul class="contact">
    <?php while (has_sub_field('contact_information', 'option')) : ?>
        <li<?php if (get_sub_field('li_class')) : ?> class="<?php echo the_sub_field('li_class'); ?>"<?php endif; ?>>
            <a href="<?php echo the_sub_field('link'); ?>"<?php if (get_sub_field('li_title')) : ?> title="<?php echo the_sub_field('link_title'); ?>"<?php endif; ?>>
                <?php echo the_sub_field('content'); ?>
            </a>
        </li>
    <?php endwhile; ?>
    </ul>
    <?php endif; ?>
    <nav class="nav-main" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation'));
        endif;
      ?>

    </nav>
</header>
