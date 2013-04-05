<?php

namespace Pay\PaymentBundle\Service;

use Itc\AdminBundle\Listener\ContainerAware;

class CreatePostService extends ContainerAware
{

    /**
     * @param integer $id
     * @param integer $send_id
     */
    public function CreateArrayParam($id, $send_id)
    {
        $params = array();
        //запрос что бы вытащить по $id из Cистем Оплаты.
        $payment = $this->em
                        ->getRepository('PayPaymentBundle:Payment\Payment')->find($id);
        //запрос что бы вытащить по $id из Pd.
        $pd = $this->em
                        ->getRepository('ItcDocumentsBundle:PdOrder\PdOrder')->find($send_id);

        $params = array(
            $payment->getOwner() => $payment->getPayAccId(),
            $payment->getSumma() => $pd->getSumma1(),
            //$payment->getCurrency() => $payment->getPurseCurrency(),
            $payment->getSendId() => $send_id,
            $payment->getToken() => $payment->getPayAccId(),
            $payment->getDescription() => ""
            , "LMI_SIM_MODE" => 0
        );

        return array(
            'params' => $params,
            'url' => $payment->getPaysystem()
        );
    }

}