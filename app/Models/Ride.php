<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class Ride extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'active', 'start_time', 'finish_time'];

    /**
     * @OA\Property()
     *
     * @var integer
     */
    protected $id;

    /**
     * @OA\Property()
     *
     * @var integer
     */
    protected $user_id;

    /**
     * @OA\Property()
     *
     * @var integer
     */
    protected $car_id;

    /**
     * @OA\Property()
     *
     * @var boolean
     */
    protected $active;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $start_time;

    /**
     * @OA\Property()
     *
     * @var string
     */
    protected $finish_time;

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

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
