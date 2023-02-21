<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:offers,name,' . $this->route('offer')->id,
            'place' => 'required',
            'accommodationType' => 'required|in:Pensjonat,Hotel,Kwatera prywatna',
            'description' => 'required|max:1000',
        ];
    }
}
