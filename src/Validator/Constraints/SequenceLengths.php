<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SequenceLengths extends Constraint
{
    public $message = '';
}