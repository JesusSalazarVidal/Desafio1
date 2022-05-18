<?php

class AbogadosController extends AppController
{
    public function index()
    {
        View::template(null);
    }

    public function listar($page = 1)
    {
        View::template(null);
         $this->listAbogados = (new Abogados())->getAbogados($page);
    }

    public function crear()
    {
        View::template(null);
        
        if (Input::hasPost('abogados')) {
            
            $abogado = new Abogados(Input::post('abogados'));
            //En caso que falle la operación de guardar
            if ($abogado->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }
 
            Flash::error('Falló Operación');
        }
    }

  

    public function editar($id){
        View::template(null);
        
        $buscado = (new Abogados())->find_by_id((int)$id);

        if($buscado != NULL){
            $abogado = new Abogados();
            //verificar si se ha enviado el formulario
            if(Input::hasPost('abogados')){
                if($abogado->update(Input::post('abogados'))){
                    Flash::valid('Operacion exitosa');
                    return Redirect::to('abogados/listar');
                }
                Flash::error('Fallo la operación');
            return;
            }   
            $this->abogados = $abogado->find_by_id((int)$id);
        }else{
            Flash::error('El ID no existe');
            View::template('noID');
        }
        
    }

    public function eliminar($id){
        View::template(null);
        if((new Abogados())->delete((int) $id)){
            Flash::valid('Operacion Exitosa');
        }else{
            Flash::error('Fallo Operacion');

        }
        return Redirect::to('abogados/listar');
    }

    public function ver($id){
        View::template(null);
        $this->buscado = (new Abogados())->find_by_id((int)$id);
    }
}

