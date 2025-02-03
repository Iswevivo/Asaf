<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    use App\Models\Program;
    use Illuminate\Validation\Rule;
    
    class ProgramRequest extends FormRequest
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
             $programId = $this->route('program'); // Récupère l'ID de l'objet en cours
             
             return [
                 'title' => [
                     'required',
                     'string',
                     Rule::unique('programs')->where(function ($query) {
                         return $query->where('center_id', $this->center_id);
                     })->ignore($programId), // Ignore le programme actuel lors de la mise à jour
                 ],
                 'slug' => [
                    'required',
                    'regex:/^[0-9a-z\-]+$/',
                    'unique:programs,slug',
                    Rule::unique('programs')->ignore($programId),
                ],
                 'description' => ['required', 'string'],
                 'days' => ['required', 'string'],
                 'timing' => ['required', 'string'],
                 'center_id' => ['required', 'exists:centers,id']
            ];
         }

         protected function generateUniqueSlug($slug, $programId = null)
         {
             $originalSlug = $slug;
             $counter = 1;
         
             while (Program::where('slug', $slug)->when($programId, function ($query, $programId) {
                 return $query->where('id', '!=', $programId);
             })->exists()) {
                 $slug = $originalSlug . '-' . $counter++;
             }
         
             return $slug;
         }
         
         protected function prepareForValidation()
         {
             $slug = $this->input('slug') ?: \Str::slug($this->input('title'));
             $this->merge([
                 'slug' => $this->generateUniqueSlug($slug, $this->route('program')),
             ]);
         }
         
         public function messages(): array
         {
             return [
                 'title.required' => 'Le nom est obligatoire.',
                 'description.required' => 'La description du programme est requise.',
                 'days.required' => 'Vous devez indiquer les jours concernes par ce programme. Exemple : Lundi-Mercredi-Samedi.',
                 'timing.required' => 'Vousd devez indiquer un timing pour ce programme. Par exemple : 8h30 - 12h30.',
                 'center_id.required' => 'Vous devez indiquer un centre',
                 'title.unique' => 'Un programme avec ce titre existe déjà pour ce centre.',
                ];
         }
         
    }