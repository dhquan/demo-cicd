<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\OrderCalculator;

class OrderCalculatorTest extends TestCase
{
    // Test trường hợp tính bình thường
    public function test_calculates_total_correctly()
    {
        // Arrange
        $calculator = new OrderCalculator();

        // Act
        $result = $calculator->calculateTotal(100, 2); // 100 * 2 = 200

        // Assert
        $this->assertEquals(200, $result);
    }

    // Test trường hợp có giảm giá
    public function test_calculates_total_with_discount()
    {
        $calculator = new OrderCalculator();

        // Giá 100, số lượng 2, giảm 10%
        // (100 * 2) - 10% = 180
        $result = $calculator->calculateTotal(100, 2, 10);

        $this->assertEquals(180, $result);
    }
}

