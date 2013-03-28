<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;
use Itc\DocumentsBundle\Entity\Pd\Pd;

class PdCreatePaymentService extends ContainerAware
{

    /**
     * 
     * @param type $data
     */
    public function CreatePayPd($data)
    {
        $pd = new Pd();
        
        $pd_parent = $this->em
                ->getRepository('ItcDocumentsBundle:Pd\Pd')
                ->find($data['Sendid']);
        
        $pd->setParent($pd_parent);
        $pd->setSumma1($data['Amount']);
        $pd->setTxt1($data['Date']);
        $pd->setN($data['Transactionid']);
        $pd->setDate(date("Y-m-d H:i:s"));
        $pd->setDtcor(date("Y-m-d H:i:s"));
        $pd->setStatus(1);

        $this->em->persist($pd);
        $this->em->flush();

        $id=$pd->getId();
        $this->CreateTrans($data['Sendid']);
        return $id;
    }

    public function CreateTrans($id)
    {
        $pd = $this->em
                ->getRepository('ItcDocumentsBundle:Pd\Pd')
                ->find($id);

        $pd->setStatus(2);
        $this->em->persist($pd);
        $this->em->flush();

        return true;
    }

}