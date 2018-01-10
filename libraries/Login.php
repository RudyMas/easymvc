<?php

namespace Library;

use RudyMas\Manipulator\Text;
use RudyMas\PDOExt\DBconnect;

/**
 * Class Login (Version PHP 7.1)
 *
 * Translated Login class (rudymas/login)
 *
 * In the MySQL table 'emvc_users' you only need to add 6 fixed fields:
 * - id             = int : Is the index for the table (auto_increment)
 * - username       = varchar(40) : The login username
 * - email          = varchar(70) : The login e-mail
 * - password       = varchar(64) : The login password (Hashed with SHA256)
 * - salt           = varchar(20) : Used for extra security
 * - remember_me    = varchar(40) : Special password to automatically login
 * - remember_me_ip = varchar(45) : The IP from where the user can login automatically (Can be an IPv4 or IPv6 address)
 *
 * For security purposes, the users will only be able to automatically login as long as they are working with the same
 * IP-address. If the IP-address changes, the user needs to login again.
 *
 * All the extra fields you add to the emvc_users table can be accessed by using $login->data['...']
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2016-2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     2.3.5
 * @package     Library
 */
class Login
{
    public $data, $errorCode;
    private $db, $text, $emailLogin;

    /**
     * Login constructor.
     * @param DBconnect $dbconnect
     * @param Text $text
     * @param bool $emailLogin
     */
    public function __construct(DBconnect $dbconnect, Text $text, bool $emailLogin = false)
    {
        $this->db = $dbconnect;
        $this->text = $text;
        $this->emailLogin = $emailLogin;
    }

    /**
     * @param bool $cookie
     */
    public function logoutUser(bool $cookie = false): void
    {
        unset($_SESSION['password']);
        unset($_SESSION['IP']);
        $this->data = [];
        setcookie('remember_me', '', -1, '/');
        if ($cookie == true) {
            setcookie('login', '', -1, '/');
        }
    }

    /**
     * @param string $userLogin
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function loginUser(string $userLogin, string $password, bool $remember = false): bool
    {
        if ($this->emailLogin) {
            $query = "SELECT *
                      FROM emvc_users
                      WHERE email = {$this->db->cleanSQL($userLogin)}
                        OR username = {$this->db->cleanSQL($userLogin)}";
        } else {
            $query = "SELECT *
                      FROM emvc_users
                      WHERE username = {$this->db->cleanSQL($userLogin)}";
        }
        $this->db->query($query);
        if ($this->db->rows != 0) {
            $this->db->fetch(0);
            $sha256Password = hash('sha256', $password . $this->db->data['salt']);
            if ($sha256Password == $this->db->data['password']) {
                setcookie('login', $userLogin, time() + (30 * 24 * 3600), '/');
                if ($remember === true) {
                    $this->data['remember_me'] = $this->text->randomText(40);
                    $this->data['remember_me_ip'] = $this->getIP();
                    $this->updateUser($userLogin);
                    setcookie('remember_me', $this->data['remember_me'], time() + (30 * 24 * 3600), '/');
                } else {
                    $_SESSION['password'] = $sha256Password;
                    $_SESSION['IP'] = $this->getIP();
                }
                $this->setData();
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
        if (isset($_COOKIE['login'])) $userLogin = $_COOKIE['login']; else $userLogin = '';
        if (isset($_COOKIE['remember_me'])) {
            $password = $_COOKIE['remember_me'];
            $remember = true;
        } elseif (isset($_SESSION['password']) && isset($_SESSION['IP'])) {
            $password = $_SESSION['password'];
            $IP = $_SESSION['IP'];
        }
        if ($userLogin != '' && $password != '') {
            if ($this->emailLogin) {
                $query = "SELECT *
                          FROM emvc_users
                          WHERE email = {$this->db->cleanSQL($userLogin)}
                            OR username = {$this->db->cleanSQL($userLogin)}";
            } else {
                $query = "SELECT *
                          FROM emvc_users
                          WHERE username = {$this->db->cleanSQL($userLogin)}";
            }
            $this->db->query($query);
            if ($this->db->rows != 0) {
                $this->db->fetch(0);
                if ($password == ($remember) ? $this->db->data['remember_me'] : $this->db->data['password']) {
                    if ($remember) $IP = $this->db->data['remember_me_ip'];
                    if ($IP == $this->getIP()) {
                        $this->setData();
                        return true;
                    } else {
                        $this->data = [];
                        $this->logoutUser(true);
                        ?>
                        <script type="text/javascript">
                            alert('You have been logged out by the system and need to login again.');
                        </script>
                        <?php
                        return false;
                    }
                } else {
                    $this->data = [];
                    return false;
                }
            } else {
                $this->data = [];
                return false;
            }
        } else {
            $this->data = [];
            return false;
        }
    }

    /**
     * @return bool
     */
    public function insertUser(): bool
    {
        $nameField = [];
        if (!isset($this->data['username'])) $this->data['username'] = 'Not Used';
        if (!isset($this->data['email'])) $this->data['email'] = 'No Email Address';
        $this->data['salt'] = $this->text->randomText(20);
        $this->data['remember_me'] = '';
        $this->data['remember_me_ip'] = '';

        if ($this->emailLogin) {
            $query = "SELECT id
                      FROM emvc_users
                      WHERE email = {$this->db->cleanSQL($this->data['email'])}";
        } else {
            $query = "SELECT id
                      FROM emvc_users
                      WHERE username = {$this->db->cleanSQL($this->data['username'])}";
        }
        $this->db->query($query);
        if ($this->db->rows != 0) {
            $this->errorCode = 9;
            return false;
        }

        $query = "SELECT COLUMN_NAME as 'field'
                  FROM INFORMATION_SCHEMA.COLUMNS
                  WHERE TABLE_NAME = 'emvc_users'
                    AND TABLE_SCHEMA = 'sc_sven'";
        $this->db->query($query);
        $numberOfFields = $this->db->rows;
        for ($x = 0; $x < $numberOfFields; $x++) {
            $this->db->fetch($x);
            $nameField[$x] = $this->db->data['field'];
        }

        $query = "INSERT INTO emvc_users (";
        $query .= $nameField[1];
        for ($x = 2; $x < $numberOfFields; $x++) {
            $query .= ", ";
            $query .= $nameField[$x];
        }
        $query .= ") VALUES (";
        if (!isset($this->data[$nameField[1]])) $this->data[$nameField[1]] = '';
        $query .= $this->db->cleanSQL($this->data[$nameField[1]]);
        for ($x = 2; $x < $numberOfFields; $x++) {
            $query .= ", ";
            if ($nameField[$x] == 'password') {
                $password = hash('sha256', $this->data['password'] . $this->data['salt']);
                $query .= $this->db->cleanSQL($password);
            } else {
                if (!isset($this->data[$nameField[$x]])) $this->data[$nameField[$x]] = '';
                $query .= $this->db->cleanSQL($this->data[$nameField[$x]]);
            }
        }
        $query .= ")";

        $this->db->insert($query);
        if ($this->emailLogin) {
            $loginResult = $this->loginUser($this->data['email'], $this->data['password']);
        } else {
            $loginResult = $this->loginUser($this->data['username'], $this->data['password']);
        }
        if ($loginResult) {
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
        if ($user != '') $userLogin = $user;
        elseif (isset($_COOKIE['login']) && $user == '') $userLogin = $_COOKIE['login'];
        else return false;
        $query = "UPDATE emvc_users SET ";
        foreach ($this->data as $key => $value) {
            if ($key != 'id') {
                $query .= "{$key} = {$this->db->cleanSQL($value)}, ";
            }
        }
        $query = substr($query, 0, -2);
        if ($this->emailLogin) {
            $query .= " WHERE email = {$this->db->cleanSQL($userLogin)}";
        } else {
            $query .= " WHERE username = {$this->db->cleanSQL($userLogin)}";
        }
        $this->db->update($query);
        return true;
    }

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword(string $oldPassword, string $newPassword): bool {
        $sha256Password = hash('sha256', $oldPassword . $this->db->data['salt']);
        if ($this->data['password'] == $sha256Password) {
            $this->data['salt'] = $this->text->randomText(20);
            $this->data['password'] = hash('sha256', $newPassword . $this->data['salt']);
            $this->updateUser($this->data['username']);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $login
     * @return mixed
     */
    public function resetPassword(string $login): mixed
    {
        if ($this->emailLogin) {
            $query = "SELECT *
                  FROM emvc_users
                  WHERE Email = {$this->db->cleanSQL($login)}";
        } else {
            $query = "SELECT *
                      FROM emvc_uers
                      WHERE username = {$this->db->cleanSQL($login)}";
        }
        $this->db->queryRow($query);
        if ($this->db->rows == 0) return false;
        $this->setData();
        $output = $this->data['remember_me'] = $this->text->randomText(15);
        $this->updateUser($login);
        $this->logoutUser();
        return $output;
    }

    /**
     * @param string $remember_me
     * @param string $password
     */
    public function createNewPassword(string $remember_me, string $password): void
    {
        $query = "SELECT *
                  FROM emvc_users
                  WHERE remember_me = {$this->db->cleanSQL($remember_me)}";
        $this->db->queryRow($query);
        $this->setData();
        $this->data['salt'] = $this->text->randomText(20);
        $this->data['password'] = hash('sha256', $password . $this->data['salt']);
        $this->data['remember_me'] = '';
        if ($this->emailLogin) {
            $this->updateUser($this->data['email']);
        } else {
            $this->updateUser($this->data['username']);
        }
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
        if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}:[0-9]*/', $IP)) {
            $temp = explode(':', $IP);
            $IP = $temp[0];
        }
        return $IP;
    }

    /**
     * Transform clean SQL data to normal data
     */
    private function setData(): void
    {
        foreach ($this->db->data as $key => $value) {
            $this->data[$key] = $value;
        }
    }
}

/** End of File: Login.php **/