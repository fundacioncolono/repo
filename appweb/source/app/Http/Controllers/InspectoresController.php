<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inspector;
use App\Models\Persona;
use App\Models\Usuario;

use App\Services\UserRegistratorService;

use DB;
use Filter;

class InspectoresController extends Controller{

	const MAX_RECORDS = 16;
	
	public function all(Request $request){
	  
		$orderBy = [
			'by'           => $request['by'],
			'order'        => $request['order'],
			'relationship' => $request['relationship']
		];

		$inspectores = Filter::with(Inspector::class, ['persona', 'usuario', 'visitas'])		
		->orderBy($orderBy['relationship'], $orderBy['by'], $orderBy['order'])
		->get();

		if($request['filter'] != '')
			$inspectores = $inspectores->where('activo', $request['filter']);

		$pagination = Filter::paginate($inspectores, self::MAX_RECORDS);
		$items = $pagination->items();

		foreach ($items as $item) {
		    //$item->activo = !$item->trashed();
		    foreach ($item->visitas as $visita) {
		        $visita->expediente->persona;
		    }
		}

	  	return response()->json([
        	'inspectores' => $items,
        	'total' => $pagination->total(),
        	'filtro' => $request['filter']
      	]);
	}

	public function index(){
		return view('templates.inspector.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		return view('templates.inspector.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request){

		$status = true;
		DB::beginTransaction();

		try{

			//Create Persona
			$persona = Persona::create($request->all());

			//Create user account with validation
			$user = UserRegistratorService::create($request->all(), true);

			//Instatiate Inspector model
			$inspector = new Inspector();

			//Associate persona and usuario
			$inspector->persona()->associate($persona);
			$inspector->usuario()->associate($user);

			// Save model
			$inspector->save();

			DB::commit();
		}

		catch(\Exception $e){
			$status = false;
			DB::rollback();
			throw $e;
		}

		return redirect()
			->route('inspectores.create')
			->with('status', [
				'type'  => $status ? 'success' : 'error',
				'title' => $status ? '¡Operación exitosa!' : 'Ocurrió un error.',
				'msg'   => $status ? 'Se ha creado el inspector correctamente.':
								   	'Es posible que los datos ingresados sean incorrectos.\n'.
								   	'Si el problema persiste, por favor contacte a soporte.',
			]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		//
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
    	
   	   	$status = Inspector::where( 'id', $request['id'] )->update( ['activo' => $request['activo'] == 1 ? 0 : 1  ]);

		return response()->json([
			'status' => $status,
			'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
			'type'   => $status ? 'success' : 'error',
			'msg'    => $status ? 'Se desactivó esta cuenta de inspector correctamente.': 'Si el problema persiste, por favor contacte con soporte.',
		]);
	}

   public function destroy($id){
   		//
   }


    private function hasEmptyValues($array){
		foreach ($array as $item) return empty($item);
		
		return false;
  	}
}
