<?php

namespace App\Service;


class SequenceValidationService
{
    public function validate(array $sequenceLengths): array
    {
        $result = ['isValid' => true, 'errorMessage' => ''];
        $amount = \count($sequenceLengths);
        if ($amount < 1 || $amount > 10) {
            $result['isValid'] = false;
            $result['errorMessage'] = 'Ilość test case-ów musi być od 1 do 10.';

            return $result;
        }
        foreach ($sequenceLengths as $sequenceLength) {
            $sequenceLengthInt = filter_var($sequenceLength, FILTER_VALIDATE_INT);
            if (false === $sequenceLengthInt) {
                $result['isValid'] = false;
                $result['errorMessage'] = 'Test case musi być liczbą całkowitą.';

                return $result;
            }
            if ($sequenceLengthInt < 1 || $sequenceLengthInt >= 100000) {
                $result['isValid'] = false;
                $result['errorMessage'] = 'Test case musi być liczbą całkowitą (1 ≤ n ≤ 99 999).';

                return $result;
            }
        }

        return $result;
    }
}