<?php

namespace App\Http\Requests;

use App\Rules\ValidCards;
use App\Rules\ValidSizeCard;
use Illuminate\Foundation\Http\FormRequest;

class GameFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'hand' => ['required', 'max:25', new ValidCards, new ValidSizeCard]
        ];
    }
}
