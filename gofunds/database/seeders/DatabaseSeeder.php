<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\History;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class DatabaseSeeder extends Seeder
{
    private function putRandArr($from, $to, $count) : array
    {
        $rez = [];
        foreach (range(0, $count - 1) as $i) {
            $num = rand($from, $to);
            while(in_array($num, $rez)){
                $num = rand($from, $to);
            };
            $rez[] = $num;
        }
        return $rez;
    }

    public function run(): void
    {
        $faker = Faker::create();
        
        foreach(range(1,20) as $_){
            DB::table('hts')->insert([
                'text' => $faker->word,
            ]);
        }
        $mainPhotoName = [
            '6BigqbBc8.png',
            '6TyXRqA7c.png',
            'ATbjMxryc.png',
            '8TEoGXzTa.png',
            'BTarex9T8.jpg',
            'Lid5X67i4.png',
            'pc78BGazi.png',
            'pc78y5Gqi.jpg',
            'rinGnEyrT.png',
            'zcXe8Kq6i.jpg'
        ];
        foreach(range(1, 10) as $t){
            $url = Storage::url($mainPhotoName[$t - 1]);
            // $path = public_path() . '/history-photo/' . $mainPhotoName[$t - 1];
            $path = '/public/history-photo/' . $mainPhotoName[$t - 1];
            Storage::copy($url, $path);
            dd($url, $path);
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->firstName . '@gmail.com',
                'role' => 10,
                'password' => Hash::make('123'),
            ]);

            $key_prob = rand(1, 100);
            $tmp_num = match(true) {
                $key_prob <= 20 => 0,
                default => 1,
            };

            DB::table('histories')->insert([
                'user_id' => $t,
                'story' => $faker->text(150),
                'need_money' => rand(100000, 5000000) / 100,
                'approved' => $tmp_num,
            ]);

            $key_prob = rand(1, 100);
            $tag_count = match(true) {
                $key_prob <= 10 => 2,
                $key_prob <= 25 => 3,
                $key_prob <= 45 => 4,
                $key_prob <= 85 => 5,
                default => 6,
            };
            $tagArr = self::putRandArr(1, 20, $tag_count);
            foreach(range(1, $tag_count) as $k) {
                DB::table('ht_pivots')->insert([
                    'histories__id' => $t,
                    'hts__id' => $tagArr[$k - 1],
                ]);
            }
        }
        foreach(range(1, 10) as $t){
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->firstName . '@gmail.com',
                'role' => 10,
                'password' => Hash::make('123'),
            ]);
        }
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'role' => 1,
            'password' => Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'role' => 10,
            'password' => Hash::make('123'),
        ]);
        $histories = History::where('approved', 1)->get();
        foreach($histories as $history) {
            $key_prob = rand(1, 100);
            $money_count = match(true) {
                $key_prob <= 10 => 0,
                $key_prob <= 20 => 1,
                $key_prob <= 40 => 2,
                $key_prob <= 70 => 3,
                $key_prob <= 90 => 4,
                default => 5,
            };
            if($money_count > 0) {
                $money_min = (int) $history->need_money * 100 / 20;
                $money_max = (int) $history->need_money * 100 / 5;
                foreach(range(1, $money_count) as $_) {
                    DB::table('money')->insert([
                        'user_id' => rand(1,40),
                        'history_id' => $history->id,
                        'money' => rand($money_min, $money_max) / 100,
                    ]);
                }
            }
            $key_prob = rand(1, 100);
            $like_count = match(true) {
                $key_prob <= 20 => 1,
                $key_prob <= 50 => 2,
                $key_prob <= 80 => 3,
                default => 4,
            };
            $likeArr = self::putRandArr(1, 20, $like_count);
            foreach(range(1, $like_count) as $k) {
                // dd($likeArr, $k, $like_count);
                DB::table('likes')->insert([
                    'history_id' => $history->id,
                    'user_id' => $likeArr[$k - 1],
                ]);
            }

        }
    }
}
