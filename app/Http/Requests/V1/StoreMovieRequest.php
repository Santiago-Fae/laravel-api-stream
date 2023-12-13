<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'title' => ['required'],
            'idGenre' => ['required'],
            'releaseDate' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_genre' => $this->idGenre,
            'release_date' => $this->releaseDate
        ]);
    }
}
