<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintDateOfBirthValidator extends ConstraintValidator
{

    public function validate($date, Constraint $constraint)
    {
        $todayMidnight = strtotime('today midnight');

        if (!$date instanceof \DateTime){
            $date = new \DateTime($date);
        }

        $currentTime = $date->getTimestamp();
        if ($todayMidnight < $currentTime ) {
            $this->context->addViolation($constraint->message);
        }
    }
}