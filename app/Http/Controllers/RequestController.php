<?php

namespace App\Http\Controllers;

use App\Events\RequestIsCreated;
use App\Models\Keys;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'barcode' => 'required',
//            'cpf' => 'required',
//            'username' => 'required',
//            'phone' => 'required',
//            'key' => 'required',
//            'type' => 'required',
//            'service' => 'required',
//            'company' => 'required',
//            'manager' => 'required',
//            'concierge' => 'required'
//        ]);
        $data = new Requests([
            'cpf' => $request->get('cpf'),
            'barcode' => $request->get('barcode'),
            'username' => $request->get('username'),
            'phone' => $request->get('phone'),
            'key' => $request->get('key'),
            'type' => $request->get('type'),
            'service' => $request->get('service'),
            'company' => $request->get('company'),
            'manager' => $request->get('manager'),
            'concierge' => $request->get('concierge')
        ]);

        //Faz a Atualização do status da chave
        $updateStatus = DB::table('keys')
            ->where('barcode', $request->get('barcode'))
            ->update(['status' => 'I']);

        if($updateStatus){
            $data->save();
        }

        $response = $data->save();

        if ($response) {
            //Passa a notificação para a view para iterar no swal pela sessão
            $notification = array(
                'success' => true,
                'title' => 'Sucesso!',
                'message' => 'Chave solicitada com Sucesso!',
                'alert-type' => 'success'
            );

        } elseif(!$this->validate){
            $notification = array(
                'error' => true,
                'title' => 'Erro!',
                'message' => 'Campos necessários não foram digitados!',
                'alert-type' => 'error'
            );
        } else {
            //Passa a notificação pela sessão para a view
            $notification = array(
                "error" => true,
                "message" => "Erro! Chave não cadastrada!",
                'alert-type' => 'warning'
            );

        }

        return redirect()->back()->with($notification);

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
}
