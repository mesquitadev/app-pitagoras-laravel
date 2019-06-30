<?php

namespace App\Http\Controllers;

use App\Events\RequestIsCreated;
use App\Models\Keys;
use App\Models\Requests;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'cpf' => 'required',
            'barcode' => 'required|unique',
            'username' => 'required',
            'key' => 'required',
            'type' => 'required',
            'service' => 'required',
            'company' => 'required',
            'manager' => 'required'
        ]);
        $data = new Requests([
            'cpf' => $request->get('cpf'),
            'barcode' => $request->get('barcode'),
            'username' => $request->get('username'),
            'key' => $request->get('key'),
            'type' => $request->get('type'),
            'service' => $request->get('service'),
            'company' => $request->get('company'),
            'manager' => $request->get('manager')
        ]);

        $data->save();

        $response = $data->save();

        if ($response) {
            //Recupera a chave no banco para passar o id pro evento
            $key = Keys::where('barcode', $request->get('barcode'));
            //Dispara o evento pra atualizar a tabela do status
            event(new RequestIsCreated($key));

            //Passa a notificação para a view para iterar no swal pela sessão
            $notification = array(
                'success' => true,
                'message' => 'Chave solicitada com Sucesso!',
                'alert-type' => 'success'
            );


        } else {
            //Passa a notificação pela sessão para a view
            $notification = array(
                "error" => true,
                "message" => "Erro! Chave não cadastrada!",
                'alert-type' => 'warning'
            );

        }

        return redirect('dashboard')->with($notification);

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
