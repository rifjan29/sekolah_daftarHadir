<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['guru'] = Guru::orderBy('created_at', 'DESC')->get();

        return view('guru.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nama' => 'required|max:50|string',
            'gender' => 'not_in:0',
        ],
        [
            'required' => ':attribute harus diisi.',
            'not_in' => ':attribute harus dipilih.',
            'max' => 'Maksimal 50 karakter.',
        ],
        [
            'nama' => 'Nama',
            'gender' => 'Jenis Kelamin',
        ]);

        try {
            $newGuru = new Guru;
            $newGuru->nama =  $request->get('nama');
            $newGuru->nip = $request->get('nip');
            $newGuru->gender = $request->get('gender');
            $newGuru->user_id = auth()->user()->id;
            $newGuru->save();
            
            return redirect('/guru')->withStatus('Berhasil menyimpan data.');
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $this->params['guru'] = Guru::select('guru.*', 'users.name')->join('users', 'users.id', 'guru.user_id')->where('guru.id', $id)->first();

            return view('guru.detail', $this->params);
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $this->params['guru'] = Guru::findOrFail($id);

            return view('guru.edit', $this->params);
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
        [
            'nama' => 'required|max:50|string',
            'gender' => 'not_in:0',
        ],
        [
            'required' => ':attribute harus diisi.',
            'not_in' => ':attribute harus dipilih.',
            'max' => 'Maksimal 50 karakter.',
        ],
        [
            'nama' => 'Nama',
            'gender' => 'Jenis Kelamin',
        ]);

        try {
            $editGuru = Guru::findOrFail($id);
            $editGuru->nama =  $request->get('nama');
            $editGuru->nip = $request->get('nip');
            $editGuru->gender = $request->get('gender');
            $editGuru->user_id = auth()->user()->id;
            $editGuru->save();
            
            return redirect('/guru')->withStatus('Berhasil menyimpan data.');
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleteGuru = Guru::findOrFail($id);
            $deleteGuru->delete();

            return back()->withStatus('Berhasil menghapus data.');
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }
}
