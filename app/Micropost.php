<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //
    protected $fillable = ['content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // お気に入りの設定で Microposts(多対多)Usersに追加
    public function microposts_favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }

    
}
