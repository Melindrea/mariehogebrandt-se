<ul>
    <?php foreach ($items as $item) {
        $view = View::factory('global-activity-item')
        ->bind($item)
        ->render();
    } ?>
</ul>
