<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // Locale is enabled and allowed to be change
    if (session()->has('locale') && in_array(session()->get('locale'), ['en', 'fr', 'de', 'pt'])) {
      app()->setLocale(session()->get('locale'));
    } else {
      app()->setLocale('en');
    }

    return $next($request);
  }
}
