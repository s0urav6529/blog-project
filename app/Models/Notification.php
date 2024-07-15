<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* relations */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /* database queries */
    public function createNotification($request, $user_id)
    {
        $post_id = $request->input('post_id');
        $post_owner_id = (new Post())->postOwnerId($post_id);

        $notification['post_id'] = $post_id;
        $notification['post_owner'] = $post_owner_id;
        $notification['user_id'] = $user_id;

        if ($user_id != $post_owner_id) {
            self::create($notification);
        }
    }
}
