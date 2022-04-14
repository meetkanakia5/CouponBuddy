<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\establishment;
use App\Models\Category;
use App\Models\EstablishmentDirection;
use App\Models\SubCategory;
use Auth;
use Session;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['establishments'] = Establishment::orderBy('sub_category_id', 'desc')->get();
        return view('admin.pages.establishment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['directions'] = ['east', 'west', 'north', 'south'];
        $data['categories'] = Category::orderBy('category')->get();
        return view('admin.pages.establishment.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
        $this->validateEstablishment($request);
        $this->saveEstablishment(new Establishment, $request);
        Session::flash('created', 'Data Successfully Created');
        return redirect()->route('admin.establishments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories']              = Category::orderBy('category')->get();
        $data['sub_categories']          = SubCategory::get();
        $data['establishment']           = Establishment::findOrFail($id);
        $data['establishment_directions'] = EstablishmentDirection::where('establishment_id', $id)->get(); 
        return view('admin.pages.establishment.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateEstablishment($request);
        $this->saveEstablishment(Establishment::findOrFail($id), $request);
        Session::flash('updated', 'Data Successfully Updated');
        return redirect()->route('admin.establishments.index');
    }

    public function validateEstablishment($data) {
        $data->validate([
            'category_id'        => 'required|max:255',
            'sub_category_id'    => 'required|max:255',
            'establishment_name' => 'required|max:50',
            'address'            => 'required|max:255',
            'pincode'            => 'required|max:255',
            'phone'              => 'required|digits:10',
        ]);

        if(!$data->isMethod('put')) {
            $data->validate([
                'email' => 'required|max:255|unique:establishments|email',
            ]);
        } else {
            $data->validate([
                'email' => 'required|max:255|email',
            ]);
        }
    }

    public function saveEstablishment($establishment, $data) {
        $establishment->admin_id     = Auth::user()->id;
        $establishment->category_id  = $data->category_id;
        $establishment->sub_category_id = $data->sub_category_id;
        $establishment->name         = $data->establishment_name;
        $establishment->phone        = $data->phone;
        $establishment->email        = $data->email;
        $establishment->save();

        //  Bridge table for storing multiple locations.
        if($data->isMethod('put')){
            $addressCount = EstablishmentDirection::where('establishment_id',$establishment->id)->count();
            $establishmentAddresses = EstablishmentDirection::where('establishment_id',$establishment->id)->get();
            foreach($establishmentAddresses as $establishmentAddress){
                $establishmentAddress->delete();
            }
        }
        
        for($i=0;$i<count($data->address);$i++) {
            $establishmentDirections = new EstablishmentDirection;
            $establishmentDirections->establishment_id = $establishment->id;
            $establishmentDirections->address = $data->address[$i];
            $establishmentDirections->pincode  = $data->pincode[$i];
            $establishmentDirections->direction = $data->direction[$i];
            $establishmentDirections->latitude = $data->latitude[$i];
            $establishmentDirections->longitude = $data->longitude[$i];
            $establishmentDirections->save();
        }
        //  else {
    
        //     $iteration = 0;
        //     $getAllDirections = $needle = $hayStack = array();

        //     // get all the subCategoriesDirections 
        //     $establishmentDirections = EstablishmentDirection::where('establishment_id', $establishment->id)->get();
        //     foreach($establishmentDirections as $establishmentDirection) {
        //         $getAllDirections[] = $establishmentDirection->direction;
        //     }

        //     // condition to take the major counts for the iteration
        //     if(count($getAllDirections) >= count($data->direction)) {
        //         $iteration = count($getAllDirections);
        //         $hayStack = $getAllDirections;
        //         $needle = $data->direction;
                
        //     } else {
        //         $iteration = count($data->direction);
        //         $hayStack = $data->direction;
        //         $needle = $getAllDirections;
        //     }
            
        //     //dd($needle, $hayStack);
        //     for($i=0; $i<$iteration; $i++) {
        //         if($hayStack[$i] != null) {
        //             // Update
        //             if(isset($needle[$i]) && in_array($needle[$i], $hayStack, true)) {
        //                 echo("present in DB Needle: ".$needle[$i]."<br>");
        //                 $establishmentDirection = EstablishmentDirection::findOrFail($establishmentDirections[$i]->id);
        //                 $establishmentDirection->direction = $data->direction[$i];
        //                 $establishmentDirection->latitude  = ($data->latitude[$i] == null) ? '0.0' : $data->latitude[$i];
        //                 $establishmentDirection->longitude = ($data->longitude[$i] == null) ? '0.0' : $data->longitude[$i];
        //                 $establishmentDirection->save();
        //             } else {
        //                 // Add
        //                 echo("not present in DB HayStack: ".$data->direction[$i]."<br>");
        //                 // sometimes if same directions are passed then it adds up in db thats why we made this condition
        //                 if(!in_array($hayStack[$i], $getAllDirections, true)) {
        //                     $establishmentDirections = new EstablishmentDirection;
        //                     $establishmentDirections->establishment_id = $establishment->id;
        //                     $establishmentDirections->direction = $data->direction[$i];
        //                     $establishmentDirections->latitude  = ($data->latitude[$i] == null) ? '0.0' : $data->latitude[$i];
        //                     $establishmentDirections->longitude = ($data->longitude[$i] == null) ? '0.0' : $data->longitude[$i];
        //                     $establishmentDirections->save();
        //                 }
        //             }
        //         }
        //     }
        // }
        //dd('r');
        return $establishment;
    }

    public function deleteestablishmentDirection(Request $request) {
        $diretion = EstablishmentDirection::findOrFail($request->id);
        if(isset($diretion)) {
            $diretion->delete();
            return json_encode('success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establishment = establishment::findOrFail($id);
        $establishment->delete();
        Session::flash('deleted', 'Data Successfully Deleted');
        return redirect()->route('admin.establishments.index');
    }
}

