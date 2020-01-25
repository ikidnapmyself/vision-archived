<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Handle OAuth login.
     *
     * @var UserServiceInterface $userService
     */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserServiceInterface $userService
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(string $service)
    {
        $isExists = collect(
            config('services')
        )
            ->has($service);

        if ($isExists === true) {
            return Socialite::driver($service)->redirect();
        }

        return redirect(route('login'));
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $service
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(string $service)
    {
        try {
            $user = Socialite::driver($service)->user();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            report($e);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            report($e);
        }

        if (isset($user)) {
            $login = $this->userService->login($user);
            if (is_a($login, 'App\Models\User')) {
                redirect($this->redirectTo);
            }
        }

        return redirect(route('login'));
    }
}
