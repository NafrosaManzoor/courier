<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pages extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
        
    }
    public function service()
    {
        return view('service');
    }
    public function track_quote()
    {
        return view('track_quote');
    }
    public function track()
    {
        return view('track');
    }
    public function express()
    {
        return view('express');
    }
    public function standard()
    {
        return view('standard');
    }
    public function pallet()
    {
        return view('pallet');
    }
    public function international()
    {
        return view('international');
    }

    public function weight_price()
    {
        return view('weight_price');
    }

    public function user_login()
    {
        return view('user_login');
    }

    public function admin_dashboard()
{
    return view('admin.dashboard'); // Assuming your admin index view is located in 'resources/views/admin/index.blade.php'
}

    public function admin_sidebar()
    {
        return view('admin.side_bar');
    }

    public function admin_new_branch()
    {
        return view('admin.new_branch');
    }

    public function admin_list_branch()
    {
        return view('admin.list_branch');
    }

    public function admin_new_parcel()
    {
        return view('admin.new_parcel');
    }

    public function admin_list_parcel()
    {
        return view('admin.list_parcel');
    }


    public function admin_new_staff()
    {
        return view('admin.new_staff');
    }

    public function admin_list_staff()
    {
        return view('admin.list_staff');
    }
    
    public function admin_tracking()
    {
        return view('admin.tracking');
    }

    public function admin_report()
    {
        return view('admin.report');
    }


}
