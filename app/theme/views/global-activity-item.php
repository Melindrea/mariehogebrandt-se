<li>
    <article class="activity-item">
        <h4 class="activity-header <?php echo $icon; ?>">
            <a href="<?php echo $link; ?>" ><?php echo $name; ?></a>
        </h4>
        <?php if ($description !== '') : ?>
        <div class="activity-description"><?php echo $description; ?></div>
        <?php endif; ?>
    </article>
</li>
