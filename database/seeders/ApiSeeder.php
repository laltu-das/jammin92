<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add Ticketmaster API
        Api::setValue(
            'ticketmaster_api',
            'NWnK3wGB9BjhaJ0YlE7q0AwT6RFYufpf',
            'api_key',
            'Ticketmaster Discovery API for concert and event data'
        );

        $this->command->info('Ticketmaster API key added successfully!');
    }
}
