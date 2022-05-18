<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class Car extends Model
{
    use HasFactory;

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
    protected $name;

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
