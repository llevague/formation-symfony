<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 16/03/15
 * Time: 14:19
 */

namespace Societe\Application\MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Formation
 * @package Societe\Application\MonBundle\Entity
 *
 * @ORM\Entity
 */
class Formation
{

    /**
     * @var string
     *
     *@ORM\Column(name="nom", type="string", length=100, nullable=true)
     *
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var Salle
     *
     * @ORM\ManyToOne(targetEntity="Salle")
     * @ORM\JoinColumn(nullable=true)
     */
    private $salleAffectee;

    function __construct($id, $name, $salleAffectee)
    {
        $this->name = $name;
        $this->id = $id;
        $this->salleAffectee = $salleAffectee;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Salle
     */
    public function getSalleAffectee()
    {
        return $this->salleAffectee;
    }

    /**
     * @param Salle $salleAffectee
     */
    public function setSalleAffectee($salleAffectee)
    {
        $this->salleAffectee = $salleAffectee;
    }
}
