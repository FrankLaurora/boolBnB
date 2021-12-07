<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        'cover' => 'nullable|mimes:jpeg,jpg,png|max:1024',
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
        // slug, latitude, longitude, visibility, user_id
        if($request->cover != null){
            $newApartment->cover = Storage::put('apartments_cover', $request->cover);
        }


        // $autofill = $this->inputToLower($request->all());
        
        $newApartment->fill($request->all());

        $client = new Client([ 'base_uri' => 'https://api.tomtom.com/search/2/search/', 'timeout'  => 2.0, 'verify' => false]); 
        
        $response = $client->get($request->address . ' ' . $request->city . ' ' . $request->region . '.json?key=lXA4qKasPyxqJxup4ikKlTFOL3Z89cp4');
        
        $results = json_decode($response->getBody());

        $results = $results->results;
        for($i = 0; $i < count($results) && $newApartment->latitude == ''; $i++){
            if(isset($results[$i]->address->municipality) && strtolower($results[$i]->address->municipality) == strtolower($request->city)){
                $newApartment->latitude = $results[$i]->position->lat;
                $newApartment->longitude = $results[$i]->position->lon;
            }
        };
        if($newApartment->latitude==null){
            $response = $client->get($request->city . ' ' . $request->region . '.json?key=lXA4qKasPyxqJxup4ikKlTFOL3Z89cp4');

            $results = json_decode($response->getBody());

            $results = $results->results;

            for($i = 0; $i < count($results) && $newApartment->latitude == ''; $i++){
                if(isset($results[$i]->address->municipality) && strtolower($results[$i]->address->municipality) == strtolower($request->city)){
                    $newApartment->latitude = $results[$i]->position->lat;
                    $newApartment->longitude = $results[$i]->position->lon;
                }
            };
        }
        if($newApartment->latitude==null){
            return redirect()->route('admin.apartments.index')->with('error', 'Errore, indirizzo o città inesistente');
        }
        
        $newApartment->slug = $this->getSlug($newApartment->title);
        $newApartment->visibility = true;
        $newApartment->user_id = Auth::user()->id;

        $newApartment->save();

        return redirect()->route('admin.apartments.index')->with('success','Aggiunto appartamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate($this->validationRules);

        // if($request->cover != null){
        //     $apartment->cover = Storage::put('apartments_cover', $request->cover);
        // }

        if(array_key_exists('cover', $request->all())){

            if($apartment->cover){
                Storage::delete($apartment->cover);
            }

            $apartment->cover = Storage::put('apartments_cover', $request->cover);
        }

        // $apartment->cover = Storage::put('apartments_cover', $request->cover);

        $apartment->fill($request->all());
        // slug, latitude, longitude, visibility, user_id

        $client = new Client([ 'base_uri' => 'https://api.tomtom.com/search/2/search/', 'timeout'  => 2.0, 'verify' => false]); 
        
        $response = $client->get($request->address . ' ' . $request->city . ' ' . $request->region . '.json?key=lXA4qKasPyxqJxup4ikKlTFOL3Z89cp4');
        
        $results = json_decode($response->getBody());

        $results = $results->results;
        
        for($i = 0; $i < count($results) && $apartment->latitude == ''; $i++){
            if($results[$i]->address->municipality == $request->city){
                $apartment->latitude = $results[$i]->position->lat;
                $apartment->longitude = $results[$i]->position->lon;
            }
        };

        $apartment->slug = $this->getSlug($apartment->title);
        $apartment->visibility = true;
        $apartment->user_id = Auth::user()->id;

        $apartment->save();

        return redirect()->route('admin.apartments.index')->with('success', 'Modifiche effettuate correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect('admin/apartments')->with('success','Annuncio Eliminato');
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

    // protected function inputToLower($array) {
    //     foreach($array as $key=>$value){
    //         if($key == "_token"){

    //         }elseif(is_string($array->$key)){
    //             strtolower($array->$key);
    //         }
    //     }
    //     return $array;
    // }
}
