<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;
use Pay\PaymentBundle\Entity\Payment\Payment;

class ResponseHashTestService extends ContainerAware
{

    /**
     * 
     * @param array $request
     * @param type $response
     */
    public function hashTest($request, $response)
    {
        $this->saveRequest($request, 'hash');
        $request[$response->getSecretKey()] = $response->getPaySystem()->getPayAccSecretKey();

        $fieldOrder = unserialize($response->getPaySystem()->getFieldOrder());
        
        $str = '';
        for ($i = 0; $i < count($fieldOrder); $i++) {
            foreach ($request as $key => $value) {
                if ($key == $fieldOrder[$i]) {
                    if($response->getAmount()==$key)
                    {
                        $value = number_format($value,2);
                    }
                    $str = $str . $value;
                }
            }
        }
        return $request[$response->getHash()] == strtoupper(md5($str)) ? true : false;
    }
    
    /**
     * 
     * @param type $request
     * @param type $data
     */
    public function saveRequest($request, $data){
        $payment = new Payment;
        $payment->setFieldOrder(serialize($request));
        $payment->setPaysystem($data);
        $payment->setPayAccId('test');
        $payment->setPayAccSecretKey('test');
        $payment->setMethodRequestData('test');
        $payment->setCurrency('test');
        $this->em->persist($payment);
        $this->em->flush();
    }

}