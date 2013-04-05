<?php

namespace Pay\PaymentBundle\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pay\PaymentBundle\Entity\Payment\PaymentRepository")
 */
class Payment
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
     * @ORM\Column(name="paysystem", type="string", length=120)
     */
    private $paysystem;

    /**
     * @var integer
     *
     * @ORM\Column(name="pay_acc_id", type="string", length=255)
     */
    private $payAccId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pay_acc_secret_key", type="string", length=255)
     */
    private $payAccSecretKey;
    
    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255, nullable=true)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="summa", type="string", length=255, nullable=true)
     */
    private $summa;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="send_id",  type="string", length=255, nullable=true)
     */
    private $sendId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="purse_currency", type="string", length=10, nullable=true)
     */
    private $purseCurrency;
    
    /**
     *
     * @var string 
     * 
     * @ORM\Column(name="metohod_request_data", type="string", length=50, nullable=true)
     */
    private $methodRequestData;
    
    /**
     *
     * @var text $fieldOrder 
     * 
     * @ORM\Column(name="field_order", type="text")
     */
    private $fieldOrder;
    
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
     * Set paysystem
     *
     * @param string $paysystem
     * @return Payment
     */
    public function setPaysystem($paysystem)
    {
        $this->paysystem = $paysystem;

        return $this;
    }

    /**
     * Get paysystem
     *
     * @return string 
     */
    public function getPaysystem()
    {
        return $this->paysystem;
    }

    /**
     * Set payAccId
     *
     * @param integer $payAccId
     * @return Payment
     */
    public function setPayAccId($payAccId)
    {
        $this->payAccId = $payAccId;

        return $this;
    }

    /**
     * Get payAccId
     *
     * @return integer 
     */
    public function getPayAccId()
    {
        return $this->payAccId;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return Payment
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set summa
     *
     * @param string $summa
     * @return Payment
     */
    public function setSumma($summa)
    {
        $this->summa = $summa;

        return $this;
    }

    /**
     * Get summa
     *
     * @return string 
     */
    public function getSumma()
    {
        return $this->summa;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Payment
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
        return $this->currency;
    }

    /**
     * Set sendId
     *
     * @param integer $sendId
     * @return Payment
     */
    public function setSendId($sendId)
    {
        $this->sendId = $sendId;

        return $this;
    }

    /**
     * Get sendId
     *
     * @return integer 
     */
    public function getSendId()
    {
        return $this->sendId;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Payment
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Payment
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * 
     * @return type
     */
    public function getPurseCurrency()
    {
        return $this->purseCurrency;
    }
    
    /**
     * 
     * @param type $purseCurrency
     */
    public function setPurseCurrency($purseCurrency)
    {
        $this->purseCurrency = $purseCurrency;
    }
        
    /**
     * 
     * @return type
     */
    public function getMethodRequestData()
    {
        return $this->methodRequestData;
    }
    
    /**
     * 
     * @param type $methodRequestData
     */
    public function setMethodRequestData($methodRequestData)
    {
        $this->methodRequestData = $methodRequestData;
    }
    
    /**
     * 
     * @return type
     */
    public function getPayAccSecretKey()
    {
        return $this->payAccSecretKey;
    }

    /**
     * 
     * @param type $payAccSecretKey
     */
    public function setPayAccSecretKey($payAccSecretKey)
    {
        $this->payAccSecretKey = $payAccSecretKey;
    }
    
    /**
     * 
     * @return type
     */
    public function getFieldOrder()
    {
        return $this->fieldOrder;
    }

    /**
     * 
     * @param type $fieldOrder
     */
    public function setFieldOrder($fieldOrder)
    {
        $this->fieldOrder = $fieldOrder;
    }
        
    /**
     * 
     * @return type
     */
    public function __toString()
    {
        return (string)$this->paysystem;
    }
}
