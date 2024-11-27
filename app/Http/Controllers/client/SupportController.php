<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function contact()
    {
        return view('client.us.contact');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'phone' => ['required', 'max:10', 'regex:/^\d+$/'],
                'content' => ['required']
            ],
            [
                'name.required' => 'Vui lòng nhập',
                'email.required' => 'Vui lòng nhập',
                'email.regex' => 'Email không hợp lệ',
                'phone.required' => 'Vui lòng nhập',
                'phone.max' => 'Tối đa 10 số',
                'phone.regex' => 'Số điện thoại không hợp lệ',
                'content.required' => 'Vui lòng nhập',
            ]
        );
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request['content']
        ]);
        return response()->json(['message' => 'done']);
    }
    public function about()
    {
        return view('client.us.about');
    }
    public function policy(){
        return view('client.us.policy');
    }
    public function return(){
        return view('client.us.return');
    }
}
