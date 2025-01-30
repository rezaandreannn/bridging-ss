<?php

namespace App\Http\Requests\Operasi;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_register' => 'required|string',
            'tanggal' => 'required',
            'asal_ruangan' => 'required',
            'kode_dokter' => 'required',
            // 'jenis_operasi' => 'required',
            'rencana_operasi' => 'nullable',
            // 'cara_masuk' => 'nullable|string'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $kodeRegister = $this->input('kode_register');

            $exists = DB::connection('pku')
                ->table('ok_booking_operasi')
                ->where('kode_register', $kodeRegister)
                ->exists();

            if ($exists) {
                $validator->errors()->add('kode_register', 'Kode register sudah ada.');
            }
        });
    }
}
