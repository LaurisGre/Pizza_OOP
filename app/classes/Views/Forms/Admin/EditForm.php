<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class EditForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Pizza Name',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'Name here',
                        ],
                    ]
                ],
                'price' => [
                    'label' => 'Price',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_is_numeric'
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'price here',
                        ],
                    ]
                ],
                'img' => [
                    'label' => 'Image',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extras' => [
                        'attr' => [
                            'placeholder' => 'img url here',
                        ],
                    ]
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Update',
                    'type' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn',
                        ],
                    ],
                ],
            ],
            'validators' => [
                'validate_pizza_unique',
            ],
            'attr' => [
                'class' => 'add_pizza',
            ],
        ]);
    }
}
