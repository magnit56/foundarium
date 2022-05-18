<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;
use OpenApi\Annotations as OA;

class RideController extends Controller
{
    /**
     * @OA\Post(
     *      path="/rides/{car}/start/{user}",
     *      operationId="start",
     *      tags={"Ride"},
     *      summary="Начать поездку",
     *      description="Метод начинает поездку на автомобиле пользователем",
     *     @OA\Parameter(
     *          name="car",
     *          description="идентификатор автомобиля",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="user",
     *          description="идентификатор пользователя",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Поездка началась",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success": "Поездка началась"}, summary="Успешно"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Автомобиль занят или пользователь уже управляет каким-то автомобилем",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result2", value={"error": "Автомобиль уже управляется каким-то пользователем"}, summary="Автомобиль занят"),
     *             @OA\Examples(example="result3", value={"error": "Пользователь уже управляет каким-то автомобилем"}, summary="Пользователь уже за рулем"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Такого автомобиля или пользователя не существует",
     *     ),
     *     @OA\Response(
     *         response=520,
     *         description="Неизвестная ошибка",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result4", value={"error": "Какая-то ошибка"}, summary="Неизвестная ошибка"),
     *         )
     *     ),
     * )
     */
    public function start(Car $car, User $user)
    {
        $countOfCarActiveRides = Ride::where('active', true)->where('car_id', $car->id)->count();
        if ($countOfCarActiveRides > 0) {
            return response()->json(['error' => 'Автомобиль уже управляется каким-то пользователем'], 400);
        }

        $countOfUserActiveRides = Ride::where('active', true)->where('user_id', $user->id)->count();
        if ($countOfUserActiveRides > 0) {
            return response()->json(['error' => 'Пользователь уже управляет каким-то автомобилем'], 400);
        }

        $ride = Ride::create([
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);
        return ($ride->save()) ?
            response()->json(['success' => 'Поездка началась'], 201) :
            response()->json(['error' => 'Какая-то ошибка'], 520);
    }


    /**
     * @OA\Patch(
     *      path="/rides/{car}/finish",
     *      operationId="finish",
     *      tags={"Ride"},
     *      summary="Окончить поездку",
     *      description="Метод оканчивает поездку на автомобиле",
     *     @OA\Parameter(
     *          name="car",
     *          description="идентификатор автомобиля",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Поездка окончена",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result5", value={"success": "Поездка окончена"}, summary="Успешно"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Такой автомобиль не управляется кем-либо или не существует",
     *     ),
     *     @OA\Response(
     *         response=520,
     *         description="Неизвестная ошибка",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result6", value={"error": "Какая-то ошибка"}, summary="Неизвестная ошибка"),
     *         )
     *     ),
     * )
     */
    public function finish(Car $car)
    {
        $ride = Ride::where('active', true)->where('car_id', $car->id)->firstOrFail();
        $ride->fill([
            'active' => false,
            'finish_time' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
        return ($ride->save()) ?
            response()->json(['success' => 'Поездка окончена'], 201) :
            response()->json(['error' => 'Какая-то ошибка'], 520);
    }
}
