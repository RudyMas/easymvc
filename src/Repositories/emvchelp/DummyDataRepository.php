<?php

namespace Repositories\emvchelp;

use EasyMVC\Repository\Repository;
use Models\emvchelp\DummyData;

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
     * @param DummyData|null $dummyData
     */
    public function __construct(DummyData $dummyData = null)
    {
        parent::__construct(null, $dummyData);
    }
}