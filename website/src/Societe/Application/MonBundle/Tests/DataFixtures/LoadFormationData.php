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
use Societe\Application\MonBundle\Entity\Formation;
use Societe\Application\MonBundle\Entity\Salle;

/**
 * Class LoadFormationData
 * @package Societe\Application\MonBundle\Tests\DataFixtures
 */
class LoadFormationData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $salle = $this->getReference('salle1');

        $formation = new Formation();
        $formation->setId(1);
        $formation->setName("Formation 1");
        $formation->setSalleAffectee($salle);
        $manager->persist($formation);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }

}