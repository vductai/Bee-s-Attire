<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Http\Response;
use App\Http\Requests\ColorRequest;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Color::query()->latest('id')->paginate(5);

        return response()->json([
            'message' => 'Danh sách người dùng trang . ' . request('page', 1),
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $data = Color::query()->create($request->validated());

        return response()->json([
            'message' => 'Tạo mới thành công',
            'data' => $data
        ], Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        try {
            $data = Color::query()->findOrFail($id);

            return response()->json([
                'message' => 'Chi tiết data id . ' . $id,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Không tồn tại data có id là . ' . $id,
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function update(ColorRequest $request, string $id)
    {
        $data = Color::query()->findOrFail($id);

        $data->update(request()->all());

        return response()->json([
            'message' => 'Sửa thành công data có id . ' . $id,
            'data' => $data
        ]);
    }


    public function destroy(string $id)
    {
        Color::destroy($id);

        return response()->json([
            'message' => 'Xóa thành công',
        ], Response::HTTP_OK);
    }
}
