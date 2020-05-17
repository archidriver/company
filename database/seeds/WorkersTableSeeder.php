<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workers')->delete();
        factory(\App\Workers::class, 50)->create();
        for( $i=2; $i <=5; $i++)
        {
            $count1 = \App\Workers::where('level', $i)->get()->count();
            if (  $count1 != 0 )
            {
                $working1 = \App\Workers::where('level', $i)->get();
                $working2 = \App\Workers::Where('level', $i-1)->pluck('id')->toArray();

                foreach ($working1 as $work)
                {
                    $temp = array_rand($working2);
                    $work->update(array('manager_id' => $working2[$temp]));
                }
            }
        }
    }
}
