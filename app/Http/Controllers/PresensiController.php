<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Exception;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['data'] = Guru::orderBy('nama')->get(); 

        return view('presensi.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $presensi = $request->get('presensi');
            $tambahPresensi = new Presensi;
            $tambahPresensi->guru_id = $request->get('guru');
            $tambahPresensi->user_id = Auth::id();
            switch ($presensi) {
                case 'Hadir':
                    $tambahPresensi->presensi = $presensi;
                    break;
                case 'Absen':
                    $tambahPresensi->presensi = $presensi;
                    $tambahPresensi->ket = $request->get('ket');
                    break;
                case 'Alpa':
                    $tambahPresensi->presensi = $presensi;
                    break;
                default:
                    # code...
                    break;
            }
            $tambahPresensi->save();
            return redirect('/presensi')->withStatus('Berhasil Presensi');

        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listPresensi()
    {
        try {
            $this->params['data'] = Presensi::select(
                                                'presensi.presensi',
                                                'presensi.ket',
                                                'presensi.created_at',
                                                'users.name',
                                                'guru.nama',
                                                'guru.gender',
                                                'guru.nip',
                                                'guru.jabatan',
                                                'guru.gol',
                                            )
                                            ->join('users', 'users.id', 'presensi.user_id')
                                            ->join('guru', 'guru.id', 'presensi.guru_id')
                                            ->orderBy('guru.nama')
                                            ->get();

            return view('presensi.data-presensi', $this->params);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
