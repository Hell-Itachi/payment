<?php

namespace Pay\PaymentBundle\Controller\Payment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PaymentOperationController extends Controller
{

    /**
     * @Route("/createPayment/{id}/{send_id}")
     * @Template("PayPaymentBundle:Payment\PaymentOperation:createPayment.html.twig")
     */
    public function CreatePaymentAction($id, $send_id)
    {
        $createPost = $this->get('pay.create.post.service');
        $params = $createPost->CreateArrayParam($id, $send_id);

        $form = $this->createPaymentForm($params['params']);

        return array(
            'form' => $form->createView(),
            'url' => $params['url']
        );
    }

    /**
     * 
     * @param type $params
     * @return type
     */
    private function createPaymentForm($params)
    {
        $form = $this->get('form.factory')->createNamedBuilder(null, 'form', $params);
        foreach ($params as $key => $value) {
            if ($key != "")
                $form->add($key, 'hidden');
        }

        return $form->getForm();
    }

    /**
     * 
     * @Route("/paymentResponse/{id}", name="payment_response")
     * @Template("PayPaymentBundle:Payment\PaymentOperation:response.html.twig") 
     * 
     */
    public function paymentResponseAction(Request $request, $id)
    {
        //Cyщность Payment
        echo "<pre>";
        print_r($request);
        echo "</pre>";
        $payment = $this->get('doctrine')
                ->getRepository('PayPaymentBundle:Payment\Payment')
                ->find($id);

        $createPost = $this->get($payment->getMethodRequestData() . '.response.service');
        $data = $createPost->getParam($request, $payment->getId());

        $pd = $this->get('pd.create.payment.service');
        $newPd = $pd->CreatePayPd($data);
        $pd->CreateTrans($newPd['Sendid']);

        return array(
            'format' => "",
            'id' => $id
        );
    }

    /**
     * 
     * @Route("/errorResponse/{id}", name="error_response")
     * @Template("PayPaymentBundle:Payment\PaymentOperation:error.html.twig") 
     * 
     */
    public function errorResponseAction(Request $request, $id)
    {
//        $request = array(
//            "LMI_PAYMENT_NO" => "1",
//            "LMI_SYS_INVS_NO" => "R346363633634",
//            "LMI_SYS_TRANS_NO" => "",
//            "LMI_SYS_TRANS_DATE" => "",
//            "FIELD_1" => "VALUE_1",
//            "FIELD_2" => "VALUE_2"
//            );
        $request = $request->request;
        echo "<pre>";
        print_r($request);
        echo "</pre>";
        $payment = $this->get('doctrine')
                ->getRepository('PayPaymentBundle:Payment\Payment')
                ->find($id);

        $createPost = $this->get($payment->getMethodRequestData() . '.response.service');
        $data = $createPost->getParam($request, $payment->getId());
        $pd = $this->get('pd.create.payment.service');
        $newPd = $pd->CreatePayPd($data);

        return array(
            'newPdId' => $newPd['pdId'],
            'id' => $id
        );
    }

}
