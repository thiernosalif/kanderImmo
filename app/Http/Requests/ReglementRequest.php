<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReglementRequest extends FormRequest
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
            'locataires_id' => 'required',
            'articles_id' => 'required',
            'mois_paie' => 'nullable',
            'montant' => 'nullable',
            'mode_reglement' => 'nullable',
            'avance' => 'nullable',
            'transactionReference' => 'nullable',
            'acompte' => 'nullable',
            'complement' => 'nullable',
            'created_at' => 'nullable',
        ];
    }
}
