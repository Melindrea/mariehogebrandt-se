<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('inner'); ?>>
    <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php if(!empty($post->post_excerpt)) : ?>
            <div class="entry-summary">
             <?php the_excerpt(); ?>
            </div>
         <?php endif; ?>
    </header>
    <div class="entry-content">
    <?php if (has_post_thumbnail()) :
        $size = mh_get_thumbnail_size('large');
        the_post_thumbnail($size, mh_get_post_thumbnail_classes($size));
    endif; ?>
        <?php the_content(); ?>
    </div>
    <footer class="entry-footer">
        <?php get_template_part('templates/entry-meta'); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
    <hr>
    <p>For the moment comments are not enabled, but feel free to <a href="http://www.twitter.com/?status=@melindrea82" rel="external">reach out on Twitter</a>.</p>
  </article>
<?php endwhile; ?>
