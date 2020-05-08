<?php

namespace App\DataFixtures;

use App\Entity\Apprenti;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<20; $i++) {
            $apprenti = new Apprenti();
            $apprenti->setNom('Apprenti' . $i);
            $apprenti->setPrenom('Prénom' . $i);
            $apprenti->setdateNaissance(new \DateTime('today'));
            $apprenti->setEmail('apprenti' . $i . 'prenom' . $i . '@gmail.com');
            $apprenti->setTelephone('0601020304');

            $manager->persist($apprenti);
        }

        $manager->flush();
    }
}
