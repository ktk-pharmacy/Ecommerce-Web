<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactForm;
use App\Model\Advertisement;
use App\Model\Post;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::active()->get();
        $sliders = $advertisements->where('type', Advertisement::SLIDER);
        $slider_sidebars = $advertisements->where('type', Advertisement::SLIDER_SIDEBAR);
        $left_sidebars = $advertisements->where('type', Advertisement::LEFT_SIDEBAR);
        $banners1 = $advertisements->where('type', Advertisement::BANNER_1);
        $banners2 = $advertisements->where('type', Advertisement::BANNER_2);

        $products = Product::active()->latest()->get();
        $feature_products = $products->slice(0, 6);
        $new_products = $products->where('is_new', true);

        $blogs = Post::with('author', 'terms')->active()->latest()->limit(6)->get();

        return view('frontend.home', compact('sliders', 'slider_sidebars', 'left_sidebars', 'banners1', 'banners2', 'feature_products', 'new_products', 'blogs'));
    }

    public function infoPage($name)
    {
        return view('frontend.info.' . $name);
    }

    public function contactForm(Request $request)
    {
        Mail::to(config('mail.mailers.smtp.username'))->send(new ContactForm($request->all()));

        return redirect()->back()->with('success', 'Successfully send!');
    }

    public function bonous()
    {
        return view('frontend.bonous');
    }

    public function aboutUs()
    {
        return view('frontend.info.about-us');
    }

    public function forgetSession(){
        session()->forget('success');
    }
}
