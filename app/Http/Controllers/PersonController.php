<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Mail;
use App\Mail\PersonCaptured;

class PersonController extends Controller
{
    public function store(Request $request)
    {
        //validate the data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'sa_id_number' => 'required|string|unique:people',
            'mobile_number' => 'required|string',
            'email' => 'required|email|unique:people',
            'birth_date' => 'required|date',
            'language' => 'required|string',
            'interests' => 'required|array',
        ]);


        //store details
        $person = Person::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'sa_id_number' => $request->sa_id_number,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'language' => $request->language,
            'interests' => serialize($request->interests),
        ]);

        // Send email notification
        Mail::to($validatedData['email'])->send(new PersonCaptured($person, 'captured'));

  

        return response()
        ->json(
            [
                'status' => true,
                'message' => 'Person captured successfully'
        ]);
    }

    public function delete_person($id = null){
        $persons = Person::find($id);
        if($persons){
            $persons->delete();
        }
        return response()->json([
            'status' => true
        ]);
    }


    // fetch all persons ordered by id desc
    public function fetch(){
        $persons = Person::orderby('id','desc')->get();

        return response()->json([
            'persons' => $persons
        ]);
    }


      // fetch a single person 
    public function fetch_person($id = null){

        $person = Person::Where('id', $id)->first();

        return response()->json([
            'person' => $person
        ]);
    }



    public function update(Request $request)
    {

         //validate the data
        $id = $request->id;
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'sa_id_number' => 'required|string|unique:people,sa_id_number,' . $id,
            'mobile_number' => 'required|string',
            'email' => 'required|email|unique:people,email,' . $id,
            'birth_date' => 'required|date',
            'language' => 'required|string',
            'interests' => 'required|array',
        ]);
    
        $person = Person::findOrFail($id);
        $person->name = $request->name;
        $person->surname = $request->surname;
        $person->sa_id_number = $request->sa_id_number;
        $person->mobile_number = $request->mobile_number;
        $person->email = $request->email;
        $person->birth_date = $request->birth_date;
        $person->language = $request->language;
        $person->interests = serialize($request->interests);
        $person->save();
    
        // Send email notification
        Mail::to($validatedData['email'])->send(new PersonCaptured($person, 'updated'));

   
        return response()->json([
            'status' => true,
            'message' => 'Person updated successfully'
        ]);
    }

    
}
