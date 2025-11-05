<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculums = Curriculum::all();//eloquent, da un array con todos los datos de la tabla
        return view('curriculum.index', ['curriculums' => $curriculums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curriculum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $curriculum = new Curriculum($request->all()); //Eloquent
         $result=false;
         try{
            $result = $curriculum->save(); //Eloquent, inserta objeto en la tabla.
            $txtmessage='The CV has been added';
            
            if($request->hasFile('image')){
               $ruta = $this->upload($request, $curriculum);
               $curriculum->image = $ruta;
               $curriculum->save();
            }

            if($request->hasFile('pdf')) {
               $ruta = $this->uploadPDF($request,$curriculum);
            }
         }
         catch(UniqueConstraintViolationException $e){
            $txtmessage='Clave única';
         }
         catch(QueryException $e){
            $txtmessage='Campo nulo';
         } catch(\Exception $e){
            dd($e->getMessage(), $e->getFile(), $e->getLine());
         }
         $messageArray = [
            'mensajeTexto' => $txtmessage
        ];
         if($result){
            return redirect()->route('main')->with($messageArray);
         } else{
            return back()->withInput()->withErrors($messageArray);
         }      
    }

    /**
     * Display the specified resource.
     */
    public function show(Curriculum $curriculum)
    {
        return view('curriculum.show', ['curriculum' => $curriculum]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculum)
    {
       return view('curriculum.edit', ['curriculum' => $curriculum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curriculum $curriculum)
    {
         $result=false;
         $curriculum->fill($request->all());
         try{
            $result = $curriculum->save(); //Eloquent, inserta objeto en la tabla.
            $txtmessage='The CV has been modified';

            if($request->hasFile('image')){
               $ruta = $this->upload($request, $curriculum);
            }
         }
         catch(UniqueConstraintViolationException $e){
            $txtmessage='Clave única';
         }
         catch(QueryException $e){
            $txtmessage='Campo nulo';
         } catch(\Exception $e){
            $txtmessage= 'Otra excepcion';
         }
         $messageArray = [
            'mensajeTexto' => $txtmessage
        ];
         if($result){
            return redirect()->route('main')->with($messageArray);
         } else{
            return back()->withInput()->withErrors($messageArray);
         }
    }
    
    private function upload(Request $request, Curriculum $curriculum) {
        $image = $request->file('image');
        $name = $curriculum->id . '.' . $image->getClientOriginalExtension();
        $ruta = $image->storeAs('curriculum', $name, 'public');
        $ruta = $image->storeAs('curriculum', $name, 'local');
        
        return $ruta;
    }

    private function uploadPDF(Request $request, Curriculum $curriculum){
      //Guarda en la variable img el acceso a la foto subida.
      $pdf = $request->file('pdf');
      $name = $curriculum->id . '.' . $pdf->getClientOriginalExtension();
      $ruta = $pdf->storeAs('pdf',$name,'public'); 
      $ruta = $pdf->storeAs('pdf',$name,'local');
      return $ruta;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        try {
            $result = $curriculum->delete();
            $textMessage = 'El curriculum se ha eliminado.';
        } catch(\Exception $e) {
            $textMessage = 'El curriculum no se ha podido eliminar.';
            $result = false;
        }
        $message = [
            'mensajeTexto' => $textMessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}
