<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class StatusForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'id' => [
                    'type' => 'hidden',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                ],
                'status' => [
                    'type' => 'select',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_select',
                    ],
                    'options' => [
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Update',
                    'type' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn-link',
                        ],
                    ],
                ],
            ],
            'attr' => [
                'class' => 'status_form',
            ],
        ]);
    }
}
