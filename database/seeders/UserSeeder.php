<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
      [
        'name' => 'Vivian',
        'email' => 'vbruchon@lemoulindigital.fr',
        'password' => '31072012',
        'is_admin' => 1
      ],
      [
        'name' => 'Vivian',
        'email' => 'vivian.bruchon@gmail.fr',
        'password' => 'p?eE5Z2AFauR*T@',
      ]
    ];
    foreach($users as $user){
      User::create($user);
    }
    User::factory()->count(10)->create();
  }
}
