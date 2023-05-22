<?php

namespace FeeCalculator;

use Exception;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\FeeRounder;
use PragmaGoTech\Interview\LinearInterpolationStrategy;
use PragmaGoTech\Interview\Model\LoanProposal;

class LinearInterpolationStrategyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCalculate(): void
    {
        $feeStructure = [
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

        $feeRounder = new FeeRounder();
        $calculator = new LinearInterpolationStrategy($feeRounder);

        foreach ($feeStructure as $loanAmount => $expectedFee) {
            $application = new LoanProposal($loanAmount);
            $fee = $calculator->calculate($application);
            $this->assertEquals($expectedFee, $fee);
        }
    }
}