<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;

class LinearInterpolationStrategy implements FeeCalculator
{
    private array $feeStructure = [
        1000 => 50,
        2000 => 90,
        3000 => 90,
        4000 => 115,
        5000 => 100,
        6000 => 120,
        7000 => 140,
        8000 => 160,
        9000 => 180,
        10000 => 200,
        11000 => 220,
        12000 => 240,
        13000 => 260,
        14000 => 280,
        15000 => 300,
        16000 => 320,
        17000 => 340,
        18000 => 360,
        19000 => 380,
        20000 => 400
    ];

    private FeeRounder $feeRounder;

    public function __construct(FeeRounder $feeRounder)
    {
        $this->feeRounder = $feeRounder;
    }

    /**
     * @param LoanProposal $application
     * @return float
     * @throws \Exception
     */
    public function calculate(LoanProposal $application): float
    {
        $loanAmount = $application->amount();

        $lowerBound = 1000;
        $upperBound = 1000;

        foreach ($this->feeStructure as $amount => $fee) {
            if ($loanAmount <= $amount) {
                $upperBound = $amount;
                break;
            }
            $lowerBound = $amount;
        }

        $feeLower = $this->feeStructure[$lowerBound] ?? null;
        $feeUpper = $this->feeStructure[$upperBound] ?? null;

        if ($feeLower === null || $feeUpper === null) {
            throw new \Exception('Fee structure is missing required values.');
        }

        $interpolationFactor = ($loanAmount - $lowerBound) / ($upperBound - $lowerBound);
        $fee = $feeLower + $interpolationFactor * ($feeUpper - $feeLower);

        $roundedFee = $this->feeRounder->roundFee($fee, $loanAmount);

        return (float) $roundedFee;
    }

}