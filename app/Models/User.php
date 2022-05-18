<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @OA\Property()
     *
     * @var integer
     */
    protected $id;

    /**
     * @OA\Property()
     *
     * @var string
     */

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $email;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $email_verified_at;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $password;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $remember_token;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $created_at;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $updated_at;


    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}
