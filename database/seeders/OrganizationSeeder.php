<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Services\SatuSehat\OrganizationService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    protected $organization;

    public function __construct()
    {
        $this->organization = new OrganizationService();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $organizationId = env('SATU_SEHAT_ORGANIZATION_ID');

        $result = $this->organization->getRequest('Organization/' . $organizationId);

        Organization::create([
            'organization_id' => $result['id'],
            'active' => true,
            'name' => $result['name'],
            'created_by' => 'seeder'
        ]);
    }
}
