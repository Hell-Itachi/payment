<?php

namespace Pay\PaymentBundle\Form\Payment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('systemId')
            ->add('transactionId')
            ->add('payAccountId')
            ->add('amount')
            ->add('currency')
            ->add('sendId')
            ->add('date')
            ->add('payerPurse')
            ->add('testMode')
            ->add('secretKey')
            ->add('hash')
            ->add('WMIdPayer')
            ->add('WMIdAcc')
            ->add('paySystem')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pay\PaymentBundle\Entity\Payment\Response'
        ));
    }

    public function getName()
    {
        return 'pay_paymentbundle_payment_responsetype';
    }
}
