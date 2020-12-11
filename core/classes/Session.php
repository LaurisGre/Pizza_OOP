<?php

namespace Core;

use App\App;

class Session
{
    private ?array $user = null;

    public function __construct()
    {
        session_start();
        $this->loginFromCookie();
    }

    public function loginFromCookie(): bool
    {
        if ($_SESSION) {
            return $this->login($_SESSION['email'], $_SESSION['password']);
        }

        return false;
    }

    public function login(string $email, string $password): bool
    {
        $user = App::$db->getRowWhere('users', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($user) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $user['role'];
            $this->user = $user;
            return true;
        }

        $this->user = null;

        return false;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function logout(?string $redirect = null): void
    {
        $_SESSION = [];
        session_destroy();

        if ($redirect) {
            header("Location: $redirect");
        }
    }
}
