<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/seasons",
     *      operationId="getSeasonList",
     *      tags={"Seasons"},
     *      summary="Get list of season",
     *      description="Returns season list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'Get season list completed',
            'data' => Season::all(),
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/seasons",
     *      operationId="newSeason",
     *      tags={"Seasons"},
     *      summary="New Season",
     *      description="",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 example={"name": "2023",}
     *             )
     *         )
     *     ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/seasons/{id}",
     *      operationId="getSeasonDetails",
     *      tags={"Seasons"},
     *      summary="show Season",
     *      description="",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="id",
     *            description="season_id",
     *            example="1",
     *            required=false,
     *            in="path",
     *            @OA\Schema(
     *                type="integer"
     *            )
     *        ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function show(Season $season)
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'Season details',
            'data' => $season
        ]);
    }

    /**
     * @OA\Patch(
     *      path="/api/seasons/{id}",
     *      operationId="updateSeason",
     *      tags={"Seasons"},
     *      summary="Update Season",
     *      description="",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 example={"name": "2023",}
     *             )
     *         )
     *     ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        //
    }
}
