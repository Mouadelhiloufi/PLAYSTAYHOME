<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        if (!config('services.google.enabled')) {
            abort(404);
        }

        $redirect = request()->query('redirect');
        if (is_string($redirect) && $this->isSafeInternalRedirect($redirect)) {
            session(['auth_post_login_redirect' => $redirect]);
        }

        $provider = Socialite::driver('google');

        if (method_exists($provider, 'stateless')) {
            $provider = $provider->stateless();
        }

        return $provider->redirect();
    }

    public function callback(): RedirectResponse
    {
        if (!config('services.google.enabled')) {
            abort(404);
        }

        try {
            $provider = Socialite::driver('google');

            if (method_exists($provider, 'stateless')) {
                $provider = $provider->stateless();
            }

            $googleUser = $provider->user();
        } catch (Throwable $exception) {
            return redirect()->route('login')->with('google_error', 'Impossible de se connecter avec Google.');
        }

        $email = $googleUser->getEmail();

        if (empty($email)) {
            return redirect()->route('login')->with('google_error', 'Aucun email Google n\'a ete retourne.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName() ?: 'Google User',
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                'role' => 'client',
            ]);
        } elseif (!$user->name && $googleUser->getName()) {
            $user->forceFill([
                'name' => $googleUser->getName(),
            ])->save();
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $query = [
            'token' => $token,
            'role' => $user->role,
            'google' => 1,
        ];

        $intended = session()->pull('auth_post_login_redirect');
        if (is_string($intended) && $this->isSafeInternalRedirect($intended)) {
            $query['redirect'] = $intended;
        }

        return redirect('/login?' . http_build_query($query));
    }

    /**
     * Autorise uniquement un chemin relatif interne (évite les redirections ouvertes).
     */
    private function isSafeInternalRedirect(string $path): bool
    {
        if ($path === '' || ! str_starts_with($path, '/') || str_starts_with($path, '//')) {
            return false;
        }

        if (strlen($path) > 2048) {
            return false;
        }

        if (preg_match('/^[a-z][a-z0-9+.-]*:/i', ltrim($path, '/'))) {
            return false;
        }

        return true;
    }
}
