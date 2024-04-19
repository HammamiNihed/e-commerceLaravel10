<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    //
    public function dashboard() {
        $produits = Produit::all();
        $nbprod = count($produits);

        $category = Category::all();
        $nbcat = count($category);
        return view('admin.dashboard')->with("nbprod", $nbprod)->with("nbcat", $nbcat); 
    }

    public function profile() {
        return view("admin.profile");
    }

    public function editProfile(Request $req) {
        Auth::user()->name = $req->name;
        Auth::user()->email = $req->email;

        if($req->password) {
            Auth::user()->password = Hash::make($req->password);
        }
        Auth::user()->update();
        return redirect('/admin/profile')->with('success', "Admin modifie avec success!!");

    }
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }
}
