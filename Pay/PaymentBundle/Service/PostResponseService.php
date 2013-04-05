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
        $hashTest = $this->container->get('response.hash.test.service');
        $hashTest->saveRequest($request, 'getparam');
        $data = array();
        $data['Transactionid'] = $request[$response->getTransactionid()];
        if (!is_null($response->getAmount())) {
            $data['Amount'] = !empty($request[$response->getAmount()]) ? $request[$response->getAmount()] : null;
        }
        else
            $data['Amount'] = 0;
        if (is_null($response->getCurrency()) or $response->getCurrency()=='') {
            $data['Currency'] = $response->getPaySystem()->getCurrency();
        } else {
            $data['Currency'] = $request[$response->getCurrency()];
        }
        $data['sendId'] = $request[$response->getSendid()];
        $data['Date'] = $request[$response->getDate()];
        $data['payAccountId'] = $request[$response->getPayAccountId()];
        $data['payerPurse'] = $request[$response->getPayerPurse()];

        return $data;
    }

}