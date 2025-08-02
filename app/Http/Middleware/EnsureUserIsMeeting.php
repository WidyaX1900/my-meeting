<?php

namespace App\Http\Middleware;

use App\Models\Meeting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMeeting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMeeting = Meeting::where('user_id', Auth::id())
            ->where('status', 'onmeet')
            ->first();

        if ($isMeeting) {
            return redirect('/meeting');
        }        
        
        return $next($request);
    }
}
