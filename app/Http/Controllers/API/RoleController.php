<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/roles",
     *      operationId="getRoleList",
     *      tags={"Roles"},
     *      summary="Get list of role by user",
     *      description="Returns role list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="type",
     *            description="[All/Role]",
     *            example="All",
     *            required=true,
     *            in="query",
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
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'Lấy thành công danh sách Role',
            'data' => Role::all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/roles",
     *      operationId="createRole",
     *      tags={"Roles"},
     *      summary="create role",
     *      description="create role",
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
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 example={"name": "Loai nguoi dung moi", "description": "mo ta"}
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
        if (User::where('name', $request->name)->exists()) {
            return response()->json([
                'stauts' => 'error',
                'msg' => 'Loại người dùng đã tồn tại',
            ]);
        } else {
            $new_role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'stauts' => 'success',
                'msg' => 'Thêm loại người dùng thành công!',
                'newRole' => $new_role,
                'roleList' => Role::all()
            ]);
        }
    }

    /**
     * @OA\Patch(
     *      path="/api/roles",
     *      operationId="updateRole",
     *      tags={"Roles"},
     *      summary="update role",
     *      description="update role",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="id",
     *            description="id",
     *            example="1",
     *            required=true,
     *            in="query",
     *            @OA\Schema(
     *                type="integer"
     *            )
     *        ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 example={"name": "Loai nguoi dung moi", "description": "mo ta"}
     *             )
     *         )
     *     ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function update(Request $request, Role $role)
    {
        $update = Role::find($role->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Chỉnh sửa loại người dùng thành công!',
            'role' => $update,
            'roleList' => Role::all()
        ]);
    }

    /**
     * @OA\delete(
     *      path="/api/roles",
     *      operationId="deleteRole",
     *      tags={"Roles"},
     *      summary="delete role",
     *      description="delete role",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Parameter(
     *            name="id",
     *            description="id",
     *            example="1",
     *            required=true,
     *            in="query",
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
    public function destroy(Role $role)
    {
        Role::find($role->id)->delete();

        return response()->json([
            'status' => 'success',
            'msg' => 'Xóa loại người dùng thành công!',
            'role' => $role,
            'roleList' => Role::all()
        ]);
    }
}
