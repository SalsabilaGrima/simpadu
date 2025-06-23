<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $data = ['nama' => "bibia", 'foto' => 'avatar2.png'];
         $mahasiswa = Mahasiswa::with('prodi')->get();
         return view('mahasiswa.index', compact('data', 'mahasiswa'));
         
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = ['nama' => "bibia", 'foto' => 'avatar2.png'];
        $prodi = Prodi::all();
        return view('mahasiswa.create', compact('data', 'prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'nim' =>'required|unique:mahasiswa|max 10',
                'password' =>'required',
                'nama' => 'required|max:100',
                'tanggal_lahir' =>'required',
                'telepon' =>'required|max:20',
                'email' =>'required|max:100',
                'foto' =>'image|file|max:2048',

            ],
            [
                'nim.required' => 'NIM harus diisi',
                'nim.unique' => 'NIM sudah terdaftar',
                'nim.max' => 'NIM maksimal 10 karakter',
                'password.required' => 'Password wajib diisi',
                'nama.required' => 'Nama harus diisi',
                'tanggal_lahir.required' => 'tanggal lahir harus diisi',
                'telepon.required' => 'telepon harus diisi',
                'email.required' => 'email harus diisi',
            ]
            );
            if ($request->file('foto')) {
                $validateData['foto'] = $request->file('foto')->store('image');
            }
        $validateData['password'] = Hash::make($validateData['password']);
        $data=array_merge($validateData, $request->only(['id']));
        Mahasiswa::create($data);
        return redirect('/mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $data = ['nama' => "bibia", 'foto' => 'avatar2.png'];
         $mahasiswa = Mahasiswa::find($id);
        $prodi = Prodi::all();
        return view('mahasiswa.edit', compact('data', 'mahasiswa', 'prodi'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validateData = $request->validate(
            [
                'nama' => 'required|max:100',
                'tanggal_lahir' => 'required',
                'telepon' => 'required|max:20',
                'email' => 'required|max:100',
                'foto' => 'image|file|max:2048',

            ],
            [
                'password.required' => 'Password wajib diisi',
                'nama.required' => 'Nama harus diisi',
                'tanggal_lahir.required' => 'tanggal lahir harus diisi',
                'telepon.required' => 'telepon harus diisi',
                'email.required' => 'email harus diisi',
                'foto' => 'FILE harus berupa gambar',

            ]
            );
            $mahasiswa = Mahasiswa::find ($id);
            if ($request->file('foto')) {
              if ($mahasiswa->foto) {
                Storage::delete($mahasiswa->foto);
            }
        if ($request->only(['password'])){
            $validateData['password'] = Hash::make($request->password);
        }
        $data=array_merge($validateData, $request->only(['id']));
        Mahasiswa::where('nim', $id)->update($data);
        return redirect('/mahasiswa');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
