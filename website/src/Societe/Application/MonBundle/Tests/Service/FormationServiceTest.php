<?php
/**
 * Created by PhpStorm.
 * User: dsi
 * Date: 19/03/15
 * Time: 10:10
 */

namespace Societe\Application\MonBundle\Tests\Service;




use Societe\Application\MonBundle\Service\FormationService;
use Societe\Application\MonBundle\Tests\AbstractServiceTest;

class FormationServiceTest extends AbstractServiceTest {

    /**
     * @var FormationService
     */
    private $serviceFormation;

    /**
     * Intialisation de données et container
     */
    public function setUp()
    {
        parent::setUp();
        $this->serviceFormation = $this->container->get('serviceFormation');
    }

    public function testGetFormation() {
        $form = $this->serviceFormation->getFormation(1);
        $this->assertEquals($form->getName(), "TATA");

    }
}