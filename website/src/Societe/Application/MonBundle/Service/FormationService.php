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
     * @param integer $id
     * @return Formation
     */
    public function getFormation($id){
        $repositoryFormation = $this->em->getRepository('Societe\Application\MonBundle\Entity\Formation');
        $formation = $repositoryFormation->findOneBy(array("id"=>$id));
        if (!empty($formation)) {
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
        return new Formation(1, "TATA", new Salle(1, "TUTU", true));
    }

}