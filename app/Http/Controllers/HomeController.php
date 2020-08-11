<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        return view('home');
    }

    public function welcome()
    {
        $gallery = [
            ['url'=>'img/gallery/porch.jpg', 'title'=>''],
            ['url'=>'img/gallery/secondDate.jpg', 'title'=>'From our second date! I took a picture for a group of college girls and they insisted on getting one of us too!'],
            ['url'=>'img/gallery/boat1.jpg', 'title'=>"Katie's first canoe trip with Parker's crew"],
            ['url'=>'img/gallery/football.jpg', 'title'=>'Football... something Parker will always have to explain to me!'],
            ['url'=>'img/gallery/han.JPG', 'title'=>'"I love you" <br> "I know"'],
            ['url'=>'img/gallery/workParty.jpg', 'title'=>'Look at us nailing it with at the 50\'s themed Christmas Party!'],
            ['url'=>'img/gallery/saveTheDate.jpg', 'title'=>"We'er getting married!!"],
            ['url'=>'img/gallery/christmas.jpg', 'title'=>''],
        ];

        $weddingParty = [
            ['name'=>'Jon Gee', 'title'=>'Best Man', 'url'=>'img/jon.jpg'],
            ['name'=>'Noah Dell', 'title'=>'Groomsmen', 'url'=>'img/noah.jpg'],
            ['name'=>'Jacob Dell', 'title'=>'Groomsmen', 'url'=>'img/noah.jpg'],
            ['name'=>'Bobby Beal', 'title'=>'Groomsmen', 'url'=>'img/bobby.jpg'],
            ['name'=>'Michael Keifer', 'title'=>'Groomsmen', 'url'=>'img/michael.jpg'],

            ['name'=>'Shelia Herlihy ', 'title'=>'Maid of Honor', 'url'=>'img/Bridesmaids/SheliaHerlihy.jpg'],
            ['name'=>'Jessica Knapton', 'title'=>'Bridesmaid', 'url'=>'img/Bridesmaids/JessicaKnapton.jpg'],
            ['name'=>'Anna Wright', 'title'=>'Bridesmaid', 'url'=>'img/Bridesmaids/AnnaWright.jpg'],
            ['name'=>'Emily Dell ', 'title'=>'Bridesmaid', 'url'=>'img/Bridesmaids/EmilyDell.jpg'],
        ];
        return view('welcome', compact('gallery', 'weddingParty'));
    }
}
