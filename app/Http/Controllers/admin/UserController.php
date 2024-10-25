<?php

namespace App\Http\Controllers\admin;

use App\Events\UserEvent;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $list = User::all();
        return view('admin.user.list-user', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = User::all();
        $role = role::all();
        return view('admin.user.add-user', compact('list', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
{
    try {
        $this->authorize('manageAdmin', Auth::user());
        
    } catch (AuthorizationException $e) {
    }
    // Tạo mới user
    $user = User::create([
        'username' => $request->username,
        'phone' => $request->phone,
        'address' => $request->address,
        'email' => $request->email,
        'password' => $request->password,
        'birthday' => $request->birthday,
        'role_id' => $request->role_id,
        'gender' => $request->gender,
    ]);


    if ($request->hasFile('avatar')) {
    $file = $request->file('avatar');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $path = public_path('/upload');

    if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }

    $image = Image::read($file);
    $image->resize(600, 600)->save($path . '/' . $filename);
    $user->avatar = $filename;
    } else {
    $defaultAvatarPath = public_path('error-image-default.jpg');
    $filename = time() . '-default-avatar.jpg';
    $destinationPath = public_path('/upload/' . $filename);

    if (File::exists($defaultAvatarPath)) {
        File::copy($defaultAvatarPath, $destinationPath);
    }

    $user->avatar = $filename;
}

$user->save();

broadcast(new UserEvent($user, 'create'))->toOthers();

return response()->json($user);
// return redirect()->route('user.index')->with('success', 'Thêm account thành công');

}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $user = User::where('user_id', $id)->get();
        return response()->json([
            'message' => 'user id',
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $show = User::findOrFail($id);
        return view('admin.user.edit-user',compact('show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $user = User::findOrFail($id);
        
        if ($request->hasFile('avatar')) {
            if (File::exists(public_path('upload/' . $user->avatar))) {
                File::delete(public_path('upload/' . $user->avatar));
            }
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/upload'), $filename);
            $request->merge(['avatar' => $filename]);
            $user->avatar = $filename;
        } else {
            $filename = $user->avatar;
        }

        $user->update([
            'avatar' => $filename,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        broadcast(new UserEvent($user, 'update'))->toOthers();

        return response()->json($user);

        // return redirect()->route('user.index')->with('success', 'Sửa account thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        
        $user = User::find($id);
        if ($user) {
            if (File::exists(public_path('upload/' . $user->avatar))) {
                File::delete(public_path('upload/' . $user->avatar));
            }

            $user->delete();
        }
        return redirect()->route('user.index')->with('error', 'Xóa account thành công');
    }
}
