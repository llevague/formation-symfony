<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 17/03/15
 * Time: 14:42
 */

namespace Societe\Application\MonBundle\Tests\DataFixtures;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Societe\Application\MonBundle\Entity\Salle;

/**
 * Class LoadSalleData
 * @package Societe\Application\MonBundle\Tests\DataFixtures
 */
class LoadSalleData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $salle = new Salle();
        $salle->setNom("Salle 1");
        $salle->setDisponible(false);
        $manager->persist($salle);

        $salle = new Salle();
        $salle->setNom("Salle 2");
        $salle->setDisponible(true);
        $manager->persist($salle);
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