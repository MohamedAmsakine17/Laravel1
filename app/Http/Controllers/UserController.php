<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\File as Files;
use Illuminate\Support\Facades\Validator;
use App\Models\TemporaryFiles;


class UserController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updateUsername(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => [
                'required',
                'string',
            ]
        ]);

        $user = User::find($request->id);

        if (Hash::check($request->password, $user->password)) {

            $user->update([
                'name' => $request->name,
            ]);

            return redirect(route('profile'));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Le mot de passe est incorrect']);
        }
    }

    public function updatePassword(Request $request, string $id)
    {
        $this->validate($request, [
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'newPassword' => [
                'required',
                'string',
                'min:8',
            ]
        ]);

        $user = User::find($request->id);

        if (Hash::check($request->password, $user->password)) {
            if ($request->newPassword == $request->confirmePassword) {
                $user->update([
                    'password' => Hash::make($request->newPassword)
                ]);
                return redirect(route('profile'));
            } else {
                return Redirect::back()->withErrors(['msg' => 'Le nouveau mot de passe ne correspond pas au mot de passe dans la confirmation']);
            }
        } else {
            return Redirect::back()->withErrors(['msg' => 'Le mot de passe est incorrect']);
        }
    }

    public function updatePhoto(Request $request, string $id)
    {
        $user = User::find($id);
        $data = $request->all();

        $temprorayfile = TemporaryFiles::where('folder', $request->file)->first();
        if ($temprorayfile) {
            $data['file'] = storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename);
            $user->addMedia(storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename))->toMediaCollection('userImage');
            Files::deletedirectory(storage_path('app/files/tmp/' . $request->file));
            $temprorayfile->delete();
        }

        return redirect(route('profile'));
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect('login');
    }
}