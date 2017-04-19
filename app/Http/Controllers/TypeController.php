<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    public function index()
    {
      $types = Type::all();

      return view('types.index', compact('types'));
    }

    public function create()
    {
      return view('types.create');
    }

    public function edit($id)
    {
      $types = Type::findOrFail($id);

      return view('types.edit', compact('types'));
    }

    public function update($id)
    {

    }


}
