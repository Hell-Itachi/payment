<?php

namespace Pay\PaymentBundle\Entity\PdPayment;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Pay\PaymentBundle\Entity\PdChildPayBundle;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PdPayment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PdPayment extends PdChildPayBundle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Itc\DocumentsBundle\Entity\Pd\Pd", inversedBy="id")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parentPd;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=5)
     */
    private $currency;


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
     * Set parentId
     *
     * @param integer $parentId
     * @return PdPayment
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set payer
     *
     * @param string $currency
     * @return PdPayment
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->payer;
    }
    
    /**
     * 
     * @return type
     */
    public function getParentPd()
    {
        return $this->parentPd;
    }

    /**
     * 
     * @param type $parentPd
     */
    public function setParentPd($parentPd)
    {
        $this->parentPd = $parentPd;
    }
    
    public function createPdData()
    {
        $this->setDtcor( new \DateTime() );
        $pu = new \Itc\DocumentsBundle\Lib\PreUpdate();
        $this->setUcor( $pu->getUcorId() );
        $this->oldstatus = $this->status;
    } 
}
