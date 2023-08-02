<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $namePage = 'Account';
    protected $folder = 'account';

    public function index()
    {
        $items = User::all();
        return view("$this->folder.index", [
            'items' => $items,
            'name_page' => $this->namePage,
            'folder' => $this->folder,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("$this->folder.create", [
            'name_page' => $this->namePage,
            'folder' => $this->folder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string',
                'password' => 'required|string',
            ]);
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            DB::commit();
            return redirect()->route("$this->folder.index")->with('success', "$this->namePage created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("$this->folder.index")->with('error', 'Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view("$this->folder.edit", [
            'name_page' => $this->namePage,
            'folder' => $this->folder,
            'row' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string',
                'password' => 'nullable|string|max:255',
            ]);
            if($data['password'] != null){
                $data['password'] = bcrypt($data['password']);
            }else{
                unset($data['password']);
            }
            $user->update($data);
            DB::commit();
            return redirect()->route("$this->folder.index")->with('success', "$this->namePage created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("$this->folder.index")->with('error', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $data = User::findOrFail($id);
            if ($data->image != null) {
                try {
                    Storage::disk('public')->delete($data->image);
                } catch (\Exception $e) {
                }
            }
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something broke'], 500);
        }
    }

    public function status($id = null)
    {
        $data = User::findOrFail($id);
        $data->status = ($data->status == 'draft') ? 'published' : 'draft';
        if ($data->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
