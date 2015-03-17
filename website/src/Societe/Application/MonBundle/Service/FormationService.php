<?php


namespace Societe\Application\MonBundle\Service;


use Doctrine\ORM\EntityManager;
use Societe\Application\MonBundle\Entity\Formation;
use Societe\Application\MonBundle\Entity\Salle;

class FormationService {

    /**
     * @var SalleService
     */
    private $salleService;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     * @param SalleService $salleService
     */
    function __construct($em, $salleService)
    {
        $this->salleService = $salleService;
        $this->em = $em;
    }


    /**
     * @return string
     */
    public function getName(){
        return 'Formation';
    }

    /**
     * @return Formation
     */
    public function getFormation($id){
        $repositoryFormation = $this->em->getRepository('Societe\Application\MonBundle\Entity\Formation');
        $formation = $repositoryFormation->findOneBy(array("id"=>$id));
        $tmp = $formation->getSalleAffectee();
        if (empty($tmp)) {
            /** @var Salle $salle */
            $salle = $this->salleService->getSalleDisponible();
            $formation->setSalleAffectee($salle);
            $formation->getSalleAffectee()->setDisponible(false);
            $this->em->persist($formation);
            $this->em->flush();
        }
        return $formation;
    }

}