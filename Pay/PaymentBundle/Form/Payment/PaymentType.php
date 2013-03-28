<?php

namespace Pay\PaymentBundle\Form\Payment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paysystem')
            ->add('payAccId')
            ->add('owner')
            ->add('summa')
            ->add('currency')
            ->add('sendId')
            ->add('token')
            ->add('description')
            ->add('purseCurrency')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pay\PaymentBundle\Entity\Payment\Payment'
        ));
    }

    public function getName()
    {
        return 'pay_paymentbundle_payment_paymenttype';
    }
}
