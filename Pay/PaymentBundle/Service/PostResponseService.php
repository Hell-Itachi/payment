<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class PostResponseService extends ContainerAware
{

    /**
     * 
     * @param type $request
     * @param type $response
     * @return type
     */
    public function getParam($request, $response)
    {        
        $data = array();
        $data['Transactionid'] = $request[$response->getTransactionid()];
        if(!is_null($response->getAmount())){
        $data['Amount']= !empty($request[$response->getAmount()])?$request[$response->getAmount()]:null;}
        else 
            $data['Amount']=0;
        if(!is_null($response->getCurrency()))
            $data['Currency'] = $request[$response->getCurrency()];
        else 
            $data['Currency']=$response->getPaySystem()->getCurrency();
        $data['sendId'] = $request[$response->getSendid()];
        $data['Date'] = $request[$response->getDate()];
        $data['payAccountId'] = $request[$response->getPayAccountId()];
        $data['payerPurse'] = $request[$response->getPayerPurse()];
        
        return $data;
    }

}