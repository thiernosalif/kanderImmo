<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocataireRequest extends FormRequest
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
            'prenom' => 'required',
            'nom' => 'required',
            'cin' => 'required',
            'telephone' => 'nullable',
            'adresse' => 'nullable',
            'coordonne_pro' => 'nullable',
            'loyer_base' => 'nullable',
            'total_loyer' => 'nullable',
            'date_entre' => 'nullable',
            'expiration_contrat' => 'nullable',
        ];
    }
}
