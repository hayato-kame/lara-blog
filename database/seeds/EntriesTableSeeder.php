<?php

use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $body ="今日は、久しぶりに○○へ出かけてきました。\n\n" .
                "天気も良く、景色も最高でした。\n\n";
                
        for($j = 1; $j <= 5; $j++){
            
            for($i = 1; $i <= 10; $i++){
                
                DB::table('entries')->insert([
                    'user_id' => $j,
                    'title' => "最近の出来事". $i,
                    'body' => $body,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                    ]);
            }
        }    
                
       
    }
}
