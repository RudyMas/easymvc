<?php

namespace Repositories;

use EasyMVC\Repository\Repository;
use Model\User;

/**
 * Class EmvcHelpUserRepository
 *
 * @package Repository
 */
class EmvcHelpUserRepository extends Repository
{
    /**
     * EmvcHelpUserRepository constructor.
     *
     * @param User|null $users
     */
    public function __construct(User $users = null)
    {
        parent::__construct($users);
    }
}