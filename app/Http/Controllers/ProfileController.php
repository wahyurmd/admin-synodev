<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    function index() : View {
        $user = User::with('profile', 'sosmed')
        ->where('id', Auth::user()->id)
        ->where('status', '1')
        ->get();

        return view('profile.profile', compact(
            'user',
        ));
    }

    function updateUser(Request $request, $id) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'name'      => 'sometimes',
            'email'     => 'sometimes',
            'username' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            $user = User::find($id);

            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->username = $request->username;
            $user->save();

            return redirect()->back()->with(['success' => 'User data has been updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Failed to update user data: ' . $e->getMessage()]);
        }
    }

    function updateProfile(Request $request, $id) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'title'             => 'nullable',
            'phone'             => 'nullable',
            'desc'              => 'nullable',
            'address'           => 'nullable',
            'picture'           => 'nullable',
            'years_experience'  => 'nullable',
            'curriculum_vitae'  => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            $profile = Profile::find($id);

            $profile->title             = $request->title;
            $profile->phone             = $request->phone;
            $profile->desc              = $request->desc;
            $profile->address           = $request->address;
            $profile->years_experience  = $request->years_experience;

            if ($request->hasFile('picture')) {
                $picture = $request->file('picture');
                $pictureName = $picture->getClientOriginalName();
                $picture->storeAs('public/profile', $pictureName);

                // Update data dengan gambar terbaru
                $profile->picture = $pictureName;
            }

            if ($request->hasFile('curriculum_vitae')) {
                $cv = $request->file('curriculum_vitae');
                $cvName = $cv->getClientOriginalName();
                $cv->storeAs('public/profile', $cvName);

                // Update data dengan gambar terbaru
                $profile->curriculum_vitae = $cvName;
            }

            $profile->save();

            return redirect()->back()->with(['success' => 'Profile data has been updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Failed to update user data: ' . $e->getMessage()]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with(['errortoast' => 'Database error: ' . $e->getMessage()]);

        }
    }

    function updateSocmed(Request $request, $id) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'instagram' => 'nullable',
            'whatsapp'  => 'nullable',
            'linkedin'  => 'nullable',
            'github'    => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            $sosmed = SocialMedia::find($id);

            $sosmed->instagram    = $request->instagram;
            $sosmed->whatsapp     = $request->whatsapp;
            $sosmed->linkedin     = $request->linkedin;
            $sosmed->github       = $request->github;
            $sosmed->save();

            return redirect()->back()->with(['success' => 'Social media has been updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Failed to update user data: ' . $e->getMessage()]);
        }
    }
}
