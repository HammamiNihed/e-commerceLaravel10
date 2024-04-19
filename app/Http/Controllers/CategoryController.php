<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
  
   public function AddCategory(Request $request) {

      //dd($request->nom);
      $request->validate([
        'name'=>'required',
        'description'=>'required'
      ]);
      $c = new Category();
      $c->name = $request->name;
      $c->description = $request->description;
      if($c->save()){
        return redirect()->back();
      } else {
          return "erreur d\'ajout";
      }
  }

  public function listeCategory() {
      $category = Category::all();
      
      return  view('admin.categories.liste')->with("category",$category);
   }

   //edit a category
   public function edit(Request $req){
      $category = Category::find($req->id);
      return view('admin.categories.update')->with("category",$category);
  }

  //update a category
  public function update(Request $req){
      $category = Category::find($req->id);
      $category->update([
          'name' => $req->name,
          'description' => $req->description
          
      ]);     
      return redirect()->route('allCategory')->with('succes', 'succes');      
  }

  //delete a category
  public function delete(Request $req){
      $category = Category::find($req->id);
      $category->delete();
      return redirect()->route('allCategory');
  }
}
