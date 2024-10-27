<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;
use App\Http\Requests\PolicyRequest;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::all();
        return view('admin.policy.list-policy', compact('policies'));
    }

    public function show($id)
    {
        $policy = Policy::find($id);
        return view('admin.policy.detail-policy')->with([
            'policy' => $policy
        ]);
    }

    public function create()
    {
        return view('admin.policy.add-policy');
    }

    public function store(PolicyRequest $request)
    {
        Policy::create([
            'title' => $request->title,
            'content_post' => $request->content_post,
        ]);

        return redirect()->route('policies.index');
    }

    public function edit($id)
    {
        $policy = Policy::find($id);

        // Kiểm tra nếu không tìm thấy chính sách
        if (!$policy) {
            return redirect()->route('policies.index')->with('error', 'Không tìm thấy chính sách.');
        }

        return view('admin.policy.update-policy')->with([
            'policy' => [$policy] 
        ]);
    }

    public function update($id, PolicyRequest $request)
    {
        $policy = Policy::find($id);

        if (!$policy) {
            return redirect()->route('policies.index')->with('error', 'Không tìm thấy chính sách để cập nhật.');
        }

        $policy->update([
            'title' => $request->title,
            'content_post' => $request->content_post,
        ]);

        return redirect()->route('policies.index')->with('success', 'Chính sách đã được cập nhật thành công.');
    }


    public function destroy($id)
    {
        Policy::find($id)->delete();
        return redirect()->route('policies.index')->with([
            'message' => 'Xóa thành công nha ^ ^'
        ]);
    }
}
