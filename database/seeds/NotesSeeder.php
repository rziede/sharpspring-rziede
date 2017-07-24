<?php

use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        App\Models\Note::truncate();

        $notes = array(
          ['id' => 1,
           'user_id' => 1,
           'title' => "Test's First Note",
           'body' => "Lorem ipsum dolor sit amet, pri eu quot doming, ei illum argumentum mei.",
           'updated_at' => "2015-10-20 08:40:15",
           'created_at' => "2015-10-20 08:40:15"
          ],
          ['id' => 2,
           'user_id' => 1,
           'title' => "Test's Second Note",
           'body' => "Cu sit tamquam eligendi, brute volumus ex sed. Detraxit accusamus similique et eam, eu erant nominati antiopam vis.",
           'updated_at' => "2016-04-13 10:30:15",
           'created_at' => "2016-04-13 10:30:15"
          ],
          ['id' => 3,
           'user_id' => 2,
           'title' => "JOE'S ONLY NOTE!",
           'body' => "Ne assum meliore democritum mel, mea no enim deleniti ponderum.",
           'updated_at' => "2017-04-13 01:10:15",
           'created_at' => "2017-04-13 01:10:15"
          ],
        );

        foreach($notes as $note) {
          App\Models\Note::create($note);
        }
        Model::reguard();
    }
}
