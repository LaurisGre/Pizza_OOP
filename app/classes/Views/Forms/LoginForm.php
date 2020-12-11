<?php

namespace App\Views\Forms;

use Core\Views\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'email' => [
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_email',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'your email here',
                        ],
                    ],
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'your password here',
                        ],
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Login',
                    'type' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn',
                        ],
                    ],
                ],
            ],
            'validators' => [
                'validate_login'
            ],
        ]);
    }
}
