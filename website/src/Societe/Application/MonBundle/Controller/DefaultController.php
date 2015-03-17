<?php

namespace Societe\Application\MonBundle\Controller;

use Societe\Application\MonBundle\Service\FormationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Class DefaultController
 * @package Societe\Application\MonBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     * @param $name
     * @return array
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @return FormationService
     */
    private  function  getFormationService() {
        return $this->container->get("monbundle.serviceFormation");
    }

    /**
     * @Route("/formation/{id}")
     * @Template()
     * @param $id
     * @return array
     */
    public function formationAction($id) {
        return array('formation' => $this->getFormationService()->getFormation($id));

    }

}
