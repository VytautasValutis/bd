<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'story', 'need_money', 'have_money', 'lack_money', 'like', 'photo', 'approved', ];


    public function htp()
    {
        return $this->hasMany(Ht::class, 'ht_pivots', 'histories__id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'history_id', 'id');
    }

    public function money()
    {
        return $this->hasMany(Money::class, 'history_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(Photo::class, 'hist_id', 'id');
    }

    public function savePhoto(UploadedFile $photo) : string
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/history-photo/';
        $photo->move($path, $name);
        $img = Image::make($path . $name)->heighten(100);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/history-photo/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '/history-photo/t_' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }

    public function deleteLike()
    {
        $this->like->delete;
    }

    public function deleteMoney()
    {
        $this->money->delete;
    }

    public function deleteHtp()
    {
        $this->htp->delete;
    }



}
