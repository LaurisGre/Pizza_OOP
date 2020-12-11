<?php

namespace App\Views;

use Core\View;

class Card extends View
{
    public function render($template_path = ROOT . '/app/templates/content/card.tpl.php')
    {
        return parent::render($template_path);
    }
}
