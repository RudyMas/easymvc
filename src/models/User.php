<?php

namespace Model;

class User
{
    private $id;
    private $firstname = '';
    private $lastname = '';
    private $phone = '';
    private $email = '';

    /**
     * User constructor.
     * @param int $id
     * @param string $firstname
     * @param string $lastname
     * @param string $phone
     * @param string $email
     */
    public function __construct(int $id, string $firstname, string $lastname, string $phone, string $email)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * @param array $data
     * @return User
     */
    public static function new(array $data): User
    {
        return new self($data['id'], $data['firstname'], $data['lastname'], $data['phone'], $data['email']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
}

/** End of File: User.php **/