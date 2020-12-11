<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AdminController;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;

class AddController extends AdminController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent::__construct();
        $this->form = new AddForm();
        $this->page = new BasePage([
            'title' => 'Add new pizzas',
        ]);
    }

    public function index()
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            App::$db->insertRow('pizzas', $clean_inputs);
        };

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }
}
