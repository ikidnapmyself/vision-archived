<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\UserServiceInterface;

class IntegrationController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param UserServiceInterface $service
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback(UserServiceInterface $service, string $provider)
    {
        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $auth = \Auth::user();

        $login = $service->integrate(
            $user,
            $provider,
            $auth
        );

        if ($auth === null) {
            \Auth::login($login, true);
        }

        return redirect()->to('/home');
    }

    /**
     * Integration page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function integration()
    {
        return view('integrate.index');
    }

    /**
     * Integration page.
     *
     * @param UserServiceInterface $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function integrationList(UserServiceInterface $service)
    {
        $user = \Auth::user();
        $get = $service->integrations($user->id);
        return response($get);
    }
}
