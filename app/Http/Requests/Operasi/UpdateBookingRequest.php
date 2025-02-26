<?php

namespace App\Http\Requests\Operasi;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
}
