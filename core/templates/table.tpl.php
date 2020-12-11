<table>
    <h1 class="title"><?php print $data['title']; ?></h1>
    <tr>
        <?php foreach ($data['headers'] as $header) : ?>
            <th><?php print $header; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($data['data'] ?? [] as $row) : ?>
        <tr>
            <?php foreach ($row as $column) : ?>
                <td><?php print $column; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<!-- <?php var_dump($data); ?> -->
<?php if (isset($data['message'])) : ?>
    <p class="message"> <?php print $data['message']; ?></p>
<?php endif; ?>