<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileStoreRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index()
    {
        $divisions = Division::pluck('name', 'id');
        $profile = UserProfile::where('user_id', Auth::id())->first();
        return view('backend.modules.UserProfile.user_profile', compact('divisions', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(UserProfileStoreRequest $request)
    {
        $profile = $request->all();

        $userProfileExist = UserProfile::where('user_id', $profile['user_id'])->first();

        if ($userProfileExist) {
            $userProfileExist->update($profile);
        } else {
            UserProfile::create($profile);
        }

        session()->flash('msg', 'Profile Updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }

    final public function getDivisionWiseDistrict(int $division_id)
    {
        $districts = District::select('name', 'id')->where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    final public function getDistrictWiseThana(int $district_id)
    {
        $thanas = Thana::select('name', 'id')->where('district_id', $district_id)->get();
        return response()->json($thanas);
    }
}
