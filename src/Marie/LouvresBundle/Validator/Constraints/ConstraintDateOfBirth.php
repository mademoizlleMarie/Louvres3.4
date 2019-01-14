<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ConstraintDateOfBirth extends Constraint
{
    public $message = 'La date de naissance est érronée.';
}