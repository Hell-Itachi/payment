<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;
use Pay\PaymentBundle\Entity\PdPayment\PdPayment;
use Itc\DocumentsBundle\Entity\Pd\Trans;
class PdCreatePaymentService extends ContainerAware
{

    /**
     * 
     * @param type $data
     * @return type
     */
    public function CreatePayPd($data)
    {
        $newPd = new PdPayment();
        $trans = new Trans();
        
        $pd_parent = $this->em
                ->getRepository('ItcDocumentsBundle:PdOrder\PdOrder')
                ->find($data['sendId']);
        
        $dql = "SELECT SUM(e.summa) AS balance FROM ItcDocumentsBundle:Pd\Trans e " .
       "WHERE e.pdid = ?1";
        $allTrans = $this->em->createQuery($dql)
              ->setParameter(1, $pd_parent->getId())
              ->getSingleScalarResult();
        
        
        $newPd->setParentPd($pd_parent);
        $newPd->setSumma1($data['Amount']);
        $newPd->setTxt1($data['payerPurse']);
        $newPd->setN($data['Transactionid']);
        $newPd->setTxt2($data['payAccountId']);
        $newPd->setCurrency($data['Currency']);
        $newPd->setDate(new \DateTime($data['Date']));
        $newPd->setStatus(1);
        $this->em->persist($newPd);
        
        $trans->setPd($pd_parent);
        $trans->setSumma($data['Amount']);
        $this->em->persist($trans);
        if(($allTrans+$data['Amount']) >= ($pd_parent->getSumma1()))
        {
            $pd_parent->setStatus(2);
            $this->em->persist($pd_parent);
        }
        $this->em->flush();
        
        $id=$newPd->getId();
        return array(
            'pdId' => $id, 
            'sendId' => $data['sendId']);
    }
    

}