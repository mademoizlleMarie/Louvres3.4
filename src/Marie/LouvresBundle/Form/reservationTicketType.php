<?php

namespace Marie\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class reservationTicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TicketType::class)
            ->add('firstname', ticketType::class)
            ->add('dateofbirth', ticketType::class)
            ->add('reduced', ticketType::class)
            ->add('name', ticketType::class)
            ->add('country', countryType::class)
            ->remove('numberofticket')
            ->remove('code')
            ->remove('date')
            ->remove('price')
            ->remove('name')
            ->remove('email')
            ->remove('payment')
        ;
    }

    public function getParent()
    {
        return reservationType::class;
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'marie_louvresbundle_reservation';
    }


}
