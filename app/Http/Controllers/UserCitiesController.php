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
            $user->cities()->toggle($cityId);
            return redirect()->back()->with('success', 'Grad je ažuriran!');
        }

        return redirect()->back()->with('error', 'Grad nije pronađen!');
    }
}

