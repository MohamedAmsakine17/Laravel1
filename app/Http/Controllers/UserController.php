<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updateUsername(Request $request,string $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255']
        ]);
        
        User::find($id)->update([
            'name' => $request->name,
        ]);
        
        return redirect(route('profile'));
    }

    public function updatePhoto(Request $request,string $id)
    {
       
        
        $data = $request->all();
        
        if($file = $request->file('picture'))
        {
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $data['path'] = $name;
        }
        
        User::find($id)->update([
            'path' => $data['path'],
        ]);
        
        return redirect(route('profile'));
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect('login');
    }
}