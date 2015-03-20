<?php

namespace Societe\Application\MonBundle\Controller;


use FormationRestController\CustomJson;
use FOS\RestBundle\Controller\FOSRestController;
use Societe\Application\MonBundle\Entity\Formation;
use Societe\Application\MonBundle\Service\FormationService;

use FOS\RestBundle\Controller\Annotations as Rest;

class FormationRestController extends FOSRestController {
    /**
     * @var FormationService
     */
//    private $service;
//
//    function __construct(FormationService $formationService) {
//        $this->service = $formationService;
//        $this->service = $this->container->get("serviceFormation");
//    }

    /**
     * @return FormationService
     */
    public function service() {
        return $this->container->get("serviceFormation");
    }

    /**
     * @param $id
     * @return Formation
     *
     * @Rest\Get("/rest/formation/{id}")
     */
    public function getFormation($id) {
        return $this->handleView($this->view($data = new CustomJson(1, "toto"), $statusCode = 200, $headers = array('Content-Type' => 'application/json')));
//        return $this->service()->getFormation($id);
    }

}

namespace FormationRestController;
class CustomJson {
    public $id;
    public $nom;

    function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

}