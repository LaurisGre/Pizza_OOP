<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AdminController;
use App\Views\BasePage;
use App\Views\Forms\Admin\StatusForm;
use Core\Views\Form;
use Core\Views\Table;

class OrdersController extends AdminController
{
    protected $form;
    protected $page;
    protected $table;

    public function __construct()
    {
        $this->form = new StatusForm();
        $this->table = new Table([
            'title' => 'Orders',
            'headers' => [
                'ID',
                'User Name',
                'Pizza Name',
                'Time Ago',
                'Status',
            ],
            'data' => [],
        ]);
        $this->page = new BasePage([
            'title' => 'Orders',
        ]);
    }

    public function index()
    {
        if (Form::action()) {
            if ($this->form->validate()) {
                $updated_order = App::$db->getRowById('orders', $this->form->values()['id']);
                $updated_order['status'] = $this->form->values()['status'];
                App::$db->updateRow('orders', $this->form->values()['id'], $updated_order);
            }
        }

        $new_data = [];
        $num = 1;

        foreach (App::$db->getRowsWhere('orders') as $index => $order) {
            $user = App::$db->getRowWhere('users', ['email' => $order['email']]);
            $pizza = App::$db->getRowById('pizzas', $order['pizza_id']);
            $new_order = [];

            $new_order['id'] = $num;
            $new_order['user_name'] = $user['full_name'];
            $new_order['pizza_name'] = $pizza['name'];
            $new_order['time_age'] =
                date('z', time() - $order['timestamp']) . 'd ' .
                date('H:i', time() - $order['timestamp']) . ' h';

            if ($_SESSION['role'] === 'admin') {
                $this->form->fill([
                    'status' => $order['status'],
                    'id' => $index
                ]);
                $new_order['status'] = $this->form->render();
            } else {
                $new_order['status'] = $order['status'];
            }

            $new_data[] = $new_order;
            $num++;
        }

        $this->table->updateTableData($new_data);

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}
