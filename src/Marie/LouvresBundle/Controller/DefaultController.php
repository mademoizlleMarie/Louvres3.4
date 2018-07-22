<?php

namespace Marie\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Marie\LouvresBundle\Entity\ticket;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        // On crée un objet Advert
        $ticket = new ticket();

        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $ticket);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('name',            TextType::class)
            ->add('firstname',       TextType::class)
            ->add('dateofbirth',     DateType::class)
            ->add('reduced',         CheckboxType::class)
            ->add('description',     ChoiceType::class, array('choices' => array('day ticket' => true, 'half dat ticket' => false)))

        ;
        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('@MarieLouvres/Default/accueil.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservationAction()
    {
        return $this->render('@MarieLouvres/Default/reservation.html.twig');
    }
    /**
     * @Route("/paiement", name="paiement")
     */
    public function paiementAction()
    {
        return $this->render('@MarieLouvres/Default/paiement.html.twig');
    }
}