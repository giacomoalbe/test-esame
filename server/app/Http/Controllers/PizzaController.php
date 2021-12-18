<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PizzaController extends Controller
{
    public function list(Request $req) {
        $sortMethod = "asc";

        if ($req->query("sort") != null) {
            $sortMethod = $req->query("sort");
        }

        return Pizza::orderBy("price", $sortMethod)->get();
    }

    public function detail($id) {
        return Pizza::where("id", $id)->first();
    }

    public function create(Request $req) {
        // Get data from request
        $pizzaData = json_decode($req->getContent());

        $pizza = new Pizza();

        $pizza->name = $pizzaData->name;
        $pizza->photo = $pizzaData->photo;
        $pizza->price = $pizzaData->price;
        $pizza->dough = $pizzaData->dough;
        $pizza->allergens = $pizzaData->allergens;
        $pizza->description = $pizzaData->description;

        $pizza->save();

        return response()->json($pizza, 201);
    }

    public function modify(Request $req, $id) {
        $pizza = Pizza::where("id", $id)->first();

        // Get data from request
        $pizzaData = json_decode($req->getContent());

        $pizza->name = $pizzaData->name;
        $pizza->photo = $pizzaData->photo;
        $pizza->price = $pizzaData->price;
        $pizza->dough = $pizzaData->dough;
        $pizza->allergens = $pizzaData->allergens;
        $pizza->description = $pizzaData->description;

        $pizza->save();

        return response()->json($pizza, 200);
    }

    public function destroy($id) {
        return Pizza::destroy($id);
    }
}
