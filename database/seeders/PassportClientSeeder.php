<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;

class PassportClientSeeder extends Seeder
{
    /**
     * Seed the application's database for passport client.
     */
    public function run(): void
    {
        $clientRepo = new ClientRepository();

        // Create client password
        $clientRepo->createPasswordGrantClient(
            null, 'Laravel Password Grant Client', 'http://localhost'
        );
        
        //Create personal access token client
        $client = $clientRepo->createPersonalAccessClient(
            null, 'Laravel Personal Access Client', 'http://localhost'
        );

        //Update client with add provider
        DB::table('oauth_clients')
            ->where('id', $client->id)
            ->update(['provider' => 'employees']);

        //Save personal access client ID to env
        file_put_contents(
            app()->environmentFilePath(),
            "\nPASSPORT_PERSONAL_ACCESS_CLIENT_ID=".$client->id,
            FILE_APPEND
        );

        file_put_contents(
            app()->environmentFilePath(),
            "\nPASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=".$client->secret,
            FILE_APPEND
        );
    }
}
