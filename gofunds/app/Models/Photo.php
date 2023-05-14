<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['photo', 'hist_id'];

    public static function add(UploadedFile $gallery, int $hist_id)
    {
        $name = $gallery->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/history-photo/';
        $gallery->move($path, $name);
        self::create([
            'hist_id' => $hist_id,
            'photo' => $name
        ]);
    }

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/history-photo/' . $this->photo;
            unlink($photo);
            // $photo = public_path() . '/history-photo/t_' . $this->photo;
            // unlink($photo);
        }
    }

}
