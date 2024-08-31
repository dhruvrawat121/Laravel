<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class SearchDataController extends Controller
{
    function  searchName(Request $request){
        try{
            $searchQuery = $request->input('query');

            // Search query to table item
            $searchResults = Item::where('name', 'LIKE', "%{$searchQuery}%") // Replace 'name' with the column you are searching
            ->take(7) // Limit the number of suggestions
            ->get();
            return response()->json($searchResults);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
