<?php

namespace Core\Views;

use Core\View;

class Form extends View
{
    public function render($template_path = ROOT . '/core/templates/form.tpl.php')
    {
        return parent::render($template_path);
    }

    /**
     * Clean inputs function - sanitizes and returns the values from the submited form
     *
     * @return array|null
     */
    public function values(): ?array
    {
        $parameters = [];
        foreach ($this->data['fields'] as $index => $input) {
            $parameters[$index] = FILTER_SANITIZE_SPECIAL_CHARS;
        }
        return filter_input_array(INPUT_POST, $parameters);
    }

    /**
     * Checks if the submited values have been sanitized
     *
     * @return boolean
     */
    public function isSubmited(): bool
    {
        return (bool) $this->values();
    }

    /**
     * Performs all of the designated validations of the form
     *
     * @return boolean
     */
    public function validate(): bool
    {
        if (!$this->isSubmited()) {
            return false;
        }

        $valid = true;
        $form_values = $this->values();

        foreach ($this->data['fields'] as $index => &$field) {
            foreach ($field['validators'] ?? [] as $validator_name => $validator_value) {
                if (is_array($validator_value)) {
                    if (!($validator_name($form_values[$index], $field, $validator_value))) {
                        $valid = false;
                        break;
                    }
                } else {
                    if (!($validator_value($form_values[$index], $field))) {
                        $valid = false;
                        break;
                    }
                }
            }
        }

        foreach ($this->data['validators'] ?? [] as $validator_name => $validator_value) {
            if (is_array($validator_value)) {
                if (!($validator_name($form_values, $this->data, $validator_value))) {
                    $valid = false;
                    break;
                }
            } else {
                if (!($validator_value($form_values, $this->data))) {
                    $valid = false;
                    break;
                }
            }
        }

        return $valid;
    }

    /**
     * Fills the form with the given data
     *
     * @param $new_values
     * @return void
     */
    public function fill($new_values): void
    {
        foreach ($this->data['fields'] as $field_name => &$field_value) {
            if (key_exists($field_name, $new_values)) {
                $field_value['value'] = $new_values[$field_name];
            }
        }
    }

    public static function action()
    {
        return filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
