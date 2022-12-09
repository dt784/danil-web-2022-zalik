<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployerCollection;
use App\Models\Employer;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->query('per_page');

        return response(new EmployerCollection(Employer::paginate($per_page)), Response::HTTP_OK);
    }

    public function store()
    {
//        $validator = Validator::make(
//            array('name' => 'required|min:5'),
//            array('address' => 'required|min:5'),
//            array('card_code' => 'required|min:5')
//        );
//        if ($validator->fails())
//        {
//            return redirect()->route('employers.show', ['employer' => 1])->withErrors($validator, 'name');
//        }
        return redirect()->route('employers.show', ['employer' => 1]);
    }
}
