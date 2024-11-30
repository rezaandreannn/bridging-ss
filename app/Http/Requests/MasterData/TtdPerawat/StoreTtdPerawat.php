<?php

namespace App\Http\Requests\MasterData\TtdPerawat;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreTtdPerawat extends FormRequest
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
            'user_id' => 'required|string',
            'ttd_perawat' => 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user_id = $this->input('user_id');

            $exists = DB::connection('pku')
                ->table('ttd_perawat')
                ->where('user_id', $user_id)
                ->exists();

            if ($exists) {
                $validator->errors()->add('user_id', 'user tersebut sudah memiliki tanda tangan.');
            }
        });
    }
}
