<?php

namespace Marie\LouvresBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class reservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberofticket', IntegerType::class)
            ->add('code',TextType::class)
            ->add('date', DateType::class, array(
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                ))
            ->add('price',TextType::class)
            ->add('name',TextType::class)
            ->add('email',TextType::class)
            ->add('payment',TextType::class)
            ->add('ticket',TextType::class)
            ->add('description',ChoiceType::class, array ('choices'=>array('day ticket','half day ticket')))
            ->add('save',SubmitType::class)

            ;
    }

    /**
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
