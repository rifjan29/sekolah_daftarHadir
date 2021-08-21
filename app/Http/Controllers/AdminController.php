<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    private $params;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['admin'] = User::orderBy('created_at', 'DESC')->get();

        return view('admin.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'username' => 'required|min:4|unique:users,username|max:30',
            'gender' => 'not_in:0',
            'password' => 'required|min:4'
        ],
        [
            'required' => ':attribute harus diisi.',
            'not_in' => ':attribute harus dipilih.',
            'min' => 'Minimal 4 karakter.',
            'nama.max' => 'Maksimal 50 karakter.',
            'username.max' => 'Maksimal 30 karakter.',
            'unique' => ':attribute telah digunakan.'
        ],
        [
            'nama' => 'Nama',
            'username' => 'Username',
            'gender' => 'Jenis Kelamin',
            'password' => 'Password'
        ]);

        try {
            $newAdmin = new User;
            $newAdmin->name =  $request->get('nama');
            $newAdmin->username = $request->get('username');
            $newAdmin->gender = $request->get('gender');
            $newAdmin->password = \Hash::make($request->get('password'));
            $newAdmin->save();
            
            return redirect('/admin')->withStatus('Berhasil menyimpan data.');
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
        //
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
            $this->params['admin'] = User::findOrFail($id);

            return view('admin.edit', $this->params);
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
        $editAdmin = User::findOrFail($id);

        $usernameUnique = $request->get('username') != $editAdmin->username ? '|unique:users,username' : '';

        $this->validate($request, 
        [
            'nama' => 'required|max:50|string',
            'username' => 'required|min:4|max:30'.$usernameUnique,
            'gender' => 'not_in:0',
            'password' => 'required|min:4'
        ],
        [
            'required' => ':attribute harus diisi.',
            'not_in' => ':attribute harus dipilih.',
            'min' => 'Minimal 4 karakter.',
            'nama.max' => 'Maksimal 50 karakter.',
            'username.max' => 'Maksimal 30 karakter.',
            'unique' => ':attribute telah digunakan.'
        ],
        [
            'nama' => 'Nama',
            'username' => 'Username',
            'gender' => 'Jenis Kelamin',
            'password' => 'Password'
        ]);

        try {
            $editAdmin->name =  $request->get('nama');
            $editAdmin->username = $request->get('username');
            $editAdmin->gender = $request->get('gender');
            $editAdmin->password = \Hash::make($request->get('password'));
            $editAdmin->save();
            
            return redirect('/admin')->withStatus('Berhasil menyimpan data.');
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
            $deleteAdmin = User::findOrFail($id);
            if($deleteAdmin->id == auth()->user()->id) {
                // user sedang digunakan / login
                return back()->withError('Akun sedang digunakan. Silahkan logout dan menggunakan akun lainnya.');
            }
            else {
                $deleteAdmin->delete();
                return back()->withStatus('Berhasil menghapus data.');
            }
        }
        catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.'.$e->getMessage());
        }    
    }
}
