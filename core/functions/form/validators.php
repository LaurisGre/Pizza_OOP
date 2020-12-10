<?php

/**
 * Checks if the field is not empty
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_not_empty(string $field_value, array &$field): bool
{
    if ($field_value === '') {
        $field['error'] = 'ERROR TU DURNS, PARAŠYK KAŽKĄ';
        return false;
    }
    return true;
}

/**
 * Checks if the field contains a space
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_space(string $field_value, array &$field): bool
{
    if (strpos(trim($field_value, ' '), ' ') === false) {
        $field['error'] = 'ERROR TU NENORMALUS, KUR TARPAS?';
        return false;
    }
    return true;
}

/**
 * Checks if the given field values match
 *
 * @param array $field_values
 * @param array $form
 * @param array $params
 * @return boolean
 */
function validate_field_match(array $field_values, array &$form, array $params): bool
{
    foreach ($params as $par_value) {
        if (!($field_values[$params[0]] === $field_values[$par_value])) {
            $form['error'] = strtr('ERROR -- @name IS INCORRECT', [
                '@name' => $form['fields'][$par_value]['label']
            ]);
            return false;
        }
    }

    return true;
}

/**
 * Checks if the given value is numeric
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_numeric(string $field_value, array &$field): bool
{
    if (!(is_numeric($field_value))) {
        $field['error'] = 'THAT\'S NOT A NUMBER FOOL';
        return false;
    }
    return true;
}

/**
 * Checks if the given value is an integer
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_integer(string $field_value, array &$field): bool
{
    if (!(is_integer($field_value))) {
        $field['error'] = 'THAT\'S NOT A NUMBER FOOL';
        return false;
    }
    return true;
}

/**
 * Checks if the given value is in the correct email format
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_email(string $field_value, array &$field): bool
{
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $field_value)) {
        $field['error'] = 'ERROR THAT\'S NOT A VALID EMAIL';
        return false;
    }
    return true;
}

/**
 * Checks if the given option value is valid
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_select(string $field_value, array &$field): bool
{
    if (!(array_key_exists($field_value, $field['options']))) {
        $field['error'] = 'ERROR INPUT DOESN\'T EXIST';
        return false;
    }
    return true;
}

/**
 * Checks if the given number is in the designated field range
 *
 * @param string $field_value
 * @param array $field
 * @param array $params
 * @return boolean
 */
function validate_field_range(string $field_value, array &$field, array $params): bool
{
    if ($field_value < $params['min'] || $field_value > $params['max']) {
        $field['error'] = 'VALID COORD RANGE IS 0PX - 490PX';
        return false;
    }
    return true;
}

/**
 * Checks if the given number is in valid step 
 *
 * @param string $field_value
 * @param array $field
 * @param array $params
 * @return boolean
 */
function validate_number_step(string $field_value, array &$field, array $params): bool
{
    if ($field_value % $params['step'] !== 0) {
        $field['error'] = 'VALID COORD STEP IS 10PX APART';
        return false;
    }

    return true;
}
