<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    //
    public function dashboard() {
        $categorys = Category::all();
        $products = Produit::all();
        $affordableProducts = Produit::priceRange(10, 50)->get();     
        $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        $orderCount = $commande->lignecommandes()->count();
         // Assuming "just arrived" means products created in the last 7 days
        $justArrivedProducts = Produit::where('created_at', '>', Carbon::now()->subDays(7))->get();

        return view('client.dashboard', compact('justArrivedProducts'))->with("categorys", $categorys)->with("products",$products)->with("orderCount",$orderCount); 
    }

    
    public function index($categoryId)
    {
        $products = Produit::byCategory($categoryId)->get();
        $categorys = Category::all();
        $justArrivedProducts = Produit::where('created_at', '>', Carbon::now()->subDays(7))->get();
        return view('client.dashboard', compact('products'), compact('categorys'))->with("justArrivedProducts",$justArrivedProducts);
    }

    public function filterByName(Request $request)
    {
        $productName = $request->input('name');

        $products = Produit::where('name', 'like', "%$productName%")->get();
        $categorys = Category::all();
        $justArrivedProducts = Produit::where('created_at', '>', Carbon::now()->subDays(7))->get();
        return view('client.dashboard')->with("products",$products)->with("categorys", $categorys)->with("justArrivedProducts",$justArrivedProducts);
    }

  

    public function detailProduct($id_produit) {
        // Retrieve the product by ID
        $product = Produit::find($id_produit);
        return view("client.detail-product", compact('product'));
    }
    

    
}
