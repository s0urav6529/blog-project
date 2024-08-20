<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\PhotoUploadController;
use App\Http\Requests\UserProfileStoreRequest;
use App\Models\District;
use App\Models\Thana;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index()
    {
        $users = User::with('user_profile', 'user_profile.division', 'user_profile.district', 'user_profile.thana')->paginate(10);
        return view('backend.modules.UserProfile.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    final public function create()
    {
        $divisions = (new UserProfile())->pluckDivisions();
        $profile = (new UserProfile())->findProfileDetails(Auth::id());

        $isEditable = true;

        return view('backend.modules.UserProfile.user_profile', compact('divisions', 'profile', 'isEditable'));
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(UserProfileStoreRequest $request)
    {
        $profile = $request->all();

        $userProfileExist = (new UserProfile())->findProfileDetails($profile['user_id']);

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
        $userProfile->load('division', 'district', 'thana', 'user');
        return view('backend.modules.UserProfile.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        $user_id = $userProfile->user_id;

        $isEditable = Auth::id() === $user_id;
        $profile = (new UserProfile())->findProfileDetails($user_id);
        $role = (new UserProfile())->findRole($user_id);
        $divisions = (new UserProfile())->pluckDivisions();
        $userProfile->load('user');

        $roles = [
            1 => 'Admin',
            2 => 'User',
            3 => 'Modarator',
        ];

        return view('backend.modules.UserProfile.edit', compact('userProfile', 'divisions', 'profile', 'isEditable', 'role', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {

        $user = User::find($userProfile->user_id);

        if ($user) {
            $user->role = $request->role;
            $user->save();

            session()->flash('msg', 'User role updated successfully !');
            session()->flash('notification_color', 'success');

            return redirect()->route('user-profile.index');
        }
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

    final public function uploadUserProfilePhoto(Request $request)
    {
        $file = $request->input('photo');
        $name = Str::slug(Auth::user()->name . Carbon::now());
        $height = 250;
        $width = 400;
        $path = 'images/user/';

        $profile = UserProfile::where('user_id', Auth::id())->first();

        if ($profile?->photo) {
            PhotoUploadController::imageUnlink($path, $profile->photo);
        }

        if ($profile) {

            $photo_name = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);

            $update_profile['photo'] = $photo_name;

            $profile->update($update_profile);
            return response()->json([
                'msg' => 'Profile Photo uploaded successfully !',
                'notification_color' => 'success',
                'photo' => url($path . $profile->photo),
            ]);
        } else {
            return response()->json([
                'msg' => 'Please add profile information first !',
                'notification_color' => 'warning',
            ]);
        }
    }
}
