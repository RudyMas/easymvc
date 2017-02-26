<?php
namespace Model;

use Exception;

class UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function getAll()
    {
        return $this->users;
    }

    public function getAtIndex(int $index)
    {
        if (isset($this->users[$index]))
            return $this->users[$index];
        else
            throw new Exception('<b>ERROR:</b> Unknown User Index: ' . $index);
    }
}