<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
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
            'idMovie' => ['required'],
            'idUser' => ['required'],
            'rating' => ['required', 'numeric', 'between:1,5']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_movie' => $this->idMovie,
            'id_user' => $this->idUser
        ]);
    }
}
