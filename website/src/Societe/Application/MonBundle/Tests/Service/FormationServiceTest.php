<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 19/03/15
 * Time: 10:06
 */

namespace Societe\Application\MonBundle\Tests\Service;

use Societe\Application\MonBundle\Service\FormationService;
use Societe\Application\MonBundle\Tests\AbstractServiceTest;


class FormationServiceTest extends AbstractServiceTest {


    /**
     * @var FormationService
     */
    private $service;

    public function setUp() {
        parent::setUp();
        $this->service = $this->container->get('monbundle.serviceFormation');
    }

    public function testService() {
        $formation = $this->service->getFormation(1);
        $this->assertFalse(empty($formation->getId()));
    }
}