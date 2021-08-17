<?php

namespace App\Http\Controllers;

use App\Models\pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pivotController extends Controller
{
    public function dodaj(Request $req)
    {
        $pivot = new pivot();
        $pivot->vjencanje = $req->vjencanje;
        $pivot->dokument = $req->dokument;
        $pivot->save();
        return $pivot;
    }
    public function obrisi(Request $req)
    {
        return DB::select('DELETE FROM PIVOTS WHERE VJENCANJE='.$req->vjencanje .' AND DOKUMENT='.$req->dokument);
    }
}
