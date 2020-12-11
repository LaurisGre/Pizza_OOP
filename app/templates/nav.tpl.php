<nav>
    <ul>
        <?php foreach ($data as $li_path => $li_name) : ?>
            <li>
                <a href="<?php print $li_path; ?>">
                    <?php print $li_name; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>