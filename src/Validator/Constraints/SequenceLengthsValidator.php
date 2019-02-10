<?php

namespace App\Validator\Constraints;

use App\Helper\StringHelper;
use App\Service\SequenceValidationService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SequenceLengthsValidator extends ConstraintValidator
{
    /**
     * @var SequenceValidationService
     */
    private $sequenceValidationService;
    /**
     * @var StringHelper
     */
    private $stringHelper;

    public function __construct(SequenceValidationService $sequenceValidationService, StringHelper $stringHelper)
    {
        $this->sequenceValidationService = $sequenceValidationService;
        $this->stringHelper = $stringHelper;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof SequenceLengths) {
            throw new UnexpectedTypeException($constraint, SequenceLengths::class);
        }
        $validationResult = $this->sequenceValidationService->validate($this->stringHelper->explodeByNewLine($value));
        if (!$validationResult['isValid']) {
            $this->context->buildViolation($validationResult['errorMessage'])->addViolation();
        }
    }
}