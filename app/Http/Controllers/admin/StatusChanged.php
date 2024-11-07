<?php

use App\Events\StatusChanged;
use App\Mail\StatusMail;
use Illuminate\Support\Facades\Mail;

function updateStatus(Request $request)
{
    $statusId = $request->input('status_id');
    $newStatus = $request->input('status');

    $status = Status::find($statusId);
    if (!$status) {
        return response()->json(['success' => false, 'message' => 'Trạng thái không tồn tại.']);
    }

    $status->status = $newStatus;
    $status->save();

  
    event(new StatusChanged($status));

   
    Mail::to($status->user->email)->send(new StatusMail($status));

    return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật và email đã được gửi.']);
}


?>