<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('app.pagination.limit');
        // Ambil semua user dengan role kasir
        $kasirs = ModelsUser::where('role', 'employee')->paginate($limit);

        // Tampilkan kasir yang dihapus dengan pagination juga
        $deletedKasirs = ModelsUser::onlyTrashed()->where('role', 'kasir')->paginate(10);

        // Kirim data ke view
        return view('kasir.index', compact('kasirs','deletedKasirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        ModelsUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
        ]);

        return redirect()->route('kasir.create')->with('success', 'Kasir berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kasir = User::findOrFail($id);
        return view('kasir.edit', compact('kasir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $kasir = ModelsUser::findOrFail($id);
        $kasir->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('kasir.index')->with('success', 'Kasir berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kasir = User::findOrFail($id);

        if ($kasir->role !== 'employee') {
            return redirect()->route('kasir.index')->with('error', 'Hanya kasir yang bisa dihapus!');
        }

        $kasir->delete();

        return redirect()->route('kasir.index')->with('success', 'Kasir berhasil dihapus!');
    }
}
