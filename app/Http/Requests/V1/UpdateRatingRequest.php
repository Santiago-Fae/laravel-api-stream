<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRatingRequest extends FormRequest
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
            'rating' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        //TODO: check if this is the best way to do this
        if ($this->id_movie) {
            $this->merge([
                'id_movie' => $this->idMovie,
            ]);
        }
        if ($this->id_user) {
            $this->merge([
                'id_user' => $this->idUser
            ]);
        }
    }
}
