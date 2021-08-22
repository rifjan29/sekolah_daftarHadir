<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use Illuminate\Support\Facades\Auth;
use Exception;

class BukuTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->params['data'] = BukuTamu::all();
        return view('tamu.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tamu.create');
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
            'nama' => 'required|string',
            'gender' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ],
        [
            'required' => ':attribute'
        ],
        [
            'nama' => 'Nama Lengkap harus terisi',
            'gender' => 'Jenis Kelamin harus terisi',
            'asal' => 'Alamat/Instansi harus terisi dan jelas',
            'tujuan' => 'tujuan harus terisi dan jelas'
        ]);
        try {
            $tambahTamu = new BukuTamu;
            $tambahTamu->nama = $request->get('nama');
            $tambahTamu->gender = $request->get('gender');
            $tambahTamu->asal = $request->get('asal');
            $tambahTamu->tujuan = $request->get('tujuan');
            $tambahTamu->user_id = Auth::id();
            $tambahTamu->save();
            return redirect('/buku-tamu')->withStatus('berhasil menambahkan data tamu.');


        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
    
    public function bukuTamu()
    {
        return view('tamu.index');
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
            $this->params['data'] = BukuTamu::select('buku_tamu.*', 'users.name')->join('users', 'users.id', 'buku_tamu.user_id')->where('buku_tamu.id', $id)->first();
            return view('tamu.detail', $this->params);
        }catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }catch (\Illuminate\Database\QueryException $e) {
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
            $this->params['data'] = BukuTamu::findOrFail($id);
            return view('tamu.edit', $this->params);
        }catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }catch (\Illuminate\Database\QueryException $e) {
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
        $request->validate([
            'nama' => 'required|string',
            'gender' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ],
        [
            'required' => ':attribute'
        ],
        [
            'nama' => 'Nama Lengkap harus terisi',
            'gender' => 'Jenis Kelamin harus terisi',
            'asal' => 'Alamat/Instansi harus terisi dan jelas',
            'tujuan' => 'tujuan harus terisi dan jelas'
        ]);

        try {
            $editTamu = BukuTamu::findOrFail($id);
            $editTamu->nama = $request->get('nama');
            $editTamu->gender = $request->get('gender');
            $editTamu->asal = $request->get('asal');
            $editTamu->tujuan = $request->get('tujuan');
            $editTamu->save();

            return redirect('/buku-tamu')->withStatus('berhasil merubah data');

        }catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }catch (\Illuminate\Database\QueryException $e) {
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
           $deleteTamu = BukuTamu::findOrFail($id);
           $deleteTamu->delete();
           return redirect('/buku-tamu')->withStatus('berhasil menghapus data');
           
        }catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }
    }
}
