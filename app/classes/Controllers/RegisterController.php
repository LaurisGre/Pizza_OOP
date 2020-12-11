<?php

namespace App\Controllers;

use App\App;
use App\Controllers\Base\GuestController;
use App\Views\BasePage;
use App\Views\Forms\RegisterForm;

class RegisterController extends GuestController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent::__construct();
        $this->form = new RegisterForm();
        $this->page = new BasePage([
            'title' => 'YOU CAN REGISTER HERE',
        ]);
    }

    public function index()
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            unset($clean_inputs['password_repeat']);
            $clean_inputs['role'] = 'user';
            App::$db->insertRow('users', $clean_inputs);
            header("Location:login");
        };

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }
}
