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
            ->add('transactionId')
            ->add('amount')
            ->add('currency')
            ->add('sendId')
            ->add('date')
            ->add('paySystem')
            ->add('payAccountId')
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
