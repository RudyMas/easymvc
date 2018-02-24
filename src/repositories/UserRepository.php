<?php
namespace Repository;

use Model\User;
use RudyMas\Emvc_Repository\Emvc_Repository;

/**
 * Class UserRepository
 * @package Repository
 */
class UserRepository extends Emvc_Repository
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