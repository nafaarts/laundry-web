<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundries = Laundry::paginate();
        return view('laundry.index', compact('laundries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'laundry')->get();
        return view('laundry.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'owner' => 'required|exists:users,id',
            'no_izin' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'image' => 'required|image'
        ]);
        // dd($request->all());
        $image_name = time() . $request->image->getClientOriginalName();

        $request->image->move(public_path('/img/laundry'), $image_name);

        Laundry::create([
            'user_id' => $request->owner,
            'name' => $request->name,
            'no_izin' => $request->no_izin,
            'address' => $request->address,
            'lat' => $request->lat,
            'long' => $request->long,
            'image' => $image_name,
        ]);

        return redirect()->route('laundry.index')->with('success', 'Laundry has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry $laundry)
    {
        return view('laundry.detail', compact('laundry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function edit(Laundry $laundry)
    {
        // $users = User::where('role', 'laundry')->get();
        $users = User::all();
        return view('laundry.edit', compact('users', 'laundry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laundry $laundry)
    {
        $request->validate([
            'name' => 'required',
            'owner' => 'required|exists:users,id',
            'no_izin' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->has('image')) {
            File::delete(public_path('/img/laundry/') . $laundry->image);
            $image_name = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('/img/laundry'), $image_name);
        }

        $laundry->update([
            'user_id' => $request->owner,
            'name' => $request->name,
            'no_izin' => $request->no_izin,
            'address' => $request->address,
            'lat' => $request->lat,
            'long' => $request->long,
            'image' => $image_name ?? $laundry->image,
        ]);

        return redirect()->route('laundry.index')->with('success', 'Laundry successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laundry $laundry)
    {
        File::delete(public_path('/img/laundry/') . $laundry->image);
        $laundry->delete();
        return redirect()->route('laundry.index')->with('success', 'laundry has been deleted');
    }
}
