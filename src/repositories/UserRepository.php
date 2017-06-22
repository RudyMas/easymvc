<?php
namespace Repository;

use Library\Repository;

/**
 * Class UserRepository
 * @package Repository
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