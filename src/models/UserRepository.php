<?php
namespace Model;

use Exception;

class UserRepository
{
    private $users = [];

    public function __construct(User $users = null)
    {
        if ($users != null) {
            $this->users[] = $users;
        }
    }

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function getAll()
    {
        return $this->users;
    }

    public function getAtIndex(int $index): User
    {
        foreach ($this->users as $value) {
            if ($value->getId() === $index) {
                return $value;
            }
        }
        throw new Exception('<b>ERROR:</b> Call to an unknown Index!');
    }
}