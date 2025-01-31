<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => User::factory(), // Associe un utilisateur aléatoire
            'category_id' => Category::factory(), // Associe une catégorie aléatoire
        ];
    }

    /**
     * Configure model after creation.
     *
     * @return void
     */
    public function configure()
    {
        return static::afterCreating(function (Post $post) {
            $post->user_id = User::all()->random()->id;

            // Créer un nombre aléatoire de tags (entre 1 et 3)
            $tags = Tag::factory()->count(rand(1, 3))->create();

            // Récupérer les IDs des tags créés
            $tagIds = $tags->pluck('id');

            // Associer les tags au post en utilisant la méthode sync()
            $post->tags()->sync($tagIds);
        });
    }
}