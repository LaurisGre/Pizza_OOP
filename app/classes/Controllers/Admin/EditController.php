<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AdminController;
use App\Views\BasePage;
use App\Views\Forms\Admin\EditForm;

class EditController extends AdminController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent::__construct();
        $this->form = new EditForm();
        $this->page = new BasePage([
            'title' => 'Edit Existing pizzas',
        ]);
    }

    public function index()
    {
        if (App::$db->getRowById('pizzas', $_GET['id'])) {
            $this->form->fill(App::$db->getRowById('pizzas', $_GET['id']));
        } else {
            header('Location: /');
            exit();
        }

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            App::$db->updateRow('pizzas', $_GET['id'], $clean_inputs);
            header('Location: /');
        };

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }
}
