<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendAfterRegistration;
use App\Models\Auth\UserAction;
use App\Repositories\UserActionRepository;
use App\Services\UserActionService;
use App\Services\UserService;
use App\Utils\TokenGenerator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userService;
    protected $userActionService;
    protected $userActionRepository;

    public function __construct(
        UserService $userService,
        UserActionService $userActionService,
        UserActionRepository $userActionRepository
    ) {
        $this->userService = $userService;
        $this->userActionService = $userActionService;
        $this->userActionRepository = $userActionRepository;
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ];

        $user = $this->userService->registration($data);

        $token = TokenGenerator::generate();

        $this->userActionService->create($user, $token, UserAction::ACTIVATE_ACCOUNT);

        $this->dispatch(new SendAfterRegistration(
            $request->input('email'),
            route('get.auth.accountVerify', ['token' => $token])
        ));

        session()->flash('status', 'Success registration. Now, check your email please.');
        return view('home');
    }

    public function accountVerify($token)
    {
        $userAction = $this->userActionRepository->getByToken($token);

        if (!$userAction) {
            abort(404);
        }

        $userAction->delete();

        session()->flash('status', 'Success confirm account.');
        return redirect('/home');
    }
}
