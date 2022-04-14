<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Session;
use App\Models\EstablishmentDirection;
use App\Models\Establishment;
use App\Models\SubCategory;

class AjaxController extends Controller
{
    public function getSubCategories(Request $request) {
        $data['sub_categories'] = SubCategory::where('category_id', $request->category_id)->orderBy('id', 'desc')->get();
        return response()->json($data);
    }

    public function deleteDirection(Request $request) {

        $data['deleted_direction'] = EstablishmentDirection::where('establishment_id', $request->establishment_id)->where('direction', $request->direction)->first();

        if(isset($data['deleted_direction']) > 0) {
            $data['deleted_direction']->delete();
            $data['message'] = "successful";
        } else {
            $data['message'] = "unsuccessful";
        }

        return response()->json($data);
    }

    public function getEstablishments(Request $request) {
        $data['establishments'] = Establishment::where('sub_category_id', $request->sub_category_id)->orderBy('id', 'desc')->get();
        return response()->json($data);
    }
}