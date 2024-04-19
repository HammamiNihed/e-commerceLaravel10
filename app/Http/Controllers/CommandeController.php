<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    //

    public function store(Request $req) {
        //dd($req);
        $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        //creation commande
        if($commande) {
            $lc = new LigneCommande();
            $lc->qte = $req->qte;
            $lc->product_id = $req->idproduct;
            $lc->commande_id = $commande->id;
            $lc->save();
            return redirect('client/cart')->with('success', 'success');
        } else {
        $commande = new Commande();
        $commande->client_id = Auth::user()->id;
        if($commande->save()) {
        //creation ligne commande
            $lc = new LigneCommande();
            $lc->qte = $req->qte;
            $lc->product_id = $req->idproduct;
            $lc->commande_id = $commande->id;
            $lc->save();
            return redirect('/client/cart')->with('success', 'success');

        } else {
            return redirect()->back()->with('error', 'erreur');
        }
        }
    }

    public function cartPage() {
        $user = Auth::user();
       
        $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        $orderCount = $commande->lignecommandes()->count();
        return view("client.cart")->with('commande', $commande)->with('orderCount',$orderCount);
    }

}
