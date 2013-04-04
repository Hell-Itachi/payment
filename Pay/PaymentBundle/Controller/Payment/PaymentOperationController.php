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
     * @Route("/paymentSuccess/{id}", name="payment_success")
     * @Template("PayPaymentBundle:Payment\PaymentOperation:success.html.twig") 
     * 
     */
    public function paymentSuccessAction(Request $request, $id)
    {
//        $request = array(
//            "LMI_PAYMENT_NO" => "1 "
//            , "LMI_SYS_INVS_NO" => "281 "
//            , "LMI_SYS_TRANS_NO" => "558 "
//            , "LMI_SYS_TRANS_DATE" => "20020314 14:01:14 "
//            , "FIELD_1" => "VALUE_1 "
//            , "FIELD_2" => "VALUE_2 ");
        $request = $request->request->all();
//        $hashTest = $this->get('response.hash.test.service');
//        $hashTest->saveRequest($request, 'success');
        return array(
            'request' => $request,
            'id' => $id
        );
    }

    /**
     * 
     * @Route("/paymentResponse/{id}", name="payment_response")
     * @Template("PayPaymentBundle:Payment\PaymentOperation:response.html.twig") 
     * 
     */
    public function paymentResponseAction(Request $request, $id)
    {
        $request = $request->request->all();


        //Cyщность Payment
        /*
         * "LMI_PAYMENT_AMOUNT" -   Сумма платежа
         * "LMI_PAYEE_PURSE"    -   Кошелек продавца 
         * "LMI_PAYMENT_NO"     -   Внутренний номер покупки продавца
         * "LMI_MODE"           -   Флаг тестового режима 
         *                          0: Платеж выполнялся в реальном режиме
         *                          1: Платеж выполнялся в тестовом режиме
         * "LMI_SYS_INVS_NO"    -   Внутренний номер счета в системе WebMoney Transfer 
         * "LMI_SYS_TRANS_NO"   -   Внутренний номер платежа в системе WebMoney Transfer 
         * "LMI_PAYER_PURSE"    -   Кошелек покупателя 
         * "LMI_PAYER_WM"       -   WMId покупателя 
         * "LMI_SYS_TRANS_DATE" -   Дата и время выполнения платежа 
         * "LMI_HASH"           -   Контрольная подпись 
         */
//        $request = $this->get('doctrine')
//                ->getRepository('PayPaymentBundle:Payment\Payment')
//                ->find(3);
//        echo "<pre>";
//            print_r(unserialize($request->getFieldOrder()));
//        echo "</pre>";
//        die();


        $request = array(
            "LMI_MODE" => 1
            , "LMI_PAYMENT_AMOUNT" => 1.10
            , "LMI_PAYEE_PURSE" => "E145873692104"
            , "LMI_PAYMENT_NO" => 9
            , "LMI_PAYER_WM" => 126461788996
            , "LMI_PAYER_PURSE" => "E630695050815"
            , "LMI_TELEPAT_ORDERID" => 11523821
            , "LMI_TELEPAT_PHONENUMBER" => 380939049313
            , "LMI_SYS_INVS_NO" => 581
            , "LMI_SYS_TRANS_NO" => 605
            , "LMI_SYS_TRANS_DATE" => "20130402 13:52:06"
            , "LMI_HASH" => "7226D179BE6E94148F62D7CA0434695E"
            , "LMI_PAYMENT_DESC" => ""
            , "LMI_LANG" => "ru-RU"
            , "_token" => "49fa1240d6987dacc6518ea3c1cd2839886e15cb");
        /* $request = array(
          "LMI_PAYMENT_AMOUNT" => 1.0
          , "LMI_PAYMENT_NO" => 1
          , "LMI_MODE" => 1
          , "LMI_SYS_INVS_NO" => 281
          , "LMI_SYS_TRANS_NO" => 558
          , "LMI_PAYEE_PURSE" => "R397656178472"
          , "LMI_PAYER_WM" => "809399319852"
          , "LMI_PAYER_PURSE" => "R397656178472"
          , "LMI_SYS_TRANS_DATE" => "20020314 14:01:14"
          , "LMI_HASH" => "4B3A1919939249E7BB30648C3AF79185"
          , "FIELD_1" => "VALUE_1"
          , "FIELD_2" => "VALUE_2"); */
//        echo "<pre>";
//        print_r($request);
//        echo "</pre>";

        $response = $this->get('doctrine')
                ->getRepository('PayPaymentBundle:Payment\Response')
                ->findOneBy(array('systemId' => $id));


        $hashTest = $this->get('response.hash.test.service');
        if ($hashTest->hashTest($request, $response)) {

            $createPost = $this->get($response->getPaySystem()->getMethodRequestData() . '.response.service');
            $data = $createPost->getParam($request, $response);

            $pd = $this->get('pd.create.payment.service');
            $newPd = $pd->createPayPd($data);
            
        }
        return array();
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
        $request = $request->request->all();
        
        return array();
    }

}
