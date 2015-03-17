<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 16/03/15
 * Time: 16:43
 */

namespace Societe\Application\MonBundle\repository;


use Doctrine\ORM\EntityRepository;

class SalleRepository extends  EntityRepository {

    public function getSalleDisponible() {

        $query = $this->_em->createQuery('
        SELECT s
        FROM SocieteApplicationMonBundle:Salle s
        WHERE s.disponible=true
        ');

        return $query->getSingleResult();
    }
}