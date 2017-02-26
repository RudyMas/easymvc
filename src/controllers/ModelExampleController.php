<?php
namespace Controller;

use Library\Controller;
use Model\User;
use Model\UserRepository;

class ModelExampleController extends Controller
{
    public function modelAction()
    {
        $users = new UserRepository();

        $users->add(new User('Rudy', 'Mas', '+32-12-345678', 'rudy.mas@rudymas.be'));
        $users->add(new User('Other', 'Person', '+32-488-123456', 'other.person@rudymas.be'));

        print('<pre>');
        print_r($users->getAll());
        print('</pre>');

        foreach ($users->getAll() as $user) {
                print("Voornaam: {$user->getFirstname()}<br>");
        }

        print('<br>');
        print($users->getAtIndex(0)->getFirstname().'<br>');
        print($users->getAtIndex(1)->getFirstname().'<br>');
        print($users->getAtIndex(2)->getFirstname().'<br>');
    }
}