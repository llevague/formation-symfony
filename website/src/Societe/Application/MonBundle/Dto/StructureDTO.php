<?php
namespace Societe\Application\MonBundle\Dto;

class StructureDTO {
    /**
     * @var string
     */
    private $codeStructure;
    /**
     * @var string
     */
    private $llStructure;

    function __construct($codeStructure, $llStructure)
    {
        $this->codeStructure = $codeStructure;
        $this->llStructure = $llStructure;
    }

    /**
     * @return string
     */
    public function getCodeStructure()
    {
        return $this->codeStructure;
    }

    /**
     * @return string
     */
    public function getLlStructure()
    {
        return $this->llStructure;
    }

}