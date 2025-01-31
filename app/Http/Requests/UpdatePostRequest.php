<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
    public function rules(): array {
        return [
            'title' => [
                'required',
                'string',
                'min:8',
                Rule::unique('posts', 'title')->ignore($this->route('post')->id), // Ignore le post actuel
            ],
            'slug' => [
                'required',
                'regex:/^[0-9a-z\-]+$/',
                'min:4',
                Rule::unique('posts', 'slug')->ignore($this->route('post')->id), // Ignore le post actuel
            ],
            'content' => ['required', 'string', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'string'],
            'tags' => ['required'],
            'images' => ['array'], // Vérifie que c'est un tableau
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Règles pour chaque image
            'content' => ['required', 'string', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'string'],
            'tags' => ['required'],
            'images' => ['array'], // Vérifie que le tableau d'images est présent (non requis pour l'update)
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Règles pour chaque image
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
            'images.array' => 'Vous devez choisir au moins une image d\'illustration pour ce post.',
            'images.*.image' => 'Chaque fichier doit être une image.',
            'images.*.mimes' => 'Vos images sont de types non autorisés. Les seuls types autorisés sont : .jpeg, .jpg, .png, .gif.',
            'images.*.max' => 'Chaque image ne doit pas dépasser la taille maximale de 2 Mo.',
        ];
    }
}
