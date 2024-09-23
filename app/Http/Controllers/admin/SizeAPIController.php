<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SizeAPIController extends Controller
{


    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $sizes = Size::all();
        return response()->json([
            'message' => 'list',
            'data' => $sizes
        ]);
    }


    public function store(SizeRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $size = Size::create($request->validated());
        return response()->json($size);
    }


    public function show($size_id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $size = Size::find($size_id);

        if (!$size) {
            return response()->json(['message' => 'Không tìm thấy Size.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($size);
    }


    public function update(SizeRequest $request, Size $size)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $data = $request->validated();

        $size->update($data);
        return response()->json($size);
    }


    public function destroy($id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $size = Size::find($id);

        if (!$size) {
            return response()->json(['message' => 'Không tìm thấy Size.']);
        }

        $size->delete();
        return response()->json(['message' => 'Size deleted successfully.']);
    }
}
