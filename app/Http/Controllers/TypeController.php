<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Type;

class TypeController extends Controller
{
    public function __construct()
    {
      $this->middleware('admin');
    }

    public function index()
    {
      $types = Type::all();

      return view('types.index', compact('types'));
    }

    public function create()
    {
      $type = new Type();

      return view('types.create', compact('type'));
    }

    public function store(TypeRequest $request)
    {
      Type::create($request->only('name', 'slug'));

      return redirect(action('TypeController@index'))->with('success', "La catégorie a bien été créée.");
    }

    public function edit($id)
    {
      $type = Type::findOrFail($id);

      return view('types.edit', compact('type'));
    }

    public function update($id, TypeRequest $request)
    {
      $type = Type::findOrFail($id);
      $type->update($request->only('name', 'slug'));

      return redirect(action('TypeController@index'))->with('success', "La catégorie a bien été mise à jour.");
    }

    public function destroy($id)
    {
      $type = Type::findOrFail($id);
      $type->delete();

      return redirect(action('TypeController@index'))->with('success', "La catégorie a bien été supprimée.");
    }
}
