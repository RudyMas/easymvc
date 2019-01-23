<?php

namespace Repositories\emvchelp;

use EasyMVC\Repository\Repository;
use Models\emvchelp\DummyDataOldStyle;

/**
 * Class DummyDataRepository
 *
 * @package Repository
 */
class DummyDataRepository extends Repository
{
    /**
     * DummyDataRepository constructor.
     *
     * @param DummyDataOldStyle|null $dummyData
     */
    public function __construct(DummyDataOldStyle $dummyData = null)
    {
        parent::__construct(null, $dummyData);
    }
}
