<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use LaravelLegends\PtBrValidator\Rules\FormatoPlacaDeVeiculo;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:edit-admin');
    }

    public function index()
    {
        $search = request('vehicle_search');

        if($search) {
            $vehicles = Vehicle::where('plate', 'like', '%'.$search.'%')
                        ->orWhere('model', 'like', '%'.$search.'%')
                        ->orWhere('brand', 'like', '%'.$search.'%')
                        ->orWhere('type', 'like', '%'.$search.'%')->paginate(10);
        } else {
            $vehicles = Vehicle::paginate(10);
        }

        return view('admin.vehicles.index', [
            'vehicles' => $vehicles,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'plate',
            'brand',
            'model',
            'type',
            'year',
            'km',
            'lubrication',
            'status',
            'observation'
        ]);

        $validator = Validator::make($data, [
            'plate' => ['required', 'formato_placa_de_veiculo', 'unique:vehicles'],
            'status' => ['required'],
            'km' => ['required', 'integer'],
            'year' => ['max:4']
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $ext = $request->image->extension();
            $imageName = strtolower(str_replace(" ", "", $data['plate'])).'.'.$ext;
            $request->file('image')->move(public_path('media/images'), $imageName);
        }

        if($validator->fails()) {
            return redirect()->route('vehicle.create')
            ->withErrors($validator)
            ->withInput();
        }

        $vehicle = new Vehicle;
        $vehicle->plate = strtoupper($data['plate']);
        $vehicle->brand = strtoupper($data['brand']);
        $vehicle->model = strtoupper($data['model']);
        $vehicle->type = strtoupper($data['type']);
        $vehicle->year = $data['year'];
        $vehicle->km = $data['km'];
        $vehicle->lubrication = $data['lubrication'];
        $vehicle->status = $data['status'];
        $vehicle->observation = $data['observation'];
        $vehicle->save();

        return redirect()->route('vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if($vehicle) {
            return view('admin.vehicles.show', [
                'vehicle' => $vehicle
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        if($vehicle) {
            return view('admin.vehicles.edit', [
                'vehicle' => $vehicle
            ]);
        }

        return redirect()->route('vehicle.index');
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
        $vehicle = Vehicle::find($id);

        if($vehicle) {
            $data = $request->only([
                'plate',
                'brand',
                'model',
                'type',
                'year',
                'km',
                'lubrication',
                'status',
                'observation'
            ]);

            if($vehicle['plate'] !== $data['plate']) {
                $validator = Validator::make($data, [
                    'plate' => ['required', 'formato_placa_de_veiculo', 'unique:vehicles'],
                    'status' => ['required'],
                    'km' => ['required', 'integer'],
                    'year' => ['max:4']
                ]);
            } else {
                $validator = Validator::make($data, [
                    'status' => ['required'],
                    'km' => ['required', 'integer'],
                    'year' => ['max:4']
                ]);
            }

            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $ext = $request->image->extension();
                $imageName = strtolower(str_replace(" ", "", $data['plate'])).'.'.$ext;
                $request->file('image')->move(public_path('media/images'), $imageName);
            }

            $vehicle->plate = strtoupper($data['plate']);
            $vehicle->brand = strtoupper($data['brand']);
            $vehicle->model = strtoupper($data['model']);
            $vehicle->type = strtoupper($data['type']);
            $vehicle->year = $data['year'];
            $vehicle->km = $data['km'];
            $vehicle->lubrication = $data['lubrication'];
            $vehicle->status = $data['status'];
            $vehicle->observation = $data['observation'];

            if($validator->fails()) {
                return redirect()->route('vehicle.edit', [
                    'vehicle' => $id
                ])->withErrors($validator)
                ->withInput();
            }

            $vehicle->save();

            return redirect()->route('vehicle.index');
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
        $vehicle = Vehicle::find($id);
        $vehicle->delete();

        return redirect()->route('vehicle.index');
    }
}
