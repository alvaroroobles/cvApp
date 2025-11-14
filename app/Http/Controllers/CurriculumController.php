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
        // Obtiene todos los currículums con Eloquent (SELECT * FROM curriculums)
        $curriculums = Curriculum::all();
        
        // Devuelve la vista y le pasa los datos
        return view('curriculum.index', ['curriculums' => $curriculums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Simplemente muestra el formulario de creación
        return view('curriculum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Crea un nuevo objeto Curriculum con todos los datos del formulario
         $curriculum = new Curriculum($request->all()); 

         $result=false;

         try{
            // Guarda el registro en la base de datos
            $result = $curriculum->save(); 
            $txtmessage='The CV has been added';
            
            // Si se ha subido una imagen, la procesa
            if($request->hasFile('image')){
               // Subida de la imagen
               $ruta = $this->upload($request, $curriculum);

               // Guarda la ruta en el campo image del modelo
               $curriculum->image = $ruta;

               // Vuelve a guardar el modelo con la imagen incluida
               $curriculum->save();
            }

            // Si se ha subido un PDF, lo procesa
            if($request->hasFile('pdf')) {
               // Llama al método uploadPDF (aunque aquí no se almacena en la BD)
               $ruta = $this->uploadPDF($request,$curriculum);
            }

         }
         catch(UniqueConstraintViolationException $e){
            // Si hay un error de clave única
            $txtmessage='Clave única';
         }
         catch(QueryException $e){
            // Si un campo se envía nulo donde no debería
            $txtmessage='Campo nulo';
         } catch(\Exception $e){
            // Dump completo de la excepción para depurar (interrumpe la ejecución)
            dd($e->getMessage(), $e->getFile(), $e->getLine());
         }

         // Mensaje que se enviará al redirect
         $messageArray = [
            'mensajeTexto' => $txtmessage
        ];

         // Si el guardado ha sido correcto redirige, si no vuelve atrás
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
        // Muestra un currículum en concreto
        return view('curriculum.show', ['curriculum' => $curriculum]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculum)
    {
       // Muestra la vista de edición con los datos cargados
       return view('curriculum.edit', ['curriculum' => $curriculum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curriculum $curriculum)
    {
         $result=false;

         // Actualiza el modelo con los datos enviados
         $curriculum->fill($request->all());

         try{
            // Guarda los cambios
            $result = $curriculum->save(); 
            $txtmessage='The CV has been modified';

            // Manejo de imagen en actualización
            if($request->hasFile('image')){
               // Sube la imagen
               $ruta = $this->upload($request, $curriculum);
               $curriculum->image = $ruta;   // ← guardar la nueva ruta
               $curriculum->save();
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

         // Redirige según resultado
         if($result){
            return redirect()->route('main')->with($messageArray);
         } else{
            return back()->withInput()->withErrors($messageArray);
         }
    }
    
    private function upload(Request $request, Curriculum $curriculum) {

        // Obtiene el archivo de imagen
        $image = $request->file('image');

        // Construye el nombre del archivo con el ID del curriculum
        $name = $curriculum->id . '.' . $image->getClientOriginalExtension();

        // Guarda en "storage/app/public/curriculum"
        $ruta = $image->storeAs('curriculum', $name, 'public');

        // Vuelve a guardar en "storage/app/curriculum" sin ser público (local)
        // ⚠️ IMPORTANTE: esta línea sobrescribe la variable anterior
        $ruta = $image->storeAs('curriculum', $name, 'local');
        
        // Devuelve la última ruta guardada (local)
        return $ruta;
    }

    private function uploadPDF(Request $request, Curriculum $curriculum){

      // Obtiene el PDF
      $pdf = $request->file('pdf');

      // Construye el nombre del archivo
      $name = $curriculum->id . '.' . $pdf->getClientOriginalExtension();

      // Lo guarda en /public/pdf
      $ruta = $pdf->storeAs('pdf',$name,'public'); 

      // Vuelve a guardarlo en /local/pdf
      // ⚠️ Igual que antes, esta línea pisa la anterior
      $ruta = $pdf->storeAs('pdf',$name,'local');

      return $ruta;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        try {
            // Borra el registro
            $result = $curriculum->delete();
            $textMessage = 'El curriculum se ha eliminado.';
        } catch(\Exception $e) {
            // Si falla, devuelve error
            $textMessage = 'El curriculum no se ha podido eliminar.';
            $result = false;
        }

        // Mensaje para mostrar al usuario
        $message = [
            'mensajeTexto' => $textMessage,
        ];

        // Redirección según éxito o fallo
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}
