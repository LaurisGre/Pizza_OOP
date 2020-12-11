<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class RoleForm extends Form
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
                'role' => [
                    'type' => 'select',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_select',
                    ],
                    'options' => [
                        'admin' => 'Admin',
                        'user' => 'User',
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Set',
                    'type' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn-link',
                        ],
                    ],
                ],
            ],
            'attr' => [
                'class' => 'role_form',
            ],
        ]);
    }
}
