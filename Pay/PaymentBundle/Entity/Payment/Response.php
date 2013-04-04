<?php

namespace Pay\PaymentBundle\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Pay\PaymentBundle\Entity\Payment\Payment;

/**
 * Response
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pay\PaymentBundle\Entity\Payment\ResponseRepository")
 */
class Response
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
     * @var integer
     *
     * @ORM\Column(name="system_id", type="integer")
     */
    private $systemId;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="string", length=30)
     */
    private $transactionId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pay_acc_id", type="string", length=30)
     */
    private $payAccountId;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="string", length=30)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=30, nullable=true)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="send_id", type="string", length=30)
     */
    private $sendId;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=30)
     */
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="payer_purse", type="string", length=30)
     */
    private $payerPurse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="test_mode", type="string", length=30)
     */
    private $testMode;
        
    /**
     * @var string
     *
     * @ORM\Column(name="secret_key", type="string", length=30)
     */
    private $secretKey;
        
    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=30)
     */
    private $hash;
        
    /**
     * @var string
     *
     * @ORM\Column(name="WM_id_payer", type="string", length=30)
     */
    private $WMIdPayer;
        
    /**
     * @var string
     *
     * @ORM\Column(name="WM_id_acc", type="string", length=30)
     */
    private $WMIdAcc;
    
    /**
     * @ORM\OneToOne(targetEntity="Pay\PaymentBundle\Entity\Payment\Payment")
     * @ORM\JoinColumn(name="system_id", referencedColumnName="id")
     * 
     */
    private $paySystem;
    
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
     * Set systemId
     *
     * @param integer $systemId
     * @return Response
     */
    public function setSystemId($systemId)
    {
        $this->systemId = $systemId;

        return $this;
    }

    /**
     * Get systemId
     *
     * @return integer 
     */
    public function getSystemId()
    {
        return $this->systemId;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     * @return Response
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return Response
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Response
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
     * @param string $sendId
     * @return Response
     */
    public function setSendId($sendId)
    {
        $this->sendId = $sendId;

        return $this;
    }

    /**
     * Get sendId
     *
     * @return string 
     */
    public function getSendId()
    {
        return $this->sendId;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Response
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * 
     * @return type
     */
    public function getPaySystem()
    {
        return $this->paySystem;
    }
    
    /**
     * 
     * @param type $paySystem
     */
    public function setPaySystem($paySystem)
    {
        $this->paySystem = $paySystem;
    }
    
    /**
     * 
     * @return type
     */
    public function getPayAccountId()
    {
        return $this->payAccountId;
    }
    
    /**
     * 
     * @param type $payAccountId
     */
    public function setPayAccountId($payAccountId)
    {
        $this->payAccountId = $payAccountId;
    }

    /**
     * 
     * @return type
     */
    public function getPayerPurse()
    {
        return $this->payerPurse;
    }

    /**
     * 
     * @param type $payerPurse
     */
    public function setPayerPurse($payerPurse)
    {
        $this->payerPurse = $payerPurse;
    }

    /**
     * 
     * @return type
     */
    public function getTestMode()
    {
        return $this->testMode;
    }

    /**
     * 
     * @param type $testMode
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;
    }
    
    /**
     * 
     * @return type
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * 
     * @param type $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }
    
    /**
     * 
     * @return type
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * 
     * @param type $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getWMIdPayer()
    {
        return $this->WMIdPayer;
    }

    public function setWMIdPayer($WMIdPayer)
    {
        $this->WMIdPayer = $WMIdPayer;
    }

    public function getWMIdAcc()
    {
        return $this->WMIdAcc;
    }

    public function setWMIdAcc($WMIdAcc)
    {
        $this->WMIdAcc = $WMIdAcc;
    }




}
