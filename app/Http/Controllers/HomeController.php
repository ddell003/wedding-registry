<?php

namespace App\Http\Controllers;

use App\Services\Party\PartyService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $partyService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PartyService $partyService)
    {
        $this->partyService = $partyService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');

        //lets call the service to get the users party info
        $party = $this->partyService->getParty(\Auth::user()->party_id);
        return view('home', compact('party'));
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
            ['name'=>'Anna Powers', 'title'=>'Bridesmaid', 'url'=>'img/Bridesmaids/AnnaPowers.jpg'],
            ['name'=>'Emily Dell ', 'title'=>'Bridesmaid', 'url'=>'img/Bridesmaids/em.jpg'],
        ];

        $faq = [
            [
                'question'=>'Current Virginia Policies',
                'answer'=>'
                            <ul>
                            <li>In door gathering up to 250 people</li>
                            <li>Masks required indoor unless eating at table</li>
                            <li>Social distancing of 6 feet</li>
                            </ul>
                            '
            ],
            [
                'question'=>'When should I RSVP by?',
                'answer'=>'
                           <ul>
                           <li>Please RSVP by October 19, 2020. We would love to hear from you before that if you are able!</li>
                            <li>We understand that your RSVP may be tentative due to COVID-19.  If you have specific questions or ideas that would help you feel more comfortable at our wedding, please send me an email at: katie.lynne13@gmail.com</li>
                            </ul>
                            '
            ],
            [
                'question'=>'What time should I arrive at the ceremony?',
                'answer'=>'<ul><li>The church will be open as of 2:30PM. Please arrive by 2:50PM at the latest!</li></ul>'
            ],
            [
                'question'=>'Can I bring a date?',
                'answer'=>'<ul><li>Social distancing is somewhat limiting the size of our party but please do reach out if you would like to bring a plus one and it was not included in your invitation.</li></ul>'
            ],
            [
                'question'=>'Are kids welcome??',
                'answer'=>"<ul><li>We've invited some children that are we personally know and love. Your invitation lists the specific people we have accounted for from your household.</li></ul>"
            ],
            [
                'question'=>'Is there a dress code?',
                'answer'=>"<ul><li>Semi-formal or Dressy-casual. Wear something you feel awesome in!</li></ul>"
            ],
            [
                'question'=>'Is there parking for the ceremony or reception?',
                'answer'=>"<ul><li>Yes! There is ample parking at both locations!</li></ul>"
            ],
            [
                'question'=>'I have a food allergy, can I make a special request?',
                'answer'=>"<ul><li>Please, please, please do!! We have planned with our caterer to offer a vegetarian, dairy-free, and gluten-free meals. You can indicate your needs on the RSVP form.</li></ul>"
            ],

        ];
        return view('welcome', compact('gallery', 'weddingParty', 'faq'));
    }
}
