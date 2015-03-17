<?php


namespace Societe\Application\MonBundle\Service;


use Societe\Application\MonBundle\Entity\Salle;
use Societe\Application\MonBundle\repository\SalleRepository;

class SalleService {

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var SalleRepository
     */
    private $salleRepository;

    /**
     * Constructeur
     * @param EntityManager $em
     */
    function __construct($em)
    {
        $this->em = $em;
        $this->salleRepository = $em->getRepository('Societe\Application\MonBundle\Entity\Salle');
    }

    /**
     * @return Salle
     */
    public function getSalleDisponible() {
        return $this->salleRepository->getSalleDisponible();
    }
}