<?php

namespace Tests\Unit;

use App\Rules\ValidCards;
use App\Rules\ValidSizeCard;
use Tests\TestCase;

class FormValidationTest extends TestCase
{
    public function testInvalidCards()
    {
        $invalid_cards = 'A J Q K 1';
        $rule = \Mockery::mock(ValidCards::class);

        $rule->shouldReceive('passes')
            ->with($invalid_cards)
            ->andReturnFalse();
    }

    public function testInvalidSizeCards()
    {
        $invalid_cards = 'A J Q KK';
        $rule = \Mockery::mock(ValidSizeCard::class);

        $rule->shouldReceive('passes')
            ->with($invalid_cards)
            ->andReturnFalse();
    }
}
