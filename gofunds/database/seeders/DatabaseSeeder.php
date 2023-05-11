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
use File;
use App\Entities\AiController;


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
        
        $h_tags = [
            'doctor',
            'cat',
            'home',
            'blue',
            'car',
            'table',
            'puppy',
            'dog',
            'sun',
            'sea',
            'road',
            'tree',
            'child',
            'fire',
            'cemetery',
            'meadow',
            'programmer',
            'elk',
            'mushroom',
            'penguin'
        ];

        foreach(range(0,19) as $k){
            DB::table('hts')->insert([
                'text' => $h_tags[$k],
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

        $path = public_path('/history-photo/');
        $img = Image::make('V:\BIT\Uzduotys\BD\gallery/no_photo.jpg')->heighten(100);
        $img->save($path . 't_no_photo.jpg', 90);
        foreach(range(1, 10) as $t){
            $phName = $mainPhotoName[$t - 1];
            $url = 'C:\xampp\htdocs\bd\gofunds\storage/app/public/' . $phName;
            $phName = rand(1000000, 9999999) .'-' . $phName;
            File::copy($url, $path . $phName);
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

            $img = Image::make($path . $phName)->heighten(100);
            $img->save($path . 't_' . $phName, 90);

            $key_prob = rand(1, 100);
            $tag_count = match(true) {
                $key_prob <= 10 => 2,
                $key_prob <= 25 => 3,
                $key_prob <= 45 => 4,
                $key_prob <= 85 => 5,
                default => 6,
            };
            $tagArr = self::putRandArr(1, 20, $tag_count);
            $tags_str = ' ';
            foreach(range(1, $tag_count) as $k) {
                DB::table('ht_pivots')->insert([
                    'histories__id' => $t,
                    'hts__id' => $tagArr[$k - 1],
                ]);
                $txt = DB::table('hts')->where('id', $tagArr[$k - 1])->get()->first()->text;
                $tags_str = $tags_str . $txt . ' ';
            }

            $prompt = 'a sad story in up to one hundred and twenty words tranlate in lithuanian using words:' . $tags_str;
            $max_tokens = 200; 
            $Ai_req = new AiController($prompt, $max_tokens);
            $story = $Ai_req->sendRequest();
            DB::table('histories')->insert([
                'user_id' => $t,
                'story' => $story,
                'need_money' => rand(100000, 5000000) / 100,
                'photo' => $phName,
                'approved' => $tmp_num,
            ]);

            $key_prob = rand(1, 100);
            $gal_count = match(true) {
                $key_prob <= 10 => 0,
                $key_prob <= 40 => 3,
                $key_prob <= 80 => 4,
                default => 5,
            };
            // Image::configure(['driver' => 'imagick']);
            if($gal_count > 0) {
                foreach(range(1, $gal_count) as $g) {
                    $galArr = self::putRandArr(10, 59, $gal_count);
                    $phName = $galArr[$g - 1] . '.jpg';
                    $url = 'V:\BIT\Uzduotys\BD\gallery/' . $phName;
                    $phName = rand(1000000, 9999999) .'-' . $phName;
                    $path = public_path('/history-photo/');
                    File::copy($url, $path . $phName);
                    DB::table('photos')->insert([
                        'hist_id' => $t,
                        'photo' => $phName
                    ]);
                }
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
                        'user_id' => rand(1,20),
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
            DB::table('histories')->where('id', $history->id)->update([
                'like' => $like_count,
            ]);
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
