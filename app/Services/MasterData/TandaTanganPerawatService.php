<?php

namespace App\Services\MasterData;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\TtdDokter;
use App\Models\MasterData\TtdPerawat;
use App\Models\Operasi\BookingOperasi;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class TandaTanganPerawatService
{

    
    private function baseQuery(){
        if ((auth()->user()->roles->pluck('name')[0]) != 'super-admin'){
            $user_id = auth()->user()->id;
            return TtdPerawat::with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                },
            ])
            ->where('user_id',$user_id)
            ->get();
        } 
        else{
            return TtdPerawat::with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                },
            ])
            ->get();
        }
    }

    public function get(){
        $ttdperawat = $this->baseQuery();
        return $this->mapData($ttdperawat);
    }

    public function findbyid($id){

        return TtdPerawat::find($id);

    }

    private function mapData($ttdperawat){

        return collect($ttdperawat->map(function($item){
            return (object)[
                'id'=>$item->id,
                'nama_perawat'=>$item->user->name,
                'ttd_perawat'=>$item->ttd_perawat,
                'created_at' => $item->created_at->format('Y-m-d H:i:s') ?? '',
                'updated_at' => $item->updated_at->format('Y-m-d H:i:s') ?? ''
            ];
        }));
    }

    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['ttd_perawat']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['user_id'] . '-' . 'ttd_perawat' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        $data['ttd_perawat'] = $file_name;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {
            $ttddokter = TtdPerawat::create([
                'user_id' => $data['user_id'],
                'ttd_perawat' => $data['ttd_perawat'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            Storage::put('public/ttd/perawat/' . $file_name, $image_base64);

            return $ttddokter;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan tanda tangan: " . $th->getMessage());
        }
    }

    public function update($id,array $data,)
    {
        $image_parts = explode(";base64,", $data['ttd_perawat']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['user_id'] . '-' . 'ttd_perawat' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

      

        try {
            $ttdperawat = TtdPerawat::findOrFail($id);
            if ($ttdperawat->ttd_perawat) {
                Storage::delete('public/ttd/perawat/' . $ttdperawat->ttd_perawat);
            }
            // Melakukan update data
            $ttdperawat->update([
                'user_id' => $data['user_id'],
                'ttd_perawat' => $file_name,
                'updated_at' => $data['updated_at']
            ]);

            Storage::put('public/ttd/perawat/' . $file_name, $image_base64);

            return $ttdperawat;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui tanda tangan: " . $th->getMessage());
        }
    }

    public function delete($id){

        try {
            
            $data = TtdPerawat::find($id);
            

        if ($data) {
            $pathImage = 'public/ttd/perawat/' . $data->ttd_perawat;
            Storage::delete($pathImage);
            return $data->delete();
        }
            
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Gagal menghapus tanda tangan: " . $th->getMessage());
        }

    }


}