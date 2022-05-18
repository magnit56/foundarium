<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API управления автомобилями",
 *      description="Документация для api управления автомобилями",
 *      @OA\Contact(
 *          email=L5_SWAGGER_CONST_EMAIL
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API управления автомобилями"
 * )
 *
 * @OA\Tag(
 *     name="Методы работы с API",
 *     description="все методы для работы с API"
 * )
 *
 * @OA\PathItem(
 *     path=L5_SWAGGER_CONST_PATH
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
