<form <?php print form_attr($data); ?>>
    <?php foreach ($data['fields'] as $input_name => $input) : ?>

        <?php if (isset($input['label'])) : ?>
            <label>
            <p class="label_text"><?php print $input['label']; ?></p>
        <?php endif; ?>

            <?php if ($input['type'] === 'select') : ?>
                <select <?php print select_attr($input_name, $input); ?>>
                    <?php foreach ($input['options'] as $option_name => $option_value) : ?>
                        <option <?php print option_attr($option_name, $input); ?>>
                            <?php print $option_value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            <?php elseif ($input['type'] === 'textarea') : ?>
                <textarea <?php print textarea_attr($input_name, $input); ?>><?php print $input['value']; ?></textarea>
            
            <?php else : ?>
                <input <?php print input_attr($input_name, $input); ?>>
            <?php endif; ?>

            <?php if (isset($input['error'])) : ?>
                <p class="error"><?php print $input['error']; ?></p>
            <?php endif; ?>

        <?php if (isset($input['label'])) : ?>
            </label>
        <?php endif; ?>


    <?php endforeach; ?>

    <?php foreach ($data['buttons'] as $button_id => $button) : ?>
        <button <?php print button_attr($button_id, $button); ?>>
            <?php print $button['title']; ?>
        </button>
    <?php endforeach; ?>

    <?php if (isset($data['error'])) : ?>
        <p class="error"><?php print $data['error']; ?></p>
    <?php endif; ?>

</form>