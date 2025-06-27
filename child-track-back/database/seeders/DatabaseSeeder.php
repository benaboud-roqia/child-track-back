<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Baladya;
use App\Models\Api\Extra\Wilaya;
use App\Models\Api\User\Admin;
use App\Models\Api\User\Gurdian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BaladyaWilayaSeeder::class,
            UsersSeeder::class,
        ]);

        $a = Admin::create([
            'username' => 'Dev_Script_3124',
            'name' => 'Djalil',
            'last' => 'Lamin',
        ]);
        $key = $a->key()->create(['value' => Str::random(32)]);
        $key->user()->create(['email' => 'admin@gmail.com', 'password' => 'password']);
        $g =Gurdian::create([
            'username' => 'guardian-12345',
            'name' => 'Ali',
            'last' => 'Mohamed',
            'date_of_birth' => '1990-01-01',
            'baladya_id' => Baladya::first()->id,
        ]);
        $g->phones()->create(['number' => '0666000000']);
        $g->phones()->create(['number' => '0777000000']);
        $g->phones()->create(['number' => '0555000000']);
        $key = $g->key()->create(['value' => Str::random(32)]);
        $key->user()->create(['email' => 'fouzi@gmail.com', 'password' => 'password']);

        $gurdian = Gurdian::find(41);

        DB::beginTransaction();
        try {
            if ($gurdian) {
                $baladyaId = Baladya::first()->id;

                // Common radius for all circles
                $radius = 300; // meters
                $earthRadius = 6378137;

                // Child 1 - ✅ inside zone
                $child1Lat = 35.8763;
                $child1Lng = 7.1135;

                $child1 = $gurdian->childrens()->create([
                    'username' => 'ali-son1',
                    'name' => 'Sami',
                    'last' => 'Mohamed',
                    'date_of_birth' => '2010-01-01',
                    'baladya_id' => $baladyaId,
                ]);

                $bracelet1 = $child1->braclet()->create([
                    'mac' => '00:11:22:33:44:10',
                    'status' => 'on',
                ]);

                $bracelet1->location()->create([
                    'lat' => 35.8765, // ~22 meters north
                    'lng' => 7.1136,
                ]);

                $bracelet1->circle()->create([
                    'radius' => $radius,
                ])->location()->create([
                            'lat' => $child1Lat,
                            'lng' => $child1Lng,
                        ]);

                // Child 2 - ✅ inside zone
                $child2Lat = 35.8841;
                $child2Lng = 7.0948;

                $child2 = $gurdian->childrens()->create([
                    'username' => 'ali-son2',
                    'name' => 'Amine',
                    'last' => 'Mohamed',
                    'date_of_birth' => '2012-05-10',
                    'baladya_id' => $baladyaId,
                ]);

                $bracelet2 = $child2->braclet()->create([
                    'mac' => '00:11:22:33:44:11',
                    'status' => 'on',
                ]);

                $bracelet2->location()->create([
                    'lat' => 35.8820, // ~270 meters away
                    'lng' => 7.0970,
                ]);

                $bracelet2->circle()->create([
                    'radius' => $radius,
                ])->location()->create([
                            'lat' => $child2Lat,
                            'lng' => $child2Lng,
                        ]);

                // Child 3 - ❌ outside zone
                $child3Lat = 35.8652;
                $child3Lng = 7.1239;

                $child3 = $gurdian->childrens()->create([
                    'username' => 'ali-son3',
                    'name' => 'Yacine',
                    'last' => 'Mohamed',
                    'date_of_birth' => '2015-08-20',
                    'baladya_id' => $baladyaId,
                ]);

                $bracelet3 = $child3->braclet()->create([
                    'mac' => '00:11:22:33:44:12',
                    'status' => 'on',
                ]);

                $bracelet3->location()->create([
                    'lat' => 35.8610, // ~700+ meters south-east
                    'lng' => 7.1300,
                ]);

                $bracelet3->circle()->create([
                    'radius' => $radius,
                ])->location()->create([
                            'lat' => $child3Lat,
                            'lng' => $child3Lng,
                        ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
