<?php while (have_posts()) : the_post(); ?>
    <div class="section">
        <?php if (has_post_thumbnail()) :
            // mh_the_post_thumbnail();
            $size = mh_get_thumbnail_size('large');
            the_post_thumbnail($size, mh_get_post_thumbnail_classes($size, 'alignleft'));
        endif; ?>
        <?php the_content(); ?>
    </div>
    <hr>
    <div class="section">
        <div class="column">
            <h2>Likes</h2>

            <ul>
                <?php while(has_sub_field('likes')) : ?>
                    <li><?php echo the_sub_field('like'); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="column">
            <h2>Dislikes</h2>

            <ul>
                <?php while(has_sub_field('dislikes')) : ?>
                    <li><?php echo the_sub_field('dislike'); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
<?php endwhile; ?>
