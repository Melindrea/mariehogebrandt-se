<footer class="site-footer l-container" role="contentinfo">
    <?php if (get_field('contact_information', 'option')) : ?>
    <ul>
    <?php while (has_sub_field('footer_information', 'option')) : ?>
        <li class="<?php echo the_sub_field('class'); ?>">
            <?php if (get_sub_field('link')) : ?>
            <a href="<?php echo the_sub_field('link'); ?>">
            <?php endif; ?>
            <?php echo the_sub_field('content'); ?>
            <?php if (get_sub_field('link')) : ?>
            </a>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
    </ul>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>
