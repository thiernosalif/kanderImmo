<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'biens_id' => 'required|exists:biens,id',
            'motif' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'recu' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];
    }
}
