<?php

namespace Marie\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class reservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('tickets', CollectionType::class,
               array(
                   'entry_type' => ticketType::class,
                   'allow_add'=> true,
                   'allow_delete' => true
               ))
           ->add('code',IntegerType::class )
          # ->add('numberofticket',IntegerType::class )

          /* ->add('date',DateType::class,
               array(
                   'widget'=> 'single_text',
                   'format' => 'dd-MM-yyyy',
                   'html5' => false,
                   'attr' => ['class' => 'js-datepicker']
               ))
*/
           ->add('price',MoneyType::class)
           #>add('name',TextType::class)
           #->add('email',EmailType::class)
           ->add('payment',TextType::class)
           ->add('save',SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Marie\LouvresBundle\Entity\reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'marie_louvresbundle_reservation';
    }


}
