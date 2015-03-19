<?php

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Societe\Application\MonBundle\Entity\Formation;
use Societe\Application\MonBundle\Entity\Salle;

class LoadFormation extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $salleAffectee = new Salle(1, "TUTU", true);
        $manager->persist($salleAffectee);
        $manager->persist(new Formation(1, "TATA", $salleAffectee));
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}