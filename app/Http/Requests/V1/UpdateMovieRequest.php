<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'title' => ['required'],
                'idGenre' => ['required'],
                'releaseDate' => ['required']
            ];
        }
        //is PATCH
        return [
            'title' => ['sometimes', 'required'],
            'idGenre' => ['sometimes', 'required'],
            'releaseDate' => ['sometimes', 'required']
        ];
 
    }

    protected function prepareForValidation()
    {
        //TODO: check if this is the best way to do this
        if ($this->id_genre) {
            $this->merge([
                'id_genre' => $this->id_genre
            ]);
        }
        if ($this->release_date) {
            $this->merge([
                'release_date' => $this->release_date
            ]);
        }
    }
}
