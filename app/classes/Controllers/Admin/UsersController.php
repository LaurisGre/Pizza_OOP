<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AdminController;
use App\Views\BasePage;
use App\Views\Forms\Admin\RoleForm;
use Core\Views\Form;
use Core\Views\Table;

class UsersController extends AdminController
{
    protected $form;
    protected $page;
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->form = new RoleForm();
        $this->table = new Table([
            'title' => 'Users',
            'headers' => [
                'ID',
                'User Name',
                'Role',
            ],
            'data' => [],
        ]);
        $this->page = new BasePage([
            'title' => 'Users',
        ]);
    }

    public function index()
    {
        if (Form::action()) {
            if ($this->form->validate()) {
                $updated_order = App::$db->getRowById('users', $this->form->values()['id']);
                $updated_order['role'] = $this->form->values()['role'];
                App::$db->updateRow('users', $this->form->values()['id'], $updated_order);
            }
        }

        $new_data = [];
        $num = 1;

        foreach (App::$db->getRowsWhere('users') as $index => $user) {
            if ($user['email'] !== $_SESSION['email']) {
                $new_user = [];

                $new_user['id'] = $num;
                $new_user['full_name'] = $user['full_name'];
                $this->form->fill([
                    'role' => $user['role'],
                    'id' => $index,
                ]);
                $new_user['role'] = $this->form->render();

                $new_data[] = $new_user;
                $num++;
            }
        }

        $this->table->updateTableData($new_data);

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}
