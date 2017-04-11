<?php

namespace Library;

use Exception;

/**
 * Class Repository
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.0.0
 * @package     Library
 */
class Repository
{
    private $data = [];
    private $indexMarker = 0;

    /**
     * Repository constructor.
     * @param $object
     */
    public function __construct($object)
    {
        if ($object == null) {
            $this->data[] = $object;
        }
    }

    /**
     * @param $object
     */
    public function add($object)
    {
        $this->data[] = $object;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @param int $index
     * @return mixed
     * @throws Exception
     */
    public function getAtIndex(int $index)
    {
        foreach ($this->data as $value) {
            if ($value->getId() === $index) {
                return $value;
            }
        }
        throw new Exception('<b>ERROR:</b> Call to an unknown repository Index!');
    }

    /**
     * @return bool
     */
    public function hasNext(): bool
    {
        if (isset($this->data[$this->indexMarker])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function next()
    {
        $this->indexMarker++;
        return $this->data[$this->indexMarker - 1];
    }
}