<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Center;
use Illuminate\Validation\Rule;

class StoreCenterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */


     public function rules(): array
     {
         $centerId = $this->route('centre'); // Récupère l'ID de l'objet en cours
         
         return [
             'name' => [
                 'required',
                 'string',
                 Rule::unique('centers', 'name')->ignore($centerId),
             ],
             'description' => ['required', 'string'],
             'address' => ['required'],
             'is_active' => ['required'],
             'phone' => [
                 'required',
                 Rule::unique('centers')->ignore($centerId),
             ],
             'email' => [
                 'required',
                 'email',
                 Rule::unique('centers')->ignore($centerId),
             ],
         ];
     }
     
     
     public function messages(): array
     {
         return [
             'name.required' => 'Le nom est obligatoire.',
             'name.unique' => 'Un autre centre a ce même nom.',
             'description.required' => 'La description du centre est requise.',
             'address.required' => 'Une adresse est obligatoire.',
             'is_active.required' => 'Le statut du Centre est obligatoire.',
             'phone.required' => 'Vous devez indiquer un numero de telephone',
             'phone.unique' => 'Ce numero de telephone est deja attribue a un autre centre',
             'email.unique' => 'Cette adresse electronique appartient a un autre centre',
             'email.required' => 'Vous devez indiquer une adresse electronique',
         ];
     }
     
}