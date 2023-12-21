<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public $place = [
        '1' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles", 'user_id' => 2, 'city' => 'Paris', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '2' => ['title' => 'Hôtel Regina Louvre', 'street' => '2 Place des Pyramides', 'file' => '1703114291.jpg', 'descripition' => "L’Hôtel Regina de style Art nouveau, récemment rénové, se trouve en plein cœur de Paris, dans le quartier de la mode, du shopping et des musées, en face du jardin des Tuileries et du musée du Louvre. A deux pas des boutiques de la rue Saint Honoré et de la Place Vendôme, l’Hôtel Regina possède un emplacement exceptionnel au cœur du centre historique et de la mode. Grâce à cette situation idéale les principaux lieux touristiques sont à quelques minutes de marche ou de transport (métro Tuileries et Pyramides à 150 mètres) comme le musée du Louvre, la Comédie Française, le musée d’Orsay, le Grand Palais, les Champs Elysées…", 'user_id' => 2, 'city' => 'Paris', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 75001],
        '3' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '5' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '6' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '7' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '8' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '9' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'descripition' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
    ];
    public function run(): void
    {
        foreach ($this->place as $places => $details) {
            Place::factory()->create([
                'title' => $details['title'],
                'year' => $details['year'],
                'image' => $details['image'],
                'genre_id' => $details['genre_id'],
                'user_id' => $details['user_id'],
                'note_id' => $details['note_id'],
                'author_id' => $details['author_id'],
                'synopsis_id' => $details['synopsis_id'],
            ]);
        }
    }
}
