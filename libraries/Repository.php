<?php

namespace Library;

use Exception;
use RudyMas\PDOExt\DBconnect;

/**
 * Class Repository
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.4.0
 * @package     Library
 */
class Repository
{
    private $data = [];
    private $indexMarker = 0;
    private $db;

    /**
     * Repository constructor.
     * @param $object
     * @param DBconnect|null $db
     */
    public function __construct($object, DBconnect $db = null)
    {
        if ($object !== null) {
            $this->data[] = $object;
        }
        if ($db !== null) {
            $this->db = $db;
        }
    }

    /**
     * @param $object
     */
    public function add($object): void
    {
        $this->data[] = $object;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * @deprecated
     * @param int $index
     * @return mixed
     */
    public function getAtIndex(int $index)
    {
        trigger_error('Use getByIndex instead.', E_USER_DEPRECATED);
        return $this->getByIndex($index);
    }

    /**
     * @param int $index
     * @return mixed
     * @throws Exception
     */
    public function getByIndex(int $index)
    {
        foreach ($this->data as $value) {
            if ($value->getId() === $index) {
                return $value;
            }
        }
        throw new Exception('<b>ERROR:</b> Call to an unknown repository Index!');
    }

    /**
     * @param string $field
     * @param string $search
     * @return array
     */
    public function getBy(string $field, string $search): array {
        $output = [];
        foreach ($this->data as $value) {
            if ($value[$field] == $search) {
                $output[] = $value;
            }
        }
        return $output;
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

/** End of File: Repository.php **/