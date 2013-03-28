<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class PostResponseService extends ContainerAware
{

    /**
     * 
     * @param type $request
     * @param type $id
     */
    public function getParam($request, $id)
    {
        
        $response = $this->em
                ->getRepository('PayPaymentBundle:Payment\Response')
                ->findOneBy(array('systemId'=>$id));
        $data = array();
        $data['Transactionid'] = $request[$response->getTransactionid()];
        $data['Amount'] = $request[$response->getAmount()];
        if(!is_null($response->getCurrency()))
        $data['Currency'] = $request[$response->getCurrency()];
        $data['Sendid'] = $request[$response->getSendid()];
        $data['Date'] = $request[$response->getDate()];
        
        return $data;
    }

}