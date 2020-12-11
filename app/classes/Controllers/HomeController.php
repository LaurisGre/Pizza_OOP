<?php

namespace App\Controllers;

use App\App;
use App\Views\BasePage;
use App\Views\Card;
use App\Views\Forms\Admin\ButtonForms\OrderForm;
use App\Views\Forms\Admin\ButtonForms\EditForm;
use App\Views\Forms\Admin\ButtonForms\DeleteForm;
use Core\View;
use Core\Views\Form;

class HomeController extends \App\Abstracts\Controller
{
    protected OrderForm $order_form;
    protected EditForm $edit_form;
    protected DeleteForm $delete_form;
    protected $data;
    protected $message;

    public function __construct()
    {
        $this->order_form = new OrderForm();
        $this->edit_form = new EditForm();
        $this->delete_form = new DeleteForm();
    }

    function index(): ?string
    {
        if (Form::action()) {
            if (Form::action() === 'delete') {
                if ($this->delete_form->validate()) {
                    App::$db->deleteRow('pizzas', $this->delete_form->values()['id']);
                    $this->message = 'Pizza deleted :(';
                }
            }
            if (Form::action() === 'edit') {
                if ($this->edit_form->validate()) {
                    $id = $this->edit_form->values()['id'];
                    header("Location: /edit?id=$id");
                }
            }
            if (Form::action() === 'order') {
                if ($this->order_form->validate()) {
                    App::$db->insertRow('orders', [
                        'email' => $_SESSION['email'],
                        'pizza_id' => $this->order_form->values()['id'],
                        'status' => 'active',
                        'timestamp' => time(),
                    ]);
                    $this->message = 'Order placed!';
                }
            }
        }

        foreach (App::$db->getRowsWhere('pizzas') as $index => $pizza) {
            $card = new Card([
                'name' => $pizza['name'],
                'price' => $pizza['price'],
                'img' => $pizza['img'],
            ]);
            $this->data[] = $card->render();
        }

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                $content_array = [
                    'title' => 'Grab a slice!',
                    'welcome' => "Welcome " . App::$session->getUser()['full_name'],
                    'message' => $this->message,
                    'products' => $this->data,
                    'forms' => [
                        'edit' => $this->edit_form,
                        'delete' => $this->delete_form,
                    ],
                ];
            } elseif ($_SESSION['role'] === 'user') {
                $content_array = [
                    'title' => 'Grab a slice!',
                    'welcome' => "Welcome " . App::$session->getUser()['full_name'],
                    'message' => $this->message,
                    'products' => $this->data,
                    'forms' => [
                        'order' => $this->order_form,
                    ],
                ];
            }
        } else {
            $content_array = [
                'title' => 'Grab a slice!',
                'welcome' => 'Welcome, please login to order',
                'products' => $this->data,
                'forms' => [],
            ];
        }

        $content = new View($content_array);

        $page = new BasePage([
            'title' => 'Home',
            'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php'),
        ]);

        return $page->render();
    }
}
