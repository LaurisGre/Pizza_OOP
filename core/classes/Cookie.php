<?php

namespace Core;

class Cookie
{
    private $name;
    private $value;
    private $timer;

    public function __construct(string $name, string $value, int $timer = 3600)
    {
        $this->name = $name;
        $this->value = $value;
        $this->timer = $timer;
        $this->set();
    }

    private function set(): bool
    {
        if (!$this->checkExist()) {
            return setcookie($this->name, $this->value, time() + $this->timer, '/');
        }

        return false;
    }

    private function checkExist(): bool
    {
        return isset($_COOKIE[$this->name]);
    }

    public function get(): bool
    {
        if ($this->checkExist()) {
            return $_COOKIE[$this->name];
        }

        return false;
    }

    public function delete(): bool
    {
        if ($this->checkExist()) {
            setcookie($this->name, null, -1);

            return true;
        }
        
        return false;
    }
}
