<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
     {
        $users = User::paginate(20);
        $professions = User::distinct()->pluck('profession');
        return view('users.index', ['users' => $users , 'professions' => $professions]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'password' => 'required|min:8',
            'is_admin' => 'required',
        ]);
		try {
			$validated['password'] = bcrypt(Arr::get($validated, 'password'), ['rounds' => 8]);
            $validated['remeber_token'] = Str::random(10);
			User::create($validated);

            return redirect('/users')->with('success', 'User created successfully.');
		} catch (\Exception $exception) {
			return redirect('/users/create')->with('error', 'User creation failed.'.$exception->getMessage());
		}
	}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('users.show', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect()->route('users_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users_index');
    }

    public function export()
    {
        $users = DB::table('users')->get(); 

        $csvData = '';

        foreach ($users as $user) {
            $csvData .= "{$user->id},{$user->name},{$user->email},{$user->address},{$user->phone},{$user->profession},{$user->is_admin},{$user->email_verified_at},{$user->created_at},{$user->updated_at},{$user->deleted_at}\n";
        }

        $fileName = 'users.csv';

        Storage::disk('local')->put($fileName, $csvData);

        $filePath = storage_path("app/{$fileName}");

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('query');
        $users = User::where('name', 'like', '%'.$search.'%')->paginate(20);
        $professions = User::distinct()->pluck('profession');
        return view('users.index', ['users' => $users , 'professions' => $professions]);
    }

    public function filter($Profession)
    {
        $users = User::where('profession', 'like', '%'.$Profession.'%')->paginate(20);
        $professions = User::distinct()->pluck('profession');
        return view('users.index', ['users' => $users , 'professions' => $professions]);
    }


}
