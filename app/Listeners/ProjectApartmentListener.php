<?php

namespace App\Listeners;

use App\Events\AddedEvent;
use App\Models\Admin\AddedApartmentUser;
use App\Models\Admin\AddedProjectUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class ProjectApartmentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AddedEvent $event
     * @param $user_id
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(AddedEvent $event)
    {
        $user_id = auth()->id();

        if (session()->has('data.projects') && $projects = session()->get('data.projects')) {
            foreach ($projects as $key => $project_id) {
                AddedProjectUser::firstOrCreate(
                    ['project_id' => $project_id],
                    ['user_id' => $user_id]
                );
            }
        }

        session()->forget('data.projects');

        $projects_id = AddedProjectUser::where('user_id', $user_id)->get();

        foreach ($projects_id as $project_table) {
            session()->push('data.projects', $project_table->project_id);
        }

        if (session()->has('data.apartments') && $apartments = session()->get('data.apartments')) {
            foreach ($apartments as $key => $apartment_id) {
                AddedApartmentUser::firstOrCreate(
                    ['apartment_id' => $apartment_id],
                    ['user_id' => $user_id]
                );
            }
        }
        session()->forget('data.apartments');

        $apartments_id = AddedApartmentUser::where('user_id', $user_id)->get();
        foreach ($apartments_id as $apartment_table) {
            session()->push('data.apartments', $apartment_table->apartment_id);
        }
    }
}
