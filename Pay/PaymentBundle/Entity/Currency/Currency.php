<?php

namespace Pay\PaymentBundle\Entity\Currency;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Currency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", length=5)
     */
    private $abbreviation;

    /**
     *
     * @var float 
     * 
     * @ORM\Column(name="currency_ratio", type="float")
     */
    private $currencyRatio;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="dafault", type="boolean",  nullable=true)
     */
    private $dafault;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set abbreviation
     *
     * @param string $abbreviation
     * @return Currency
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string 
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set dafault
     *
     * @param boolean $dafault
     * @return Currency
     */
    public function setDafault($dafault)
    {
        $this->dafault = $dafault;

        return $this;
    }

    /**
     * Get dafault
     *
     * @return boolean 
     */
    public function getDafault()
    {
        return $this->dafault;
    }
    
    /**
     * 
     * @return type
     */
    public function getCurrencyRatio()
    {
        return $this->currencyRatio;
    }

    /**
     * 
     * @param type $currencyRatio
     */
    public function setCurrencyRatio($currencyRatio)
    {
        $this->currencyRatio = $currencyRatio;
    }

}
