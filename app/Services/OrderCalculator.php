<?php

namespace App\Services;

class OrderCalculator
{
    public function calculateTotal($price, $quantity, $discountPercent = 0)
    {
        $total = $price * $quantity;

        if ($discountPercent > 0) {
            $total = $total - ($total * ($discountPercent / 100));
        }

        return $total;
    }
}
