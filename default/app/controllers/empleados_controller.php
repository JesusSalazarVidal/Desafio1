<?php

class EmpleadosController extends AppController
{
    public function index()
    {
        View::template(null);
    }

    public function listar($page = 1)
    {
        View::template(null);
         $this->listRegistros = (new Empleados())->getRegistros($page);
    }

    public function crear()
    {
        View::template(null);
        
        if (Input::hasPost('registros')) {
            
            $registro = new Empleados(Input::post('registros'));
            //En caso que falle la operación de guardar
            if ($registro->create()) {
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
        
        $buscado = (new Empleados())->find_by_id((int)$id);

        if($buscado != NULL){
            $registro = new Empleados();
            //verificar si se ha enviado el formulario
            if(Input::hasPost('registros')){
                if($registro->update(Input::post('registros'))){
                    Flash::valid('Operacion exitosa');
                    return Redirect::to('empleados/listar');
                }
                Flash::error('Fallo la operación');
            return;
            }   
            $this->registros = $registro->find_by_id((int)$id);
        }else{
            Flash::error('El ID no existe');
            View::template('noID');
        }
        
    }

    public function eliminar($id){
        View::template(null);
        if((new Empleados())->delete((int) $id)){
            Flash::valid('Operacion Exitosa');
        }else{
            Flash::error('Fallo Operacion');

        }
        return Redirect::to('empleados/listar');
    }

    public function ver($id){
        View::template(null);
        $this->buscado = (new Empleados())->find_by_id((int)$id);
    }
}

