<?php

namespace Controller;

use EasyMVC\Controller\Controller;
use Model\User;
use Repository\UserRepository;

class ModelExampleController extends Controller
{
    public function modelAction(UserRepository $userRepository)
    {
        $users = $userRepository;

        $users->add(new User(1, 'Rudy', 'Mas', '+32-12-345678', 'rudy.mas@rudymas.be'));
        $users->add(new User(2, 'Other', 'Person', '+32-488-123456', 'other.person@rudymas.be'));

        print('<pre>');
        print_r($users->getAll());
        print('</pre>');

        foreach ($users->getAll() as $user) {
            print("Voornaam: {$user->getFirstname()}<br>");
        }

        print('<br>');
        print($users->getByIndex(1)->getFirstname() . ' ' . $users->getByIndex(1)->getLastname() . '<br>');
        print($users->getByIndex(2)->getFirstname() . ' ' . $users->getByIndex(2)->getLastname() . '<br>');
    }

    public function modelAndVariableAction(UserRepository $userRepository, $var)
    {
        $users = $userRepository;

        $users->add(new User(1, 'Rudy', 'Mas', '+32-12-345678', 'rudy.mas@rudymas.be'));
        $users->add(new User(2, 'Other', 'Person', '+32-488-123456', 'other.person@rudymas.be'));

        print('<pre>');
        print_r($users->getAll());
        print('</pre>');

        foreach ($users->getAll() as $user) {
            print("Voornaam: {$user->getFirstname()}<br>");
        }

        print('<br>');
        print($users->getByIndex(1)->getFirstname() . ' ' . $users->getByIndex(1)->getLastname() . '<br>');
        print($users->getByIndex(2)->getFirstname() . ' ' . $users->getByIndex(2)->getLastname() . '<br>');

        print($var['text']);
    }
}

/** End of File: ModelExampleController.php **/