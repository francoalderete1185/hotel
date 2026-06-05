<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name'     => 'Gabriela Moreno',
                'author_location' => 'Mendoza',
                'content'         => 'Volveríamos. La ubicación cerca del Congreso es ideal para moverse en subte, y el personal en recepción es atento. El desayuno cumple. La habitación estaba limpia y fue más silenciosa de lo que esperaba para estar tan céntrica.',
                'rating'          => 5,
                'is_featured'     => true,
            ],
            [
                'author_name'     => 'Diego Salinas',
                'author_location' => 'Córdoba',
                'content'         => 'Vine por trabajo tres noches. Precio justo, habitación tranquila, recepción con buena onda y siempre disponible. El desayuno es sencillo pero suficiente. Nada que reprochar para lo que es: un hotel céntrico funcional que hace bien lo que promete.',
                'rating'          => 4,
                'is_featured'     => true,
            ],
            [
                'author_name'     => 'Natalia y Rodrigo',
                'author_location' => 'Rosario',
                'content'         => 'Buena relación precio-calidad. La ubicación es su mayor virtud: a pocas cuadras del subte B y C, a 10 minutos de Recoleta. Las habitaciones no son grandes pero están bien equipadas y el personal es amable. Lo recomendamos para visitas cortas o viajes de trabajo.',
                'rating'          => 4,
                'is_featured'     => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
