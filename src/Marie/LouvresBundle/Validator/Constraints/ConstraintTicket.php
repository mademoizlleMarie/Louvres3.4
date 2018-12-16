<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ConstraintTicket extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet sur une date antérieur.';
}