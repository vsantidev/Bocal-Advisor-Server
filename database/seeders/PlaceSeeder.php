<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public $place = [
        '1' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => 'https://www.triplancar.com/sites/triplancar.com/files/lieu/607/lesignedutriomphe17.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles", 'user_id' => 2, 'city' => 'Paris', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '2' => ['title' => 'Hôtel Regina Louvre', 'street' => '2 Place des Pyramides', 'file' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/75/c6/58/exterior-view.jpg?w=700&h=-1&s=1', 'description' => "L’Hôtel Regina de style Art nouveau, récemment rénové, se trouve en plein cœur de Paris, dans le quartier de la mode, du shopping et des musées, en face du jardin des Tuileries et du musée du Louvre. A deux pas des boutiques de la rue Saint Honoré et de la Place Vendôme, l’Hôtel Regina possède un emplacement exceptionnel au cœur du centre historique et de la mode. Grâce à cette situation idéale les principaux lieux touristiques sont à quelques minutes de marche ou de transport (métro Tuileries et Pyramides à 150 mètres) comme le musée du Louvre, la Comédie Française, le musée d’Orsay, le Grand Palais, les Champs Elysées…", 'user_id' => 2, 'city' => 'Paris', 'x' => 48, 8638105, 'y' => 2, 3320528, 'postcode' => 75001],
        '3' => ['title' => "Pur' - Jean-François Rouquette", 'street' => '5 Rue de la Paix Park Hyatt ', 'file' => 'https://media-cdn.tripadvisor.com/media/photo-s/23/f1/9b/b8/salle-du-restaurant-pur.jpg', 'description' => "Deux restaurants contemporains au Park Hyatt : le Café Jeanne à l'heure du déjeuner et Pur', plus feutré, pour un bien agréable dîner. Ce dernier est évidemment à l’image de l’hôtel de la rue de la Paix, où luxe signifie raffinement, modernité et discrétion. Confiée à l’imagination d’Ed Tuttle, la décoration crée une atmosphère à la fois confortable et confidentielle, avec seulement 35 couverts. Tout est pensé dans les moindres détails : les harmonies de couleurs, l'éclairage et l’espace lui-même. Jean-François Rouquette (Taillevent, le Crillon, la Cantine des Gourmets, les Muses) trouve ici un lieu à sa mesure pour exprimer la grande maîtrise de son talent. Sa cuisine, créative et inspirée, accorde avec finesse d'excellents produits. Un 'pur' plaisir ! ", 'user_id' => 2, 'city' => 'Paris', 'x' => 48, 8689056, 'y' => 2, 3301781, 'postcode' =>  75002],
        '5' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '6' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '7' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '8' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
        '9' => ['title' => 'Puy du Fou', 'street' => '85590 Les Epesses', 'file' => '1703114291.jpg', 'description' => "Il y a des mondes et des époques que l'on croyait disparus. Pourtant, la forêt centenaire du Puy du Fou est devenue leur refuge et l'Histoire continue. Venez percer les mystères de ce lieu hors du temps et vivez une expérience inoubliable chargée en émotions fortes et en grands spectacles ", 'user_id' => 1, 'city' => 'Les Epesses', 'x' => 46.889602, 'y' => -0.928116, 'postcode' => 85590],
    ];
    public function run(): void
    {
        foreach ($this->place as $places => $details) {
            Place::factory()->create([
                'title' => $details['title'],
                'postcode' => $details['postcode'],
                'city' => $details['city'],
                'x' => $details['x'],
                'y' => $details['y'],
                'description' => $details['description'],
                'file' => $details['file'],
                'street' => $details['street'],
            ]);
        }
    }
}
