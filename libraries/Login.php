<?php
namespace Library;

use RudyMas\Manipulator\Text;
use RudyMas\PDOExt\DBconnect;

/**
 * Class Login (Version PHP 7.0)
 *
 * Translated Login class (rudymas/login)
 *
 * In the MySQL table 'emvc_users' you only need to add 6 fixed fields:
 * - id             = int : Is the index for the table (auto_increment)
 * - username       = varchar(30) : The login username
 * - password       = varchar(64) : The login password
 * - salt           = varchar(20) : Used for extra security
 * - remember_me    = varchar(40) : Special hashed password to automatically login
 * - remember_me_ip = varchar(45) : The IP from where the user can login automatically (Can be an IPv4 or IPv6 address)
 *
 * For security purposes, the user will only be able to automatically login as long as he is working with the same
 * IP-address. If the IP-address changes, the user needs to manually login again.
 *
 * All the extra fields added to the user table can be accessed by using $login->data['....']
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.1.0
 * @package     Library
 */
class Login
{
    public $data, $errorCode;
    private $db;

    /**
     * Login constructor.
     * @param DBconnect $DBconnect
     */
    public function __construct(DBconnect $DBconnect)
    {
        $this->db = $DBconnect;
    }

    /**
     * @param bool $cookie
     */
    public function logoutUser(bool $cookie = false): void
    {
        unset($_SESSION['password']);
        unset($_SESSION['IP']);
        unset($this->data);
        if ($cookie == true) {
            setcookie('username', '', -1, '/');
            setcookie('rememberMe', '', -1, '/');
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function loginUser(string $username, string $password, bool $remember = false): bool
    {
        $query = "SELECT * FROM emvc_users WHERE username = {$this->db->cleanSQL($username)}";
        $this->db->query($query);
        if ($this->db->rows != 0) {
            $this->db->fetch(0);
            if ($sha256Password = hash('sha256', $password . $this->db->data['salt'] == $this->db->data['password'])) {
                setcookie('username', $username, time() + (30 * 24 * 3600), '/');
                if ($remember === true) {
                    $text = new Text();
                    $this->data['remember_me'] = $text->randomText(25);
                    $this->data['remember_me_ip'] = $this->getIP();
                    $this->updateUser($username);
                    setcookie('rememberMe', $this->data['remember_me'], time() + (30 * 24 * 3600), '/');
                } else {
                    $_SESSION['password'] = $sha256Password;
                    $_SESSION['IP'] = $this->getIP();
                }
                $this->data = $this->db->data;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function checkUser(): bool
    {
        $remember = false;
        $IP = '';
        $password = '';
        if (isset($_COOKIE['username'])) $username = $_COOKIE['username']; else $username = '';
        if (isset($_COOKIE['rememberMe'])) {
            $password = $_COOKIE['rememberMe'];
            $remember = true;
        } elseif (isset($_SESSION['password']) && isset($_SESSION['IP'])) {
            $password = $_SESSION['password'];
            $IP = $_SESSION['IP'];
        }
        if ($username != '' && $password != '') {
            $query = "SELECT * FROM emvc_users WHERE username = {$this->db->cleanSQL($username)}";
            $this->db->query($query);
            if ($this->db->rows != 0) {
                $this->db->fetch(0);
                if ($password == ($remember) ? $this->db->data['remember_me'] : $this->db->data['password']) {
                    if ($remember) $IP = $this->db->data['remember_me_ip'];
                    if ($IP == $this->getIP()) {
                        $this->data = $this->db->data;
                        return true;
                    } else {
                        unset($this->data);
                        $this->logoutUser(true);
                        ?>
                        <script type="text/javascript">
                            alert('Your login isn\'t valid anymore!\nYou have been logged out,\nand need to login again!');
                        </script>
                        <?php
                        return false;
                    }
                } else {
                    unset($this->data);
                    return false;
                }
            } else {
                unset($this->data);
                return false;
            }
        } else {
            unset($this->data);
            return false;
        }
    }

    /**
     * @return bool
     */
    public function insertUser(): bool
    {
        $nameField = [];
        $text = new Text();
        $this->data['salt'] = $text->randomText(20);
        $this->data['remember_me'] = null;
        $this->data['remember_me_ip'] = null;

        $query = "SELECT id FROM emvc_users WHERE username = {$this->db->cleanSQL($this->data['username'])}";
        $this->db->query($query);
        if ($this->db->rows != 0) {
            $this->errorCode = 9;
            return false;
        }

        $query = "SHOW COLUMNS FROM emvc_users";
        $this->db->query($query);
        $numberOfFields = $this->db->rows;
        for ($x = 0; $x < $numberOfFields; $x++) {
            $this->db->fetch($x);
            $nameField[$x] = $this->db->data['Field'];
        }

        $query = "INSERT INTO emvc_users ";
        $query .= "VALUES (0";
        for ($x = 1; $x < $numberOfFields; $x++) {
            $query .= ", ";
            if ($nameField[$x] == 'password') {
                $query .= '\'' . hash('sha256', $this->data['password'] . $this->data['salt']) . '\'';
            } else {
                $query .= $this->db->cleanSQL($this->data[$nameField[$x]]);
            }
        }
        $query .= ")";
        $this->db->insert($query);
        if ($this->loginUser($this->data['username'], $this->data['password'])) {
            return true;
        } else {
            $this->errorCode = 2;
            return false;
        }
    }

    /**
     * @param string $user
     * @return bool
     */
    public function updateUser(string $user = ''): bool
    {
        if (isset($_COOKIE['username'])) $username = $_COOKIE['username'];
        elseif ($user != '') $username = $user;
        else return false;
        $query = "UPDATE emvc_users SET ";
        foreach ($this->data as $key => $value) {
            $query .= "{$key} = '{$value}', ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE username = {$this->db->cleanSQL($username)}";
        $this->db->update($query);
        return true;
    }

    /**
     * @return string
     */
    private function getIP(): string
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $addresses = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $IP = $addresses[count($addresses) - 1];
        } elseif (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            $IP = $_SERVER['REMOTE_ADDR'];
        } elseif (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $IP = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $IP = 'Unknown';
        }
        return $IP;
    }
}
/** End of File: Login.php **/