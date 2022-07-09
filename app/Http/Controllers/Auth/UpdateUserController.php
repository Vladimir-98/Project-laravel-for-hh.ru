<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Admin\Header;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class UpdateUserController extends Controller
{
    const IMAGES_AVATAR = 'upload/avatar/';

    public function getRequestFile($request_file): array
    {

        return [
            [
                'name' => 'avatar',
                'big' => ['width' => 100, 'height' => 100],
                'path' => self::IMAGES_AVATAR,
                'file' => $request_file,
            ],
        ];
    }

    public function index(Request $request)
    {
        $user = $request->user();

        return view('auth.update-user', compact(['user']));

    }

    public function updateDataUser(Request $request)
    {
        $user = User::find($request->user()->id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
//            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => [
                'dimensions:min_height=100',
                'dimensions:min_width=100',
                'mimes:jpg,png,jpeg,webp',
                'max:7000'
            ],
        ]);


        $request->except('token');

        if ($request->file('avatar')) {
            $images = new ImageSaver();
            $data_files = self::getRequestFile($request->file('avatar'));
            if (!empty($user->avatar)) {
                $images->update($data_files, $user);
            }
            $user_img_data = $images->upload($data_files, $user->id);
            $user_table['avatar'] = $user_img_data['avatar'];
        }

        $user_table['name'] = $request->get('name');
        $user_table['phone'] = $request->get('phone');
//        $user_table['email'] = $request->get('email');

        $user->fill($user_table)->update();


        return redirect()->back()->with(['status' => Lang::get('main.data_has_been_successfully_updated')]);

    }
}
