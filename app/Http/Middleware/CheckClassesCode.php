<?php

namespace App\Http\Middleware;

use App\Classes;
use App\Subject;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckClassesCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $classes_code_from_request = $request->input('classes_code');
        $classes = Classes::where('classes_code', $classes_code_from_request)->first();
        if(!$classes) {
            return redirect('home');
        } else {
            $user_id = Subject::where('id', $classes->subject_id)->first()->user_id;
            if (!$user_id || $user_id != Auth::id()) {
                return redirect('home');
            }
        }
        $request->attributes->add(['classes_id' => $classes->id]);
        return $next($request);
    }
}
