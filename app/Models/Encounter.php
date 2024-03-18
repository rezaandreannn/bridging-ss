<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encounter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
    }

    public static function getData($practitioner_name = null, $created_at = null)
    {
        try {
            $query = self::query();

            // Add conditions for filtering if provided
            if ($practitioner_name !== null) {
                $query->where('practitioner_name', $practitioner_name);
            }
            if ($created_at !== null) {
                // If $tanggal is provided, use it. Otherwise, use the current date
                $query->whereDate('created_at', $created_at);
            }

            // Execute the query and fetch the data
            $data = $query->get();

            // Return the fetched data
            return $data;
        } catch (\Exception $e) {
            // Handle errors
            return []; // Returning an empty array if an error occurs
        }
    }

    public function byKodeDokter($kodeDokter = '')
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/dokter/select/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
