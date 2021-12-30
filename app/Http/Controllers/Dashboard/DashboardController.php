<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Stichoza\GoogleTranslate\GoogleTranslate;

class DashboardController extends Controller
{

    // methode for show the dashboard
    public function index(){
        //Alert::success('Success Title', 'Success Message');

        $tr = new GoogleTranslate();

        $world = 'React is a free and open-source front-end JavaScript library for building user interfaces
        based on UI components.It is maintained by Meta and a community of individual developers and companies.
         React can be used as a base in the development of single-page or mobile applications.';

        $data = [
            'ar' => $tr->setSource('en')->setTarget('ar')->translate($world),
            'fr' =>  $tr->setSource('en')->setTarget('fr')->translate($world),
            'es' =>   $tr->setSource('en')->setTarget('es')->translate($world),
            'ja' =>   $tr->setSource('en')->setTarget('ja')->translate($world),
        ];


        return view('backend.dashboard.dashboard' , ['data' => $data]);
    }

}
