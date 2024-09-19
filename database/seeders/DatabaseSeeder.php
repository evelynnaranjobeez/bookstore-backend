<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder de usuarios
        DB::table('users')->insert([
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // Encripta la contraseña
                'role' => 'admin',
                'token' => '4|ud1pkJobd02POZQLWvq8PDdzEvpF6VDBmJkoN26ce44844d3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'user@example.com',
                'password' => Hash::make('123456'),
                'role' => 'operative',
                'token' => '3|01xeXAbeKZijzlG6uQNkxpJg1SYjYuafSEKdL7cM8cb55fd3',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Seeder de autores
        DB::table('authors')->insert([
            ['name' => 'Gabriel García Márquez', 'birth_date' => '1927-03-06', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Isabel Allende', 'birth_date' => '1942-08-02', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jorge Luis Borges', 'birth_date' => '1899-08-24', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mario Vargas Llosa', 'birth_date' => '1936-03-28', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Julio Cortázar', 'birth_date' => '1914-08-26', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pablo Neruda', 'birth_date' => '1904-07-12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alejo Carpentier', 'birth_date' => '1904-12-26', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Miguel Ángel Asturias', 'birth_date' => '1899-10-19', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carlos Fuentes', 'birth_date' => '1928-11-11', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Juan Rulfo', 'birth_date' => '1917-05-16', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paulo Coelho', 'birth_date' => '1947-08-24', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jorge Amado', 'birth_date' => '1912-08-10', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'José Saramago', 'birth_date' => '1922-11-16', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antonio Lobo Antunes', 'birth_date' => '1942-09-01', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Clarice Lispector', 'birth_date' => '1920-12-10', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Machado de Assis', 'birth_date' => '1839-06-21', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Gabriel García Márquez', 'birth_date' => '1927-03-06', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Isabel Allende', 'birth_date' => '1942-08-02', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jorge Luis Borges', 'birth_date' => '1899-08-24', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mario Vargas Llosa', 'birth_date' => '1936-03-28', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Julio Cortázar', 'birth_date' => '1914-08-26', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pablo Neruda', 'birth_date' => '1904-07-12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alejo Carpentier', 'birth_date' => '1904-12-26', 'created_at' => now(), 'updated_at' => now()],

        ]);

        // Seeder de géneros
        DB::table('genres')->insert([
            ['name' => 'Magical Realism', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fantasy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Classics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Surrealism', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seeder de idiomas
        DB::table('languages')->insert([
            ['name' => 'Spanish', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'French', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'German', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seeder de libros
        DB::table('books')->insert([
            [
                'title' => 'Cien Años de Soledad',
                'author_id' => 1,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1967,
                'description' => 'Masterpiece of magical realism.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Amor en los Tiempos del Cólera',
                'author_id' => 1,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1985,
                'description' => 'A love story spanning years.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Casa de los Espíritus',
                'author_id' => 2,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1982,
                'description' => 'A family saga intertwined with magical realism.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Ficciones',
                'author_id' => 3,
                'genre_id' => 5,
                'language_id' => 1,
                'year' => 1944,
                'description' => 'Collection of philosophical and fantastic stories.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Conversación en la Catedral',
                'author_id' => 4,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1969,
                'description' => 'Political and social analysis of Peru.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Rayuela',
                'author_id' => 5,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1963,
                'description' => 'Innovative narrative structure.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Aleph',
                'author_id' => 3,
                'genre_id' => 5,
                'language_id' => 1,
                'year' => 1949,
                'description' => 'Collection of philosophical and fantastic stories.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Ciudad y los Perros',
                'author_id' => 4,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1963,
                'description' => 'Critique of the military school in Peru.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Fiesta del Chivo',
                'author_id' => 4,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 2000,
                'description' => 'Historical novel about the dictatorship of Trujillo.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Túnel',
                'author_id' => 5,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1948,
                'description' => 'Existentialist novel.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Muerte y la Brújula',
                'author_id' => 3,
                'genre_id' => 5,
                'language_id' => 1,
                'year' => 1951,
                'description' => 'Collection of philosophical and fantastic stories.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Guerra del Fin del Mundo',
                'author_id' => 4,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1981,
                'description' => 'Historical novel about the War of Canudos.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Los Pasos Perdidos',
                'author_id' => 5,
                'genre_id' => 4,
                'language_id' => 1,
                'year' => 1953,
                'description' => 'Journey through the jungle of Venezuela.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Otoño del Patriarca',
                'author_id' => 1,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1975,
                'description' => 'Dictatorship and solitude.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El General en su Laberinto',
                'author_id' => 1,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1989,
                'description' => 'The last days of Simón Bolívar.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Aventura de Miguel Littín Clandestino en Chile',
                'author_id' => 2,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1986,
                'description' => 'The story of a filmmaker in exile.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Reino del Dragón de Oro',
                'author_id' => 2,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1992,
                'description' => 'The adventures of a young',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Bosque de los Pigmeos',
                'author_id' => 2,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 2004,
                'description' => 'The adventures of a young',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Aleph 2',
                'author_id' => 3,
                'genre_id' => 5,
                'language_id' => 1,
                'year' => 1949,
                'description' => 'Collection of philosophical and fantastic stories.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Veronika decide morir',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1998,
                'description' => 'The life of Veronika changes when she decides to die.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Alquimista',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1988,
                'description' => 'The story of Santiago, a shepherd who dreams of finding a treasure.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Brida',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1990,
                'description' => 'Brid is a young',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Demonio y la Señorita Prym',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 2000,
                'description' => 'The story of a town that is visited by the devil.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'El Peregrino de Compostela',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 1987,
                'description' => 'The story of a pilgrimage to Santiago de Compostela.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'La Bruja de Portobello',
                'author_id' => 11,
                'genre_id' => 1,
                'language_id' => 1,
                'year' => 2006,
                'description' => 'The story of Athena who is looking for her identity.',
                'created_at' => now(),
                'updated_at' => now()
            ],


        ]);
    }
}
