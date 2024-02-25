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
            null,
            'Laravel Password Grant Client',
            'http://localhost'
        );

        //Create personal access token client
        $client = $clientRepo->createPersonalAccessClient(
            null,
            'Laravel Personal Access Client',
            'http://localhost'
        );

        //Update client with add provider
        DB::table('oauth_clients')
            ->where('id', $client->id)
            ->update(['provider' => 'employees']);

        // Key in the .env
        $clientIdStr = "PASSPORT_PERSONAL_ACCESS_CLIENT_ID=".$client->id;
        $clientSecretStr = "PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=".$client->secret;

        // Read the existing contents from .env
        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);

        // Update or append the key
        foreach ([$clientIdStr, $clientSecretStr] as $envVarStr) {
            $key = strtok($envVarStr, "=");

            if (str_contains($envContent, $key)) {
                // Replace the existing entry
                $envContent = preg_replace("/^{$key}=.*/m", $envVarStr, $envContent);
            } else {
                // Append the new entry
                $envContent .= "\n{$envVarStr}";
            }
        }

        // Write the changes back to the .env file
        file_put_contents($envPath, $envContent);
    }
}
