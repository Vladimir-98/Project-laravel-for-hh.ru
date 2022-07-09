<?php

namespace App\Http\Controllers;

use App\Models\Admin\AddedApartmentUser;
use App\Models\Admin\AddedProjectUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function addToCart(Request $request): JsonResponse
    {
        $type = $request->get('type');
        $id = $request->get('id');
        $color_heart = 'white';
        $quantity = '';

        if (Auth::user()) {

            $user_id = auth()->id();

            if ($type == 'Project') {
                $project = AddedProjectUser::where(['user_id' => $user_id, 'project_id' => $id])->first();
                if (!empty($project)) {
                    AddedProjectUser::destroy($project->id);
                } else {
                    AddedProjectUser::create([
                        'project_id' => $id,
                        'user_id' => $user_id,
                        ]);
                    $color_heart = 'red';
                }
                session()->forget('data.projects');

                $projects_id = AddedProjectUser::where('user_id', $user_id)->get();

                foreach ($projects_id as $project_table) {
                    session()->push('data.projects', $project_table->project_id);
                }

            } elseif ($type == 'Apartments') {
                $apartment = AddedApartmentUser::where(['user_id' => $user_id, 'apartment_id' => $id])->first();
                if (!empty($apartment)) {
                    AddedApartmentUser::destroy($apartment->id);
                } else {
                    AddedApartmentUser::create(['apartment_id' => $id, 'user_id' => $user_id]);
                    $color_heart = 'red';
                }

                session()->forget('data.apartments');

                $apartments_id = AddedApartmentUser::where('user_id', $user_id)->get();
                foreach ($apartments_id as $apartment_table) {
                    session()->push('data.apartments', $apartment_table->apartment_id);
                }
            }

            $quantity = AddedApartmentUser::where('user_id', $user_id)->count() + AddedProjectUser::where('user_id', $user_id)->count();

        } else {

            $quantity = '';
            session()->has('data.projects') ? $quantity_projects = count(session()->get('data.projects')) : $quantity_projects = 0;
            session()->has('data.apartments') ? $quantity_apartments = count(session()->get('data.apartments')) : $quantity_apartments = 0;

            if ($type == 'Project') {

                if (session()->has('data.projects') && in_array($id, $projects = session()->get('data.projects'))) {

                    foreach ($projects as $key => $value) {

                        if ($id === $value) {

                            session()->forget('data.projects.' . $key);

                            $current_data = session()->get('data.projects');

                            session()->forget('data.projects');

                            foreach ($current_data as $data_key => $data_value) {

                                session()->push('data.projects', $data_value);

                            }

                            $quantity = $quantity_projects + $quantity_apartments - 1;
                        }
                    }

                } else {
                    session()->push('data.projects', $id);
                    $quantity = $quantity_projects + $quantity_apartments + 1;
                    $color_heart = 'red';
                }

            } else if ($type == 'Apartments') {

                if (session()->has('data.apartments') && in_array($id, $apartments = session()->get('data.apartments'))) {

                    foreach ($apartments as $key => $value) {

                        if ($id === $value) {

                            session()->forget('data.apartments.' . $key);

                            $current_data = session()->get('data.apartments');

                            session()->forget('data.apartments');

                            foreach ($current_data as $data_key => $data_value) {

                                session()->push('data.apartments', $data_value);

                            }

                            $quantity = $quantity_projects + $quantity_apartments - 1;
                        }
                    }

                } else {
                    session()->push('data.apartments', $id);
                    $quantity = $quantity_projects + $quantity_apartments + 1;
                    $color_heart = 'red';
                }
            }
        }

        return response()->json(['quantity' => $quantity, 'color_heart' => $color_heart]);
    }
}
