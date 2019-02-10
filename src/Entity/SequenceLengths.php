<?php

namespace App\Entity;

use App\Validator\Constraints as AcmeAssert;

class SequenceLengths
{
    /**
     * @var string
     * @AcmeAssert\SequenceLengths
     */
    private $lengths;

    /**
     * @return null|string
     */
    public function getLengths(): ?string
    {
        return $this->lengths;
    }

    /**
     * @param null|string $lengths
     */
    public function setLengths(?string $lengths): void
    {
        $this->lengths = $lengths;
    }

}