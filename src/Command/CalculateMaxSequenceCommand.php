<?php

namespace App\Command;

use App\Service\SequenceCalculatorService;
use App\Service\SequenceValidationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateMaxSequenceCommand extends Command
{
    /**
     * @var SequenceValidationService
     */
    protected $sequenceValidator;
    /**
     * @var SequenceCalculatorService
     */
    private $sequenceCalculator;

    public function __construct(SequenceValidationService $sequenceValidator, SequenceCalculatorService $sequenceCalculator)
    {
        $this->sequenceValidator = $sequenceValidator;
        $this->sequenceCalculator = $sequenceCalculator;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('calculate_max_sequence')->setDescription('Komenda oblicza największą liczbę w ciągu.');
        $this->addArgument('sequence_lengths', InputArgument::IS_ARRAY, 'Max 10 n (1 ≤ n ≤ 99 999)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sequenceLengths = $input->getArgument('sequence_lengths');
        $validationResult = $this->sequenceValidator->validate($sequenceLengths);
        if (!$validationResult['isValid']) {
            $output->writeln([$validationResult['errorMessage']]);
            return;
        }

        $sequenceResults = $this->sequenceCalculator->calculateMaxValues($sequenceLengths);
        $outputData = [];
        foreach ($sequenceResults as $sequenceResult) {
            $outputData[] = 'Dla n = '.$sequenceResult['length'].' maksymalna wartość '.$sequenceResult['maxValue'];
        }
        $output->writeln($outputData);
    }
}