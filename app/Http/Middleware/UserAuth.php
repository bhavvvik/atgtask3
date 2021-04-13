<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
    //    $token=localStorage.setItem('access_token', response.token);
        
        // $token=$request->header('APP_KEY');
        // dd($token);
        // dd($request->session()->all());
        // dd($request->session()->has('access_token'));
        if(!empty(auth()->user())){
        //  dd($request->session()->get('user'));
        
        
        return $next($request); 
        }else{
            
            $request->session()->flash('error',"Access denied!!");
            return redirect('login');
            
        }
        
    }
}
