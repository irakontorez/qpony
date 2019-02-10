<?php

namespace App\Service;


class SequenceCalculatorService
{
    /** @var array  */
    protected $results = [];

    public function calculateMaxValues(array $lengths): array
    {
        $result = [];
        foreach ($lengths as $n) {
            $result[] = [
                'length' => $n,
                'maxValue' => $this->calculateMaxValue((int) $n),
            ];
        }

        return $result;
    }

    public function calculateMaxValue(int $n): int
    {
        $this->calculateRow($n);
        return $this->getMaxValue();
    }

    protected function calculateRow(int $n): void
    {
        $this->resetResults();
        for ($i = 1; $i <= $n; $i++) {
            $this->calculate($i);
        }
    }

    protected function getMaxValue(): int
    {
        return max($this->results);
    }

    protected function calculate(int $n): int
    {
        if ($n < 1) {
            throw new Exception('n must be more then 0');
        }
        if (!empty($this->results[$n])) {
            return $this->results[$n];
        }
        if (1 === $n) {
            $this->results[$n] = 1;
            return $this->results[$n];
        }
        if ($n % 2 === 0) {
            $this->results[$n] = $this->calculate($n/2);
            return $this->results[$n];
        }
        $this->results[$n] = $this->calculate(($n - 1)/2) + $this->calculate(($n - 1)/2 + 1);
        return $this->results[$n];
    }

    protected function resetResults(): void
    {
        $this->results = [];
    }
}