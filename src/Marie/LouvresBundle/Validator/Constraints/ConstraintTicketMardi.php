<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ConstraintTicketMardi extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet pour un mardi.';
}