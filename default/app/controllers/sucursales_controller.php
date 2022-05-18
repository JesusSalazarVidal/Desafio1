<?php

class SucursalesController extends AppController
{
    public function index()
    {
        View::template(null);
    }

    public function listar($page = 1)
    {
        View::template(null);
         $this->listSucursales = (new Sucursales())->getSucursales($page);
    }

    public function crear()
    {
        View::template(null);
        
        if (Input::hasPost('sucursales')) {
            
            $sucursal = new Sucursales(Input::post('sucursales'));
            //En caso que falle la operación de guardar
            if ($sucursal->create()) {
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
        
        $buscado = (new Sucursales())->find_by_id((int)$id);

        if($buscado != NULL){
            $sucursal = new Sucursales();
            //verificar si se ha enviado el formulario
            if(Input::hasPost('sucursales')){
                if($sucursal->update(Input::post('sucursales'))){
                    Flash::valid('Operacion exitosa');
                    return Redirect::to('sucursales/listar');
                }
                Flash::error('Fallo la operación');
            return;
            }   
            $this->sucursales = $sucursal->find_by_id((int)$id);
        }else{
            Flash::error('El ID no existe');
            View::template('noID');
        }
        
    }

    public function eliminar($id){
        View::template(null);
        if((new Sucursales())->delete((int) $id)){
            Flash::valid('Operacion Exitosa');
        }else{
            Flash::error('Fallo Operacion');

        }
        return Redirect::to('sucursales/listar');
    }

    public function ver($id){
        View::template(null);
        $this->buscado = (new Sucursales())->find_by_id((int)$id);
    }
}

