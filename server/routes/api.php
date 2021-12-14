<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PizzaController;

Route::get("/pizzas", [PizzaController::class, "list"]);
Route::get("/pizzas/{id}", [PizzaController::class, "detail"]);
Route::post("/pizzas", [PizzaController::class, "create"]);
Route::put("/pizzas/{id}", [PizzaController::class, "modify"]);
Route::delete("/pizzas/{id}", [PizzaController::class, "destroy"]);
