<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNull('deleted_at')->get();
        return view('users.index', compact('users'));
    }

    // Soft delete a user
    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();  // This will only set the `deleted_at` field instead of permanently deleting
        return redirect()->route('users.index')->with('success', 'User soft deleted successfully');
    }

    // Display all trashed users (soft deleted users)
    public function trashed()
    {
        // Get all soft deleted users
        $trashedUsers = User::onlyTrashed()->get();
        return view('users.trashed', compact('trashedUsers'));
    }

    // Force delete a user
    public function forceDelete($id)
    {
        // Find the soft deleted user by ID and permanently delete it
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.trashed')->with('success', 'User force deleted successfully');
    }

    // Restore a soft deleted user
    public function restore($id)
    {
        // Find the soft deleted user by ID and restore it
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trashed')->with('success', 'User restored successfully');
    }
}
