<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Jobs\SendMailPasswordReset;
use App\Models\Auth\UserAction;
use App\Repositories\UserActionRepository;
use App\Repositories\UserRepository;
use App\Services\UserActionService;
use App\Services\UserService;
use App\Utils\TokenGenerator;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $userActionService;
    protected $userActionRepository;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService,
        UserActionService $userActionService,
        UserActionRepository $userActionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->userActionService = $userActionService;
        $this->userActionRepository = $userActionRepository;
    }

    public function resetPage()
    {
        return view('auth.password.reset');
    }

    public function reset(Request $request)
    {
        $user = $this->userRepository->getByEmail($request->get('email'));

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found']);
        }

        $token = TokenGenerator::generate();

        $this->userActionService->create($user, $token, UserAction::RECOVER_PASSWORD);

        $this->dispatch(new SendMailPasswordReset(
            $request->input('email'),
            route('get.auth.changePassword', ['token' => $token]),
            $user->name
        ));

        session()->flash('status', 'Action for reset pass successful created. Now, check your email please.');
        return view('home');
    }

    public function changePage($token)
    {
        $userAction = $this->userActionRepository->getByToken($token);

        if (!$userAction) {
            abort(404);
        }

        return view('auth.password.change', ['token' => $token]);
    }

    public function change(ChangePasswordRequest $request)
    {
        $userAction = $this->userActionRepository->getByToken($request->get('token'));

        if (!$userAction) {
            return redirect()->back()->withErrors(['token' => 'Wrong token']);
        }

        $this->userService->changePassword($userAction->user_id, $request->get('password'));

        $userAction->delete();

        session()->flash('status', 'Password successful changed');
        return view('home');
    }
}
