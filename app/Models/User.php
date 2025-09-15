<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;

    public static $defultImage = 'default.jpg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['pass'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getPassAttribute()
    {
        return 'password';
    }

    public function getImageAttribute()
    {
        $media = $this->getMedia('profile')->last();
        if ($media) {
            return ['url' => $media->getUrl(), 'name' => $media->name, 'human_readable_size' => $media->human_readable_size];
        } else {
            return ['url' => asset(self::$defultImage), 'name' => 'default.jpg', 'human_readable_size' => 'unknown'];
        }

    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make('password'),
        );
    }
}
