<?php

namespace Repositories;

use EasyMVC\Repository\Repository;
use Model\User;

/**
 * Class EmvcHelpDummyDataRepository
 *
 * @package Repository
 */
class EmvcHelpDummyDataRepository extends Repository
{
    /**
     * EmvcHelpDummyDataRepository constructor.
     *
     * @param User|null $users
     */
    public function __construct(User $users = null)
    {
        parent::__construct($users);
    }
}