<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    
    //Add a new product
    public function AddProduct(Request $request) {

       // dd($request);
        $p = new Produit();
        $p->name = $request->name;
        $p->description = $request->description;
        $p->price = $request->price;
        $p->qte = $request->qte; 
        $p->category_id = $request->category_id;
        //upload image
       $newname = uniqid(); 
       $image = $request->file('photo');
       $newname.= "." . $image->getClientOriginalExtension();
       $destinationPath = 'uploads';
       $image->move($destinationPath, $newname);

        $p->photo = $newname;

        if($p->save()){
          return redirect()->back();
        } else {
            return "erreur d\'ajout";
        }
    }

    public function listeProducts() {
        $produits = Produit::all();
        $categorys = Category::all();
        return  view('admin.produits.liste')->with("produits",$produits)->with("categorys",$categorys);
    }

    //edit a category
    public function update(Request $request){
      $id = $request->id_produit;
      $produit = Produit::find($id);

      $produit->name = $request->name;
      $produit->description = $request->description;
      $produit->price = $request->price;
      $produit->qte = $request->qte; 

      if($produit->update()){
        return redirect()->back();
      } else {
          return "erreur";
      }
     
    }

    public function delete(Request $req) {
      $produit = Produit::find($req->id);
      $file_path = public_path().'/uploads/'.$produit->photo;
      unlink($file_path);
      if($produit->delete()) {
        return redirect()->back();
      } else {
        echo "erreur";
      }
    }

    


    
}
