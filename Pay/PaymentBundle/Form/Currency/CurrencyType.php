<?php

namespace Pay\PaymentBundle\Form\Currency;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CurrencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abbreviation')
            ->add('currencyRatio')
            ->add('dafault')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pay\PaymentBundle\Entity\Currency\Currency'
        ));
    }

    public function getName()
    {
        return 'pay_paymentbundle_currency_currencytype';
    }
}
