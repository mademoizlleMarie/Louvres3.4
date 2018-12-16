<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ConstraintTicketJourFerie extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet un jour férié.';
}