<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ApartmentController extends Controller
{
    /*validation rules*/
    protected $validationRules = [
        'title' => 'required|string|max:100|min:5',
        'rooms' => 'required|integer|min:1|max:255',
        'guests_number' => 'required|integer|min:1|max:255',
        'bathrooms' => 'required|integer|min:1|max:255',
        'sqm' => 'nullable|integer|min:1|max:1000',
        'region' => 'required|string|max:255|min:4',
        'city' => 'required|string|max:255|min:2',
        'address' => 'required|string|max:255|min:5',
        'number' => 'required|integer|min:1|max:5000',
        'cover' => 'nullable|url|max:255',
        'description' => 'nullable|string|max:10000'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = Auth::user()->id;

        $apartments = Apartment::all()->where('user_id', $user_id);

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $newApartment = new Apartment();
        $newApartment->fill($request->all());
        // slug, latitude, longitude, visibility, user_id
        $newApartment->slug = $this->getSlug($newApartment->title);
        $newApartment->visibility = true;
        $newApartment->user_id = Auth::user()->id;
        $newApartment->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getSlug($title) 
    {
        // creo lo slug con l'helper partendo dal $title
        $slug = Str::of($title)->slug('-');
        //creo una variabile che avrà un valore diverso da null nel momento in cui il database conterrà una entry la cui voce slug sarà uguale a quella che ho appena creato
        $duplicateSlug = Apartment::where('slug', $slug)->first();
        //inizializzo un contatore che utilizzerò per aggiungere un numero incrementale allo slug nel caso in cui ci fosse un duplicato
        $count = 2;
        //entro in un ciclo while nel caso in cui il valore di $duplicateSlug non sia null
        while($duplicateSlug) {
            // creo un nuovo slug concatenando il valore del count
            $slug = Str::of($title)->slug('-') . "-{$count}";
            //verifico che il nuovo slug non esista
            $duplicateSlug = Apartment::where('slug', $slug)->first();
            //se il nuovo slug non esiste il valore di $duplicateSlug sarà nullo ed uscirò dal ciclo
            //aumento il contatore per far sì che, in caso di slug duplicato, venga assegnato un nuovo valore alla successiva iterazione del ciclo
            $count++;
        }
        // restituisco lo slug
        return $slug;
    }
}
