<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(self::class)->orderBy('created_at', 'desc');
    }

    /* database queries */
    public function createComment($request, $user_id)
    {
        $comment = $request->all();
        $comment['status'] = 1;
        $comment['user_id'] = $user_id;
        self::create($comment);
    }
}
