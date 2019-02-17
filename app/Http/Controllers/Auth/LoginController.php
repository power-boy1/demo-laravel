<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserActionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $userRepository;
    protected $userActionRepository;

    public function __construct(UserRepository $userRepository, UserActionRepository $userActionRepository)
    {
        $this->userRepository = $userRepository;
        $this->userActionRepository = $userActionRepository;
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->getByEmail($request->get('email'));

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->withErrors(['email' => __('messages.wrong_credentials')]);
        }

        $userActions = $this->userActionRepository->getActivateAccountAction($user->id);

        if ($userActions) {
            return redirect()->back()->withErrors(['email' => __('not_verified_account')]);
        }

        Auth::LoginUsingId($user->id);

        session()->flash('status', __('messages.welcome', ['name' => $user->name]));
        return view('home');
    }

    public function logout()
    {
        $user = Auth::user();

        Auth::logout();

        session()->flash('status', __('messages.bye', ['name' => $user->name]));
        return redirect('/');
    }
}
