<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

class FeeRounder
{
    public function roundFee(float $fee, float $loanAmount): float
    {
        $totalAmount = $fee + $loanAmount;
        $roundedAmount = ceil($totalAmount / 5) * 5;
        $roundedFee = $roundedAmount - $loanAmount;
        return (float) $roundedFee;
    }
}