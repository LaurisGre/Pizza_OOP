<?php

/**
 * Constructs a string with the given HTML attributes
 *
 * @param array $attr
 * @return string
 */
function html_attr(array $attr): string
{
    $att_string = '';
    foreach ($attr as $att_name => $att_value) {
        if ($att_name === 'readonly') {
            $att_string .= $att_name;
        } else {
            $att_string .= "$att_name=\"$att_value\" ";
        }
    }

    return $att_string;
}

/**
 * Constructs HTML style attribute string
 *
 * @param array $attr
 * @return string
 */
function style_attr(array $attr): string
{
    $att_string = '';
    foreach ($attr as $att_name => $att_value) {
        $att_string .= "$att_name: $att_value; ";
    }

    return $att_string;
}

/**
 * Constructs a string with the given HTML attributes for the form element
 *
 * @param [type] $form
 * @return void
 */
function form_attr($form)
{
    $defaults = ['method' => 'POST'];
    return html_attr(($form['attr'] ?? []) + $defaults);
}

/**
 * Constructs a string with the given HTML attributes for the input element
 *
 * @param string $field_name
 * @param array $field
 * @return string
 */
function input_attr(string $field_name, array $field): string
{
    $attributes = [
        'name' => $field_name,
        'type' => $field['type'],
        'value' => $field['value'] ?? ''
    ] + ($field['extras']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Constructs a string with the given HTML attributes for the select element
 *
 * @param string $select_name
 * @param array $select_value
 * @return string
 */
function select_attr(string $select_name, array $select_value): string
{
    $attributes = [
        'name' => $select_name,
        'value' => $select_value['value'],
    ] + ($select_value['extras']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Constructs a string with the given HTML attributes for the option element
 *
 * @param string $option_name
 * @param array $select
 * @return string
 */
function option_attr(string $option_name, array $select): string
{
    $attributes = [
        'value' => $option_name,
    ];

    if ($select['value'] === $option_name) {
        $attributes['selected'] = 'selected';
    }

    return html_attr($attributes);
}

/**
 * Constructs a string with the given HTML attributes for the textarea element
 *
 * @param string $textarea_name
 * @param array $textarea
 * @return string
 */
function textarea_attr(string $textarea_name, array $textarea): string
{
    $attributes = [
        'name' => $textarea_name,
        'rows' => $textarea['rows'],
        'cols' => $textarea['cols'],
    ] + ($textarea['extras']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Constructs a string with the given HTML attributes for the button element
 *
 * @param string $button_id
 * @param array $button
 * @return string
 */
function button_attr(string $button_id, array $button): string
{
    $attributes = [
        'name' => 'action',
        'type' => $button['type'] ?? 'submit',
        'value' => $button_id,
    ] + ($button['extras']['attr'] ?? []);

    return html_attr($attributes);
}

/**
 * Constructs HTML attribute string for the brick
 *
 * @param array $brick
 * @return string
 */
function pixel_attr(array $brick): string
{
    $attributes = [
        'class' => 'brick',
        'style' => style_attr([
            'background-color' => $brick['color'],
            'top' => $brick['coord_y'] . 'px',
            'left' => $brick['coord_x'] . 'px',
        ]),
    ];

    return html_attr($attributes);
}

function pixel_hint_text(array $brick): string
{
    $hint_string =
        "X:{$brick['coord_x']} : Y:{$brick['coord_y']}" .
        '</br>' .
        "owner: {$brick['poster']}";

    return $hint_string;
}
