<?php

class ConfigurationModule extends PDORepository{
    
    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public function indexPageInfo(){
        //Retorna un objeto Configuracion, con la informacion obtenida de la bd.
        $answer = $this->queryList("SELECT * FROM configuracion",[]);
        $final_answer = new Configuration($answer[0]['titulo_pagina'],$answer[0]['mail_contacto'],$answer[0]['elementos_pagina'],$answer[0]['pagina_activa']);
        return $final_answer;
    }
    
    public function tienePermiso($rol,$permiso){
        //Busca en la bd si el rol pasado por parametros tiene permisos de configuracion
        $answer = $this->queryList("SELECT * FROM `rol_tiene_permiso` rp INNER JOIN `permiso` p ON(rp.permiso_id=p.id) WHERE p.nombre=:permiso AND rp.rol_id=:rolId", ['rolId'=>$rol,'permiso'=>$permiso]);
        if(count($answer)>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function elementosPorPagina(){
        $answer = $this->queryList("SELECT elementos_pagina FROM configuracion", []);
        return $answer[0]['elementos_pagina'];
    }
}