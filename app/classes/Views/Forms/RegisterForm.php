<?php

namespace App\Views\Forms;

use Core\Views\Form;

class RegisterForm extends Form
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
                'full_name' => [
                    'label' => 'Full Name',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'your name here',
                        ],
                    ],
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'your password here',
                        ],
                    ],
                ],
                'password_repeat' => [
                    'label' => 'Password repeat',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'repeat your password',
                        ],
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Register',
                    'type' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn',
                        ],
                    ],
                ],
            ],
            'validators' => [
                'validate_field_match' => [
                    'password',
                    'password_repeat',
                ],
            ],
        ]);
    }
}
