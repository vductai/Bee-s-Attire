<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $list = Whishlist::where('user_id', Auth::user()->user_id)->get();
        return view('client.wish-list', compact('list'));
    }

    public function store(Request $request){
        $wishListItem = Whishlist::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
        if ($wishListItem){
            $wishListItem->delete();
            return response()->json(['success' => true,'message' => 'done']);
        } else{
            Whishlist::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id
            ]);
            return response()->json(['success' => true ,'message' => 'add']);
        }
    }

    public function show($id){
        $show = Whishlist::findOrFail($id);
        return response()->json($show);
    }

    public function delete($id){
        $del = Whishlist::findOrFail($id);
        $del->delete();
        return response()->json(['message' => 'done']);
    }
}
