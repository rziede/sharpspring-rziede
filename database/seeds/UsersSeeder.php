<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      App\Models\User::truncate();

      $users = array(
        ['id' => 1,
         'name' => "test",
         'email' => "test@test.com",
         'password' => password_hash('$sh4rpspr1nG$', PASSWORD_BCRYPT),
         'updated_at' => "2015-10-12 02:40:15",
         'created_at' => "2015-10-12 02:40:15"
        ],
        ['id' => 2,
         'name' => "joe",
         'email' => "joe@joe.com",
         'password' => password_hash("joe123", PASSWORD_BCRYPT),
         'updated_at' => "2017-07-22 08:00:00",
         'created_at' => "2017-07-22 08:00:00"
        ]
      );

      foreach($users as $user) {
        App\Models\User::create($user);
      }
      Model::reguard();
    }
}
