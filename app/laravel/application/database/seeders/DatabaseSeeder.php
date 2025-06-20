<?php

namespace Database\Seeders;

use App\Enums\Auth\Role;
use App\Models\Client;
use App\Models\Company;
use App\Models\Container;
use App\Models\ContainerType;
use App\Models\PickupResidueContainer;
use App\Models\Residue;
use App\Models\Route;
use App\Models\RoutePickup;
use App\Models\Truck;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\RouteFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(1)->create()->each(function (Company $company) {
            $admins =  User::factory(3)->create(['company_id' => $company->id, 'role' => Role::Admin]);
            User::factory(30)->create(['company_id' => $company->id]);
            $trucks = Truck::factory(30)->create(['company_id' => $company->id]);
            $clients = Client::factory(10)->create(['company_id' => $company->id]);
            $residues = Residue::factory(10)->create(['company_id' => $company->id]);
            $containerTypes = ContainerType::factory(20)->create(['company_id' => $company->id]);


            $clientsContainers = collect();
            foreach ($clients as $client) {
                foreach($containerTypes as $containerType) {
                    $newContainers = $client->containers()->saveMany(Container::factory(2)->make(['container_type_id' => $containerType->id]));
                    $clientsContainers = $clientsContainers->merge($newContainers);
                }
            }

            //Routes and pickups
            $trucksIds = array_column($trucks->toArray(), 'id');
            $adminsIds = array_column($admins->toArray(), 'id');
            $clientsIds = array_column($clients->toArray(), 'id');
            $containersGroupedByClient = $clientsContainers->groupBy('client_id');

            //create the routes
            $routes = Route::factory(3)->state(
                [
                    'truck_id' => fn() => $trucksIds[array_rand($trucksIds)],
                    'creator_id' => fn() => $adminsIds[array_rand($adminsIds)],
                ]
            )->create();
            //create the pickups
            foreach ($routes as $route) {
                $uniqueClients = collect($clientsIds)->shuffle()->take(4);

                $pickups = $uniqueClients->map(fn($clientId) =>
                    RoutePickup::factory()
                        ->make(['client_id' => $clientId, 'route_id' => $route->id])
                );
                $route->pickups()->saveMany($pickups);

                foreach ($route->pickups as $pickup) {
                    $pickupsContainersResidues = collect();
                    foreach ($containersGroupedByClient[$pickup->client_id] as $container) {
                        foreach ($residues as $residue) {
                            $newRelation = PickupResidueContainer::factory()->make([
                                'route_pickup_id' => $pickup->id,
                                'residue_id' => $residue->id,
                                'container_id' => $container->id,
                            ]);
                            $pickupsContainersResidues->push($newRelation);
                        }
                    }
                    $pickup->pickupResiduesContainers()->saveMany($pickupsContainersResidues);
                }

                dump($route->pickups->first()->pickupResiduesContainers);
            }


        });
    }
}
