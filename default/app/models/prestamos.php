<?php
    
    class Prestamos extends ActiveRecord{	
        /**
      * Retorna los menús para ser paginados
      *
      * @param int $page  [requerido] página a visualizar
      * @param int $ppage [opcional] por defecto 20 por página
      */
    public function getRegistros($page, $ppage=20)
    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id asc');
    }
    }