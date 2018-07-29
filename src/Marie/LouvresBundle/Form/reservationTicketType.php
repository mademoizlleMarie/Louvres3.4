<?php

namespace Marie\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class reservationAccueilType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('code');
        $builder->remove('price');
        $builder->remove('name');
        $builder->remove('email');
        $builder->remove('payment');
        $builder->remove('ticket');
    }

    public function getParent()
    {
        return reservationType::class;
    }
}
