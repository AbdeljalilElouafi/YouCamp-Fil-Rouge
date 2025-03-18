<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManagerApprovalNotification;

class AdminManagerController extends Controller
{
    public function index()
    {
        $pendingManagers = User::where('status', 'pending')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'manager');
            })
            ->get();

        return view('admin.managers', compact('pendingManagers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        
        Mail::to($user->email)->send(new ManagerApprovalNotification($user));

        return redirect()->route('admin.managers')->with('success', 'Manager approved successfully.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return redirect()->route('admin.managers')->with('success', 'Manager rejected successfully.');
    }
}
