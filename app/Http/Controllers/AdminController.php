<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $query->where('role', 'admin');
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('username', 'LIKE', "%{$search}%")
                ->orWhere('kode_organisasi', 'LIKE', "%{$search}%");
            });
        }
        
        $perPage = $request->input('per_page', 10);
        $admins = $query->paginate($perPage)->withQueryString();

        return view('layouts.super_admin.manajemen-admin', compact('admins'));
    }

    public function destroy($username)
    {
        try {
            \Log::info('Attempting to delete admin:', ['username' => $username]);
            
            $admin = User::where('username', $username)->firstOrFail();
            
            $admin->delete();
            \Log::info('Admin deleted successfully');
            
            return redirect()
                ->route('manajemen-admin')
                ->with('success', 'Admin berhasil dihapus.');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting admin:', ['error' => $e->getMessage()]);
            return redirect()
                ->route('manajemen-admin')
                ->with('alert', 'Terjadi kesalahan saat menghapus admin.');
        }
    }
}
