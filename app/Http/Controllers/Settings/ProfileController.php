<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct(protected UserRepository $UserRepo) {}

    /**
     * Show edit user form
     */
    public function edit(User $user): View
    {
        return view('profile.edit', data: ['user' => $user]);
    }

    /**
     * Update user data
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validateData = $request->validated();

        $res = $this->UserRepo->updateCurrentUser($user, $validateData);

        if (! $res) {
            return back()->with(['message.error' => 'Failed to update user data']);
        }

        return back()->with(['message.success' => 'User data updated successfully']);
    }
}
