<?php

namespace App\Http\Controllers\MasterData;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MasterData\TandaTanganPerawatService;
use App\Http\Requests\MasterData\TtdPerawat\StoreTtdPerawat;

class TtdPerawatController extends Controller
{
    protected $view;
    protected $prefix;
    protected $ttdTandaOperasi;

    //menggunakan services
    protected $tandaTanganPerawatService;
    protected $userModel;

    public function __construct()
    {
        $this->view='pages.md.ttd-perawat.';
        $this->prefix='Tandan Tangan Dokter.';
        $this->tandaTanganPerawatService= new TandaTanganPerawatService;
    }
    
    public function index()
    {
        //
        $ttdPerawats = $this->tandaTanganPerawatService->get();
        // dd($user);
        return view($this->view . 'index', compact('ttdPerawats'))->with([
            'title' => 'Tanda Tangan Perawat'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view($this->view . 'create',compact('users'))->with([
            'title' => 'Form pembuatan tanda tangan perawat'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTtdPerawat $request)
    {
        //
        try {

            $this->tandaTanganPerawatService->insert($request->validated());

            return redirect()->route('ttd-perawat.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan tanda tangan: ' . $e->getMessage());
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
        $ttdperawat = $this->tandaTanganPerawatService->findbyid($id);
        // dd($ttdperawat);
        return view($this->view . 'edit',compact('ttdperawat'))->with([
            'title' => 'Form edit tanda tangan perawat', 
            'users' => User::all()
        ]);
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
        try {
            $data = [
                'user_id' => $request->user_id,
                'ttd_perawat' => $request->ttd_perawat,
                'updated_at' => date('Y-m-d H:i:s'),
            
            ];

            $this->tandaTanganPerawatService->update($id,$data);

            return redirect()->route('ttd-perawat.index')->with('success', 'Tanda tangan berhasil diperbarui.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal memperbarui tanda tangan: ' . $e->getMessage());
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
        //
        try {

            $this->tandaTanganPerawatService->delete($id);
            return redirect()->route('ttd-perawat.index')->with('success','Tanda tangan berhasil dihapus');
            //code...
        } catch (\Throwable $e) {
            //throw $th;
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menghapus tanda tangan: ' . $e->getMessage());
            
        }
    }
}
