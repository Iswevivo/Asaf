<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class StorePostRequest extends FormRequest
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
         return [
             'title' => ['required', 'string', 'min:8', 'unique:posts,title'],
             'slug' => [
                 'required',
                 'regex:/^[0-9a-z\-]+$/',
                 'min:4',
                 'unique:posts,slug' // Ignorer l'unicité pour l'ID du post actuel
             ],
             'content' => ['required', 'string', 'min:20'],
             'category_id' => ['required', 'exists:categories,id'],
             'status' => ['required', 'string'],
             'tags' => ['required'],
             'images' => ['required', 'array'], // Vérifie que le tableau d'images est présent
             'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Règles pour chaque image
         ];        
     }
     
     protected function generateUniqueSlug($slug, $postId = null)
     {
         $originalSlug = $slug;
         $counter = 1;
     
         while (Post::where('slug', $slug)->when($postId, function ($query, $postId) {
             return $query->where('id', '!=', $postId);
         })->exists()) {
             $slug = $originalSlug . '-' . $counter++;
         }
     
         return $slug;
     }
     
     protected function prepareForValidation()
     {
         $slug = $this->input('slug') ?: \Str::slug($this->input('title'));
         $this->merge([
             'slug' => $this->generateUniqueSlug($slug, $this->route('post')),
         ]);
     }
     
     public function messages(): array
     {
         return [
             'title.required' => 'Le titre est obligatoire.',
             'title.unique' => 'Un autre article a ce même titre.',
             'title.min' => 'Le titre doit comporter au moins :min caractères.',
             'slug.required' => 'Le slug est obligatoire.',
             'slug.regex' => 'Le slug doit uniquement contenir des lettres, des chiffres et des tirets.',
             'slug.min' => 'Le slug doit comporter au moins :min caractères.',
             'slug.unique' => 'Ce slug est déjà utilisé pour un autre post.',
             'content.required' => 'Le contenu est requis.',
             'content.min' => 'Le contenu doit comporter au moins :min caractères.',
             'category_id.required' => 'La catégorie est obligatoire.',
             'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
             'status.required' => 'Le statut (état) du post est obligatoire.',
             'tags.required' => 'Vous devez choisir les tags.',
             'images.required' => 'Vous devez choisir au moins une image d\'illustration pour ce post.',
             'images.*.required' => 'Chaque image doit être un fichier valide.',
             'images.*.image' => 'Chaque fichier doit être une image.',
             'images.*.mimes' => 'Vos images sont de types non autorisés. Les seuls types autorisés sont : .jpeg, .jpg, .png, .gif.',
             'images.*.max' => 'Chaque image ne doit pas dépasser la taille maximale de 2 Mo.',
         ];
     }
     
}