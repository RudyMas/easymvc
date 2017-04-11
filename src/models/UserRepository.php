<?php
namespace Model;

use Library\Repository;

/**
 * Class UserRepository
 * @package Model
 */
class UserRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param User|null $users
     */
    public function __construct(User $users = null)
    {
        parent::__construct($users);
    }
}