<?php

namespace App\Http\Middleware;

use Closure;

class SellerShopHasCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return \Illuminate\Http\Response
     */
    // public function handle($request, Closure $next, $subscription = 'default', $plan = null)
    public function handle($request, Closure $next)
    {
        // Temporarily for dev
        // return $next($request);

        if(count($request->user()->shopCategory()) < 1)
        {
            redirect()->route('admin.vendor.shop.create_category');
        }
        else
            return $next($request);
        

        return $request->ajax() || $request->wantsJson()
                                ? response('Subscription required to access this page.', 402)
                                : redirect()->route('admin.vendor.shop.create_category');
    }
}
