<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

/**
 * @property Request request
 * @property Application app
 */
class Language
{

    const LOCALES = ['en', 'it','de'];

    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->getPreferredLanguage(self::LOCALES);
        if(is_null(session('my_locale'))&&in_array($locale,self::LOCALES))
            session(['my_locale' => $locale]);
        $this->app->setLocale(session('my_locale', config('app.locale')));

        return $next($request);
    }
}
