<?php
//
//namespace App\Http\Controllers;
//
//use App\Http\request\RoleRequest;
//use App\Models\role;
//use Illuminate\Http\Request;
//
//class RolesController extends Controller
//{
//    public function index()
//    {
//        $list = role::all();
//        return response()->json([
//            'mes' => 'list',
//            'data' => $list
//        ]);
//    }
//
//    public function store(RoleRequest $request)
//    {
//        $create = role::create([
//            'role_name' => $request->role_name,
//            'role_desc' => $request->role_desc
//        ]);
//
//        return response()->json([
//            'message' => 'fall',
//            'data' => $create
//        ]);
//    }
//
//    public function update(RoleRequest $request , $id){
//        $update = role::where('role_id',$id)->update([
//            'role_name' => $request->role_name,
//            'role_desc' => $request->role_desc
//        ]);
//
//        return response()->json([
//            'message' => 'fall',
//            'data' => $update
//        ]);
//    }
//
//    public function delete($id){
//        $del = role::destroy($id);
//        return response()->json([
//            'message' => 'fall',
//            'data' => $del
//        ]);
//    }
//}
