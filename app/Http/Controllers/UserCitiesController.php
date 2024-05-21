<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CitiesModel;

class UserCitiesController extends Controller
{
    public function favourite(Request $request, $cityId)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect()->back()->with('error', 'Morate biti ulogovani da biste videli prognozu!');
        }

        $city = CitiesModel::find($cityId);

        if ($city) {
            if ($user->cities()->where('city_id', $cityId)->exists()) {
                $user->cities()->detach($cityId); // Ako već postoji, ukloni ga
                return redirect()->back()->with('success', 'Grad je uklonjen iz omiljenih!');
            } else {
                $user->cities()->attach($cityId); // Ako ne postoji, dodaj ga
                return redirect()->back()->with('success', 'Grad je dodat u omiljene!');
            }
        }

        return redirect()->back()->with('error', 'Grad nije pronađen!');
    }
}


