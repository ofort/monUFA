<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0; $i<20; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom('entreprise'.$i);
            $entreprise->setAdresse1($i.', Rue des Alouettes');
            if($i<10){
                $entreprise->setCodepostal('5900'.$i);
            }
            else{
                $entreprise->setCodepostal('590'.$i);
            }
            $entreprise->setVille('Valenciennes');

            $manager->persist($entreprise);

        }
        $manager->flush();
    }
}
