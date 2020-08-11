<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class PartyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd('view index');
        return view('admin.parties');
    }
}
