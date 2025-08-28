<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Laravel\Jetstream\Jetstream;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user if none exists
        if (User::count() === 0) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            // Create a default team for the user
            if (class_exists(\Laravel\Jetstream\Jetstream::class) && \Laravel\Jetstream\Jetstream::hasTeamFeatures()) {
                $team = $user->ownedTeams()->create([
                    'name' => 'Default Team',
                    'personal_team' => true,
                ]);
                
                $user->switchTeam($team);
            }
        } else {
            // Check if existing users have teams, create if they don't
            if (class_exists(\Laravel\Jetstream\Jetstream::class) && \Laravel\Jetstream\Jetstream::hasTeamFeatures()) {
                $usersWithoutTeams = User::whereDoesntHave('ownedTeams')->get();
                
                foreach ($usersWithoutTeams as $user) {
                    $team = $user->ownedTeams()->create([
                        'name' => $user->name . "'s Team",
                        'personal_team' => true,
                    ]);
                    
                    $user->switchTeam($team);
                }
            }
        }

        // Create sample companies if none exist
        if (Company::count() === 0) {
            $companies = [
                [
                    'name' => 'Acme Corporation',
                    'email' => 'info@acme.com',
                    'phone' => '+1-555-0123',
                    'street' => '123 Business Ave',
                    'city' => 'New York',
                    'state' => 'NY',
                    'zip' => '10001',
                    'country' => 'USA',
                    'website' => 'https://acme.com',
                    'notes' => 'Leading technology company specializing in innovative solutions.',
                ],
                [
                    'name' => 'TechStart Inc',
                    'email' => 'hello@techstart.com',
                    'phone' => '+1-555-0456',
                    'street' => '456 Innovation Blvd',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'zip' => '94102',
                    'country' => 'USA',
                    'website' => 'https://techstart.com',
                    'notes' => 'Startup focused on AI and machine learning.',
                ],
                [
                    'name' => 'Global Solutions Ltd',
                    'email' => 'contact@globalsolutions.com',
                    'phone' => '+44-20-1234-5678',
                    'street' => '789 Enterprise St',
                    'city' => 'London',
                    'state' => '',
                    'zip' => 'SW1A 1AA',
                    'country' => 'UK',
                    'website' => 'https://globalsolutions.com',
                    'notes' => 'International consulting firm with offices worldwide.',
                ],
            ];

            foreach ($companies as $companyData) {
                Company::create($companyData);
            }
        }

        // Create sample contacts if none exist
        if (Contact::count() === 0) {
            $contacts = [
                [
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'email' => 'john.smith@acme.com',
                    'phone' => '+1-555-0124',
                    'job_title' => 'CEO',
                    'user_general_note' => 'Key decision maker, prefers email communication.',
                    'company_id' => 1,
                ],
                [
                    'first_name' => 'Sarah',
                    'last_name' => 'Johnson',
                    'email' => 'sarah.johnson@acme.com',
                    'phone' => '+1-555-0125',
                    'job_title' => 'Marketing Director',
                    'user_general_note' => 'Great contact for marketing initiatives.',
                    'company_id' => 1,
                ],
                [
                    'first_name' => 'Mike',
                    'last_name' => 'Chen',
                    'email' => 'mike.chen@techstart.com',
                    'phone' => '+1-555-0457',
                    'job_title' => 'CTO',
                    'user_general_note' => 'Technical expert, interested in partnerships.',
                    'company_id' => 2,
                ],
                [
                    'first_name' => 'Emma',
                    'last_name' => 'Wilson',
                    'email' => 'emma.wilson@globalsolutions.com',
                    'phone' => '+44-20-1234-5679',
                    'job_title' => 'Business Development Manager',
                    'user_general_note' => 'Responsible for European market expansion.',
                    'company_id' => 3,
                ],
            ];

            foreach ($contacts as $contactData) {
                Contact::create($contactData);
            }
        }
    }
}
