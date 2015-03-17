<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 16/03/15
 * Time: 14:25
 */

namespace Societe\Application\MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Salle
 * @package Societe\Application\MonBundle\Entity
 *
 *@ORM\Entity(repositoryClass="Societe\Application\MonBundle\repository\SalleRepository")
 */
class Salle
{

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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean", nullable=true)
     */
    private $disponible;


    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return boolean
     */
    public function isDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param boolean $disponible
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }
}
