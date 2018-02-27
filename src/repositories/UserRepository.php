<?php

namespace Repository;

use EasyMVC\Repository\Repository;
use Model\User;

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

/** End of File: UserRepository.php **/