<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\RepContactJob;
use App\Mail\RepContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    public function index()
    {
        $list = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.message.list-message', compact('list'));
    }

    public function edit($id){
        $get = Contact::findOrFail($id);
        return view('admin.message.rep-contact', compact('get'));
    }

    public function repContact(Request $request){
        $request->validate(
            [
                'repContact' => 'required'
            ],
            [
                'repContact' => 'Vui lòng nhập'
            ]
        );
        $mess = Contact::findOrFail($request->id);
        $mess->update([
            'action' => 'Đã trả lời'
        ]);
        $rep = $request->repContact;
        $content = $request['content'];
        RepContactJob::dispatch($request->email, $request->name, $content, $rep);
        return response()->json(['message' => 'done']);
    }
}
