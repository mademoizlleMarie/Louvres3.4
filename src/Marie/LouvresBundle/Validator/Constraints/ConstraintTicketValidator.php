<?php

namespace Marie\LouvresBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintTicketValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheté à une date antérieur à aujourd'hui
    public function validate($date, Constraint $constraint)
    {
        $todayMidnight = strtotime('today midnight');

        if (!$date instanceof \DateTime){
            $date = new \DateTime($date);
        }

        $currentTime = $date->getTimestamp();
        if ($currentTime < $todayMidnight) {
            $this->context->addViolation($constraint->message);
        }
    }
}