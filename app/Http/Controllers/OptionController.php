<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @OA\Get(
     *      path="/api/options",
     *      operationId="getOptionList",
     *      tags={"Option System"},
     *      summary="Get options list by name list",
     *      description="Returns option list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="name[]",
     *            description="array name",
     *            example="['logo_name', 'logo_path']",
     *            required=true,
     *            in="query",
     *            @OA\Schema(
     *             type="array",
     *             @OA\Items(type="string")
     *           )
     *        ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function index(Request $request)
    {
        // return response()->json($request->name);

        $list = [];
        foreach ($request->name as $name) {
            $option = Option::where('name', $name);
            $list[] = [
                'name' => $option->name,
                'value' => $option->value,
            ];
        }

        return response()->json($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/options/{name}",
     *      operationId="getOption",
     *      tags={"Option System"},
     *      summary="Get list of option by name",
     *      description="Returns option",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="name",
     *            description="logo",
     *            example="logo_path",
     *            required=true,
     *            in="path",
     *            @OA\Schema(
     *                type="string"
     *            )
     *        ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function show($name)
    {
        return response()->json(Option::where('name', $name)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
