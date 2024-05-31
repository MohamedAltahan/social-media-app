<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\fileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use fileUploadTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateProfilePhoto(Request $request)
    {

        $request->validate([
            'avatar' => ['image', 'max:5000'],
            'cover' => ['image', 'max:5000']
        ]);

        $user = Auth::user();
        if ($request->has('avatar')) {
            $oldImagePath = $user->avatar;
            $newImagePath = $this->fileUpdate($request, 'myDisk', 'profile', 'avatar', $oldImagePath);
            $user->avatar = $newImagePath;
        }
        if ($request->has('cover')) {
            $oldImagePath = $user->cover;
            $newImagePath = $this->fileUpdate($request, 'myDisk', 'profile', 'cover', $oldImagePath);
            $user->cover = $newImagePath;
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function UpdateBio(Request $request)
    {
        $request->validate([
            'bio' => ['string', 'max:500']
        ]);

        $user = User::find(Auth::user()->id);
        $user->update(['bio' => $request->bio]);
        return redirect()->back();
    }
}
