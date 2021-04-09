<?php

namespace Tests\Feature;

use App\Http\Requests\GameFormRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class FormValidationTest extends TestCase
{
    public function invalidRequests(): array
    {
        return [
            [['name' => '', 'hand' => '']],
            [['name' => '', 'hand' => '2 3 4 5 J Q K']],
            [['name' => 'Gustavo', 'hand' => '']],
            [['name' => 'Gustavo', 'hand' => '2 3 4 J Q 1']]
        ];
    }

    /**
     * @dataProvider invalidRequests
     *
     * @param  array $request
     */
    public function testInvalidCardsFeature(array $request)
    {
        $this->call('POST', '/api/play', $request);
        $form = \Mockery::mock(GameFormRequest::class);

        $form->shouldReceive('validate')
            ->andThrow(ValidationException::class);
    }

}
