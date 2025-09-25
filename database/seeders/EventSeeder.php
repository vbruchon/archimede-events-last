<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class EventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $currentDate = Carbon::now();
    $startRange = Carbon::create(2023, 5, 5);
    $endRange = Carbon::now();

    $events = [
      [
        'name' => 'Trophée 4S',
        'partners' => 'Crédit Mutuel',
        'description' => 'Selection des entreprises et ceremonie de cloture',
        'location' => 'Lyon',
        'date_start' => '2023-07-04 18:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 2,
        'user_id' => 1,
      ],
      [
        'name' => 'French Tech Summit',
        'partners' => 'French Tech Alpes',
        'description' => 'Gros événement sillon alpin (Grenoble)',
        'location' => 'Grenoble',
        'date_start' => '2023-07-04 00:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 4,
        'user_id' => 3,

      ],
      [
        'name' => 'Lancement concours initiative O Féminin - Drôme',
        'partners' => 'Initiative France AURA',
        'description' => 'Lancement du coucours régional et réunion de femmes cheffes d\'entreprise',
        'location' => '',
        'date_start' => '2023-07-04 9:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 8,
        'number_of_participants_id' => 1,
        'user_id' => 3,

      ],
      [
        'name' => 'Les Talks de Digital League - Blockchain',
        'partners' => 'Esisar',
        'description' => '3 intervenants viendront parler des enjeux de la blockchain',
        'location' => '',
        'date_start' => '2023-07-06 9:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 5,
        'number_of_participants_id' => 2,
        'user_id' => 2,

      ],
      [
        'name' => 'L\'Agglo fête ses entreprises',
        'partners' => '',
        'description' => 'Invitation des entreprises de plus de 5 salariés',
        'location' => 'Valence',
        'date_start' => '2023-07-06 18:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => 'Besoins de l\'organisateur pour l\'événement 1',
        'structure_id' => 2,
        'number_of_participants_id' => 5,
        'user_id' => 4,

      ],
      [
        'name' => 'Startup & grands groupes : ça matche !',
        'partners' => 'Archimède',
        'description' => 'Rencontre & collaborations entre startup et grands groupes sur le territoire',
        'location' => '',
        'date_start' => '2023-07-11 18:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 2,
        'user_id' => 1,
      ],
      [
        'name' => 'Barbeukokorico',
        'partners' => 'Campus Numérique',
        'description' => 'Réunion conviviale des entreprises et amis de la French Tech Valence-Romans',
        'location' => '',
        'date_start' => '2023-06-15 12:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => 'Besoins de l\'organisateur pour l\'événement 1',
        'structure_id' => 1,
        'number_of_participants_id' => 3,
        'user_id' => 1,
      ],
      [
        'name' => 'Tech&Bio : Salon international agricole. stand mutualisé pour 4 startups',
        'partners' => '',
        'description' => 'Salon biennal des techniques agricoles bio et alternatives',
        'location' => '',
        'date_start' => '2023-09-20 9:00:00',
        'date_end' => '2023-09-21 18:00:00',
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 5,
        'user_id' => 1,
      ],
      [
        'name' => 'Les Talks de Digital League - Marketing - Vente - Finance ',
        'partners' => '',
        'description' => '3 intervenants viendront parler des enjeux de la cybersécurité',
        'location' => '',
        'date_start' => '2023-09-26 12:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 5,
        'number_of_participants_id' => 2,
        'user_id' => 5,

      ],
      [
        'name' => 'Mardinnov\'',
        'partners' => 'Digital League, Valence Romans Agglo, Départment 26',
        'description' => 'Mise en avant de 5 entreprises innovantes du territoire',
        'location' => '',
        'date_start' => '2023-10-10 18:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 4,
        'user_id' => 1,

      ],
      [
        'name' => 'Un monde désirable',
        'partners' => 'Beasyness',
        'description' => 'Climat / éco-responsailité',
        'location' => '',
        'date_start' => '2023-10-12 00:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 1,
        'number_of_participants_id' => 5,
        'user_id' => 2,

      ],
      [
        'name' => 'Les Talks de Digital League - IA',
        'partners' => '',
        'description' => '3 intervenants viendront parler des enjeux de la cybersécurité',
        'location' => '',
        'date_start' => '2023-10-19 12:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 5,
        'number_of_participants_id' => 2,
        'user_id' => 4,

      ],
      [
        'name' => 'Les Talks de Digital League - Numérique responsable ',
        'partners' => '',
        'description' => '',
        'location' => '',
        'date_start' => '2023-11-16 12:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 5,
        'number_of_participants_id' => 2,
        'user_id' => 1,

      ],
      [
        'name' => 'Soirée de fin d\'année',
        'partners' => '',
        'description' => '',
        'location' => '',
        'date_start' => '2023-12-14 12:00:00',
        'date_end' => NULL,
        'is_Fix' => true,
        'organizer_needs' => '',
        'structure_id' => 5,
        'number_of_participants_id' => 2,
        'user_id' => 3,

      ],
      [
        'name' => 'Soirée Monopoly',
        'partners' => '',
        'description' => 'Pour découvrir les nouveaux adhérents CEV',
        'location' => '',
        'date_start' => '2023-09-01 18:30:00',
        'date_end' => '2023-10-31 22:30:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 12,
        'number_of_participants_id' => 2,
        'user_id' => 2,

      ],
      [
        'name' => 'Soirée des dirigeants',
        'partners' => '',
        'description' => 'séminaire sur 2 jours',
        'location' => '',
        'date_start' => '2023-12-31 00:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 12,
        'number_of_participants_id' => 2,
        'user_id' => 1,

      ],
      [
        'name' => 'Soirée inter-clubs',
        'partners' => 'ERB, Le Club Rovaltain',
        'description' => '',
        'location' => '',
        'date_start' => '2023-09-01 00:00:00',
        'date_end' => '2023-09-30 00:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 12,
        'number_of_participants_id' => 5,
        'user_id' => 4,

      ],
      [
        'name' => 'Voeux du Club Rovaltain',
        'partners' => '',
        'description' => '',
        'location' => '',
        'date_start' => '2024-11-15 08:00:00',
        'date_end' => '2024-01-31 08:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 11,
        'number_of_participants_id' => 3,
        'user_id' => 5,

      ],
      [
        'name' => 'Rencontre inter entreprises',
        'partners' => '',
        'description' => 'Rendez-vous des membres de l\'association autour d\'un moment convivial - repas offert',
        'location' => '',
        'date_start' => '2023-06-15 12:00:00',
        'date_end' => '2024-07-15 14:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 11,
        'number_of_participants_id' => 5,
        'user_id' => 1,

      ],
      [
        'name' => 'Garden Fab.T',
        'partners' => '',
        'description' => 'Soirée festive où on invite tous nos partenaires et porteursde projet',
        'location' => '',
        'date_start' => '2023-06-25 17:00:00',
        'date_end' => '2023-07-13 21:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 10,
        'number_of_participants_id' => 3,
        'user_id' => 1,

      ],
      [
        'name' => 'Lancement concours initiative O Féminin - Ardèche',
        'partners' => 'Initiative France AURA',
        'description' => 'Lancement du concours régional et réunion de femmes cheffes d\'entreprise',
        'location' => '',
        'date_start' => '2023-10-17 09:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 8,
        'number_of_participants_id' => 1,
        'user_id' => 3,

      ],
      [
        'name' => 'Les soirées de l\'engagement',
        'partners' => '',
        'description' => 'Soirée pour susciter, mettre en avant l\'entreprenariait engagé',
        'location' => '',
        'date_start' => '2023-12-01 18:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 8,
        'number_of_participants_id' => 1,
        'user_id' => 3,

      ],
      [
        'name' => 'Evènement local dans le cadre de la semaine l\'ESS (national)',
        'partners' => 'Evènement ESS',
        'description' => '',
        'location' => '',
        'date_start' => '2023-11-25 18:00:00',
        'date_end' => NULL,
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 8,
        'number_of_participants_id' => 1,
        'user_id' => 3,

      ],
      [
        'name' => 'Destination innovation',
        'partners' => '',
        'description' => 'Ateliers d\'innovation ouverte dédiés au tourisme',
        'location' => '',
        'date_start' => '2023-11-02 09:00:00',
        'date_end' => '2023-11-30 15:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 7,
        'number_of_participants_id' => 3,
        'user_id' => 4,

      ],
      [
        'name' => 'Dynamic\'R',
        'partners' => 'REDA, CCI et CPME',
        'description' => 'Evénement autour de la RSE (Ateliers, conférence et diner)',
        'location' => '',
        'date_start' => '2023-11-01 00:00:00',
        'date_end' => '2023-11-30 00:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 4,
        'number_of_participants_id' => 4,
        'user_id' => 4,

      ],
      [
        'name' => 'Trophées de l\'entreprise',
        'partners' => '',
        'description' => 'Cérémonie de remise des prix',
        'location' => '',
        'date_start' => '2023-11-27 18:00:00',
        'date_end' => '2023-11-30 22:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 2,
        'number_of_participants_id' => 5,
        'user_id' => 5,

      ],
      [
        'name' => 'J\'y suis, j\'y reste',
        'partners' => 'UGA, CEV, Moulin Digital',
        'description' => 'Rencontres étudiants / entreprises',
        'location' => '',
        'date_start' => '2023-10-01 18:00:00',
        'date_end' => '2023-10-31 22:00:00',
        'is_Fix' => false,
        'organizer_needs' => '',
        'structure_id' => 2,
        'number_of_participants_id' => 3,
        'user_id' => 5,

      ]
    ];

    foreach ($events as $event) {
      $event['accessType_id'] = rand(1, 2);
      $event['created_at'] = $startRange->clone()->addSeconds(rand(0, $endRange->diffInSeconds($startRange)));
      $event['updated_at'] = $event['created_at'];
      Event::create($event);
    }
  }
}
