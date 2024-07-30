<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* relations */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* database queries */
    public function pluckDivisions()
    {
        return Division::pluck('name', 'id');
    }

    public function findRole(int $user_id)
    {
        return User::find($user_id)->role;
    }

    public function findProfileDetails(int $user_id)
    {
        return self::where('user_id', $user_id)->first();
    }
}
