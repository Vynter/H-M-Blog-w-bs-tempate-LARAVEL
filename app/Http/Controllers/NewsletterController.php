<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NewsletterController extends Controller
{
    public function store()
    {
        request()->validate([
            'mail' => 'required|email|unique:newsletters,mail' //unique dans la table newsletters le champ mail
        ]);

        Newsletter::create(request()->all());

        alert('Newsletter', 'Votre Email à bel et bien été enregistrer', 'success');

        return back();
    }
}