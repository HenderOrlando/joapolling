<?php

/**
 * entidadEducativa actions.
 *
 * @package    sf_sandbox
 * @subpackage entidadEducativa
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class entidadEducativaActions extends sfActions
{
  public function executeAgregaFondo(sfWebRequest $request)
  {
      if($request->getParameter('fondo') == 'Foto')
          $this->formArchivo($request,$request->getParameter('nombreCandidato'));
      $this->formArchivo($request);
  }
  public function executeAgregaLogo(sfWebRequest $request)
  {
    $this->formArchivo($request);
    $this->setTemplate('agregaFondo');
  }
  public function executeAgregaFotoCandidato(sfWebRequest $request)
  {
    $this->nombreCandidato = $request->getParameter('nombreCandidato');
    $this->id_candidato = $request->getParameter('id_candidato');
    $this->formArchivo($request,'Foto_'.$this->nombreCandidato, 'Foto');
    $this->setTemplate('agregaFondo');
  }
  
  private function formArchivo(sfWebRequest $request, $nombreArchivo = 'fondo', $nombre = 'Logo'){
      $this->form = new ArchivoFileForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Fondo de '.$request->getParameter('fondo')));
    if($request->hasParameter('fondo')){
        $nombre = $request->getParameter('fondo');
    }
    if($tipo = TipoTable::getInstance()->findOneBy('nombre', $nombre)){
        $this->fondo = $tipo->getNombre();
        if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
            if($usr->procesarFormulario($this->form, $request, FALSE)){
                $dir = sfConfig::get('sf_upload_dir').'/../images/entidadesEducativas/'.$usr->getAttribute('abreviaturaEntidadEducativa').'/';
                if((!file_exists($dir) && mkdir($dir)) || (file_exists($dir))){
                    $file = $this->form->getValue('archivo');
                    $nombre = $nombreArchivo.'_'.$tipo->getNombre();
                    $ext = $file->getExtension($file->getOriginalExtension());
                    
                    $archivo = new Archivo();
                    $archivo->setNombre($nombre);
                    $archivo->setExtension($ext);
                    $archivo->setSrc('entidadesEducativas/'.$usr->getAttribute('abreviaturaEntidadEducativa').'/'.$nombre.$ext);
                    
                    $archivoEntidadEducativa = new ArchivosEntidadEducativa();
                    $archivoEntidadEducativa->setArchivo($archivo);
                    $archivoEntidadEducativa->setIdEntidadEducativa($usr->getAttribute('idEntidadEducativa'));
                    $archivoEntidadEducativa->setTipo($tipo);
                    $archivoEntidadEducativa->setFechaCreado(date('Y-m-d H:i:s'));
                    
                    $file->save($dir.$nombre.$ext);
                    $archivo->save();
                    $archivoEntidadEducativa->save();
                    
                    $usr->setFlash('msg', 'Archivo Guardado');
                }else{
                    $usr->setFlash('msg', 'Error!!');
                }
            }
            else{
                $usr->setFlash('msg', 'Archivo no válido.');
            }
        }
    }else{
        $usr->setFlash('msg1', 'Fondo no válido.');
        $this->redirect('@homepage');
    }
  }
  
  /**
  * Crear una nueva Mesa
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaMesa(sfWebRequest $request)
  {
    $this->form = new mesaForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Mesas'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($mesa = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Mesa '.$mesa->getNombre().' Agregada');
            $this->redirect('entidadEducativa/actualizaMesa?nombre='.$mesa->getNombre().'&id_mesa='.$mesa->getIdMesa());
        }
    }
    $this->setTemplate('formMesa');
  }
  
  /**
  * Actualizar una Mesa Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaMesa(sfWebRequest $request)
  {
    $this->forward404Unless($mesa = Doctrine_Core::getTable('mesa')->find(array($request->getParameter('id_mesa'))), sprintf('Object mesa does not exist (%s).', $request->getParameter('id_mesa')));
    $this->form = new mesaForm($mesa);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Mesas'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($mesa = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Mesa "'.$mesa->getNombre().'" Actualizada';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$mesa->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Mesa "'.$mesa->getNombre().'" Eliminada';
        $mesa->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formMesa');
  }
  
  /**
  * Crear una nueva Grupo
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaGrupo(sfWebRequest $request)
  {
    $this->form = new grupoForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Grupos'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($grupo = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Grupo '.$grupo->getNombre().' Agregado');
            $this->redirect('@actualizaGrupo?nombre='.$grupo->getNombre().'&id_grupo='.$grupo->getIdGrupo());
        }
    }
    $this->setTemplate('formGrupo');
  }
  
  /**
  * Actualizar una Grupo Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaGrado(sfWebRequest $request)
  {
    $this->forward404Unless($grado = Doctrine_Core::getTable('grado')->findOneBy('id_grado',$request->getParameter('id_grado')), sprintf('Object grado does not exist (%s).', $request->getParameter('id_grado')));
    $this->form = new gradoForm($grado);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Grados'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($grado1 = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Grado "'.$grado1->getNombre().'" Actualizado';
            $grado = $grado1;
        }
        else
            $msg = 'Problemas actualizando datos de"'.$grado->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Grado "'.$grado->getNombre().'" Eliminada';
        $grado->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formGrado');
  }
  
  /**
  * Crear una nueva Estudiante
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaEstudiante(sfWebRequest $request)
  {
    $this->form = new estudianteForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Estudiantes'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($estudiante = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Estudiante '.$estudiante->getNombre().' Agregado');
            $this->redirect('@actualizaEstudiante?nombre='.$estudiante->getNombre().'&id_estudiante='.$estudiante->getIdEstudiante());
        }
    }
    $this->setTemplate('formEstudiante');
  }
  
  /**
  * Actualizar una Estudiante Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaEstudiante(sfWebRequest $request)
  {
    $this->forward404Unless($estudiante = Doctrine_Core::getTable('estudiante')->find(array($request->getParameter('id_estudiante'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('id_estudiante')));
    $this->form = new estudianteForm($estudiante);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Estudiantes'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($estudiante = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Estudiante "'.$estudiante->getNombre().'" Actualizado';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$estudiante->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Estudiante "'.$estudiante->getNombre().'" Eliminada';
        $estudiante->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formEstudiante');
  }
  
  /**
  * Crear una nueva Persona
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaPersona(sfWebRequest $request)
  {
    $this->form = new personaForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Personas'));
    $this->tipo = $request->getParameter('tipo');
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($persona = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Persona '.$persona->getNombre().' Agregado');
            $this->redirect('@actualizaPersona?nombre='.$persona->getNombre().'&id_persona='.$persona->getIdPersona().'&tipo='.$this->tipo);
        }
    }
    $this->setTemplate('formPersona');
  }
  
  /**
  * Actualizar una Persona Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaPersona(sfWebRequest $request)
  {
    $this->forward404Unless($persona = Doctrine_Core::getTable('persona')->find(array($request->getParameter('id_persona'))), sprintf('Object persona does not exist (%s).', $request->getParameter('id_persona')));
    $this->form = new personaForm($persona);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Personas'));
    $this->tipo = $request->getParameter('tipo');
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($persona = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Persona "'.$persona->getNombre().'" Actualizado';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$persona->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Persona "'.$persona->getNombre().'" Eliminada';
        $persona->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formPersona');
  }
  
  /**
  * Crear una nueva Votante
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaVotante(sfWebRequest $request)
  {
    $this->form = new votanteForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Votantes'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($votante = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Votante '.$votante->getNombre().' Agregado');
            $this->redirect('@actualizaVotante?nombre='.$votante->getNombre().'&id_votante='.$votante->getIdVotante());
        }
    }
    $this->setTemplate('formVotante');
  }
  
  /**
  * Actualizar una Votante Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaVotante(sfWebRequest $request)
  {
    $this->forward404Unless($votante = Doctrine_Core::getTable('votante')->find(array('id_votante' => $request->getParameter('id_votante'))), sprintf('Object votante does not exist (%s,%s).', $request->getParameter('id_votante'), $request->getParameter('id_tipo')));
    $this->form = new votanteForm($votante);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Votantes'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($votante = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Votante "'.$votante->getNombre().'" Actualizado';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$votante->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Votante "'.$votante->getNombre().'" Eliminada';
        $votante->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formVotante');
  }
  
  /**
  * Crear una nueva Candidato
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaCandidato(sfWebRequest $request)
  {
    $this->form = new candidatoForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Candidatos'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($candidato = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Candidato '.$candidato->getNombre().' Agregado');
            $this->redirect('@actualizaCandidato?nombre='.$candidato->getNombre().'&id_candidato='.$candidato->getIdCandidato());
        }
    }
    $this->setTemplate('formCandidato');
  }
  
  /**
  * Actualizar una Candidato Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaCandidato(sfWebRequest $request)
  {
    $this->forward404Unless($candidato = Doctrine_Core::getTable('candidato')->find(array($request->getParameter('id_candidato'))), sprintf('Object candidato does not exist (%s).', $request->getParameter('id_candidato')));
    $this->form = new candidatoForm($candidato);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Candidatos'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($candidato = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Candidato "'.$candidato->getNombre().'" Actualizado';
        }
        else
            $msg = 'Problemas actualizando datos de "'.$this->form->getObject()->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Candidato "'.$candidato->getNombre().'" Eliminada';
        $candidato->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formCandidato');
  }
  
  /**
  * Crear una nueva Jurado
  *
  * @param sfRequest $request A request object
  */
  public function executeNuevaJurado(sfWebRequest $request)
  {
    $this->form = new juradoForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Jurados'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        if($jurado = $usr->procesarFormulario($this->form, $request)){
            $usr->setFlash('msg1', 'Jurado '.$jurado->getNombre().' Agregado');
            $this->redirect('@actualizaJurado?nombre='.$jurado->getNombre().'&id_jurado='.$jurado->getIdJurado());
        }
    }
    $this->setTemplate('formJurado');
  }
  
  /**
  * Actualizar una Jurado Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualizaJurado(sfWebRequest $request)
  {
    $this->forward404Unless($jurado = Doctrine_Core::getTable('jurado')->find(array($request->getParameter('id_jurado'))), sprintf('Object jurado does not exist (%s).', $request->getParameter('id_jurado')));
    $this->form = new juradoForm($jurado);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Actualizando Jurados'));
    if($request->isMethod(sfRequest::PUT) && $request->hasParameter($this->form->getName())){
        $msg;
        if($jurado = $usr->procesarFormulario($this->form, $request)){
            $msg = 'Jurado "'.$jurado->getNombre().'" Actualizado';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$jurado->getNombre().'"';
        $usr->setFlash('msg', $msg);
    }elseif($request->hasParameter('borrar') && $request->getParameter('borrar') == true){
        $request->checkCSRFProtection();
        $msg = 'Jurado "'.$jurado->getNombre().'" Eliminada';
        $jurado->delete();
        $usr->setFlash('msg1', $msg);
        $this->redirect('@homepage');
    }
    $this->setTemplate('formJurado');
  }
  public function executeVerMesas(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Mesas de Votaciones';
      $this->encabezados = MesaTable::getInstance()->getColumnNames();
      $this->obj = 'Mesa';
      $this->datos = MesaTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeVerEstudiantes(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Estudiantes de Votaciones';
      $this->encabezados = EstudianteTable::getInstance()->getColumnNames();
      $this->obj = 'Estudiante';
      $this->datos = EstudianteTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeVerVotantes(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Votantes de Votaciones';
      $this->encabezados = VotanteTable::getInstance()->getColumnNames();
      $this->obj = 'Votante';
      $this->datos = VotanteTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeVerCandidatos(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Candidatos de Votaciones';
      $this->encabezados = CandidatoTable::getInstance()->getColumnNames();
      $this->obj = 'Candidato';
      $this->datos = CandidatoTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeVerJurados(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Jurados de Votaciones';
      $this->encabezados = JuradoTable::getInstance()->getColumnNames();
      $this->obj = 'Jurado';
      $this->datos = JuradoTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeVerGrados(sfWebRequest $request){
      $usr = $this->getUser();
      $this->titulo = 'Listado de Grados';
      $this->encabezados = GradoTable::getInstance()->getColumnNames();
      $this->obj = 'Grado';
      $this->datos = GradoTable::getInstance()->findAll();
      $usr->setFlash('msg', $usr->getFlash('msg1', $this->titulo));
      $this->setTemplate('list');
  }
  public function executeCargaDatos(sfWebRequest $request){
      $usr = $this->getUser();
      $form = new cargaDatosForm();
      $msg = 'Cargar Datos de un archivo.';
      $tipo = $request->getParameter('tipo', 'txt');
      $tipo = $tipo== 'csv'?'txt': $tipo;
      if($request->hasParameter($form->getName())){
          $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
          if($form->isValid()){
              $file = $form->getValue('archivo');
              $extension = $file->getExtension($file->getOriginalExtension());
              if($extension == '.'.$tipo){
                while($leer = $this->leerArchivo($file,sfConfig::get('sf_upload_dir').'/'.'/GobiernoEscolar-'.$usr->getAttribute('abreviaturaEntidadEducativa').'-'.date('Y-m-d').'.csv', 350));
                if(!$leer){
                    unlink(sfConfig::get('sf_upload_dir').'/'.'/GobiernoEscolar-'.$usr->getAttribute('abreviaturaEntidadEducativa').'-'.date('Y-m-d').'.csv');
                }
                $msg = 'Datos cargados con éxito.';
              }else{
                  $msg = 'Archivo no válido;'.$extension.'; no es de tipo '.$tipo;
              }
          }
          else{
            $msg = 'Formulario no válido.';
          }
      }
      $this->form = $form;
      $this->tipo = $tipo;
      $usr->setFlash('msg', $usr->getFlash('msg1',$msg));
  }
  
  private function leerArchivo($file, $dir, $limit = 0){
    if(!file_exists($dir)){
        $file->save($dir);
    }
    $fp = fopen($dir,"r");
    $datos = array();
    $j = 1;
    $limite = false;
    while (($fila = fgetcsv($fp, 8000, ";")) !== FALSE){
        $dato = array();
        if($limit > 0 && $j >= $limit){
            $datos[] = $fila;
            $limite = true;
        }else{
            foreach($fila as $i => $celda){
                if (isset($dato[$this->getCelda($i)])) {
                        $dato[$this->getCelda($i)] .= trim(' ' . $celda, " \t\n\r\0\x0B");
                    } else {
                        $dato[$this->getCelda($i)] = trim($celda, " \t\n\r\0\x0B");
                    }
                }
            if(is_numeric($dato['id_persona'])){
                $this->saveFilaArchivo ($dato);
            }
        }
        $j++;
    }
    fclose($fp);
    if($limite){
        $fp = fopen($dir,"w");
        foreach ($datos as $dato)
            fputcsv($fp, $dato,';');
        fclose($fp);
        return TRUE;
    }
    return FALSE;
  }
  
  private function saveFilaArchivo($dato){
      $usr = $this->getUser();
      $entidadEducativa = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $usr->getAttribute('abreviaturaEntidadEducativa'));
      $id_entidad = $entidadEducativa->getIdEntidadEducativa();
      unset($entidadEducativa);
        $tipoPersona = 'Docente';
        /*Persona*/
        $persona = PersonaTable::getInstance()->find($dato['id_persona']);
        if($persona){

        }else{
            $tipo = TipoTable::getInstance()->findOneBy('nombre', $dato['tipo_id']);
            $id_tipo = $tipo->getIdTipo();
            unset($tipo);
            $persona = new Persona();
            $persona->setNombre($dato['apellido'].'-'.$dato['nombre'])
                    ->setIdPersona($dato['id_persona'])
                    ->setTipoDocId($id_tipo)
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->setClave(sha1($dato['id_persona']))
                    ->save();
        }
        unset($persona);
        /*Grado*/
        $grado = GradoTable::getGrado(array('abreviatura' => $dato['no_grado']));
        if($grado){

        }else{
            $grado = new Grado();
            $grado->setAbreviatura($dato['no_grado'])
                ->setNombre('Grado '.$this->getNombreGrado($dato['no_grado']))
                ->setFechaCreado(date('Y-m-d H:i:s'))
                ->save();
            
        }
        $id_grado = $grado->getIdGrado();
        unset($grado);
        /*GradoEntidadEducativa*/
        $gradoEntidad = GradoEntidadEducativaTable::getGradoEntidad(array('id_grado' => $id_grado, 'id_entidad_educativa' => $id_entidad));
        if($gradoEntidad){

        }else{
            $gradoEntidad = new GradoEntidadEducativa();
            $gradoEntidad->setIdGrado($id_grado)
                ->setIdEntidadEducativa($id_entidad)
                ->setFechaCreado(date('Y-m-d H:i:s'))
                ->save();
            
        }
        unset($gradoEntidad);
        /*Mesa*/
        /*Mesa*/
        $mesa = MesaTable::getInstance()->find($dato['id_mesa']);
        if($mesa){

        }else{
            $mesa = new Mesa();
            $mesa->setIdMesa($dato['id_mesa'])
                    ->setNombre('Mesa No. '.$dato['id_mesa'])
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->save();
        }
        $id_mesa = $mesa->getIdMesa();
        unset($mesa);
        /*MesaEntidadEducativa*/
        $mesaEntidad = MesaEntidadEducativaTable::getMesaEntidad(array('id_mesa' => $dato['id_mesa'], 'abreviatura_entidad_educativa' => $usr->getAttribute('abreviaturaEntidadEducativa')));
        if($mesaEntidad){

        }else{
//            sfContext::getInstance()->getLogger()->alert('jornada => '.$dato['jornada']);
            $jornada = TipoTable::getInstance()->createQuery()
                    ->andWhere('nombre LIKE ?', '%'.$dato['jornada'].'%')
                    ->fetchOne();
            $mesaEntidad = new MesaEntidadEducativa();
            $mesaEntidad->setIdMesa($id_mesa)
                    ->setIdEntidadEducativa($id_entidad)
                    ->setTipo($jornada)
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->save();
        }
        unset($mesaEntidad);
        /*Jurado*/
        if($dato['jurado'] != ''){
            $jurado = JuradoTable::getInstance()->find($dato['id_persona']);
            if($jurado){

            }else{
                $tipoJurado = TipoTable::getInstance()->createQuery()
                        ->andWhere('nombre LIKE ?', '%'.$dato['jurado'].'%')
                        ->fetchOne();
                $id_tipoJurado = $tipoJurado->getIdTipo();
                unset($tipoJurado);
                $jurado = new Jurado();
                $jurado->setIdJurado($dato['id_persona'])
                    ->setIdEntidadEducativa($id_entidad)
                    ->setIdMesa($id_mesa)
                    ->setIdTipoJurado($id_tipoJurado)
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->save();
            }
            unset($jurado);
        }
        if($dato['cod_curso'] != ''){
            /*Curso*/
            $curso = CursoTable::getInstance()->findOneBy('abreviatura',$dato['id_curso']);
            if($curso){

            }else{
                $curso = new Curso();
                $curso->setAbreviatura($dato['id_curso'])
                    ->setNombre('Curso '.$dato['id_curso'])
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->save();
            }
            /*CursosGrado*/
            $cursosGrado = CursosGradoTable::getCursoGrado(array(
                'id_curso' => $curso->getIdCurso(),
                'id_grado' => $id_grado,
                'id_entidad_educativa' => $id_entidad,
                ));
            if($cursosGrado){

            }else{
                $cursosGrado = new CursosGrado();
                $cursosGrado->setIdCurso($curso->getIdCurso())
                    ->setIdGrado($id_grado)
                    ->setIdEntidadEducativa($id_entidad)
                    ->setFechaCreado(date('Y-m-d H:i:s'))
                    ->save();
            }
            $id_cursosGrado = $cursosGrado->getIdCursoGrado();
            unset($cursosGrado);
            unset($curso);
            $tipoPersona = 'Estudiante';
            /*Estudiante*/
            $estudiante = EstudianteTable::getInstance()->findOneBy('id_estudiante',$dato['id_persona']);
            if($estudiante){

            }else{
                $estudiante = new estudiante();
                $estudiante->setIdCurso($id_cursosGrado)
                        ->setIdEstudiante($dato['id_persona'])
                        ->setCodCurso($dato['cod_curso'])
                        ->setFechaCreado(date('Y-m-d H:i:s'))
                        ->save();
            }
            unset($estudiante);
            /*Votante*/
            $tipoEleccion = TipoTable::getInstance()->createQuery()
                        ->andWhere('nombre LIKE ?', '%'.$dato['elección'].'%')
                        ->fetchOne();
            $id_tipoEleccion = $tipoEleccion->getIdTipo();
            unset($tipoEleccion);
            $votante = VotanteTable::getInstance()->find($dato['id_persona']);
            if($votante){

            }else{
                $votante = new Votante();
                $votante->setIdVotante($dato['id_persona'])
                        ->setIdMesa($id_mesa)
                        ->setIdEntidadEducativa($id_entidad)
                        ->setIdTipoEleccion($id_tipoEleccion)
                        ->save();
            }
            unset($votante);
            /*Candidato*/
            if($dato['candidato'] != ''){
//                sfContext::getInstance()->getLogger()->alert('id_persona => '.$dato['id_persona']);
                $candidato = CandidatoTable::getInstance()->find($dato['id_persona']);
                if($candidato){

                }
                else{
                    $candidato = new Candidato();
                    $candidato->setNo($dato['candidato'])
                            ->setIdTipoEleccion($id_tipoEleccion)
                            ->setIdCandidato($dato['id_persona'])
                            ->setFechaCreado(date('Y-m-d H:i:s'));
                    if($dato['representante'] != ''){
                        $candidato->setIdCandidatoRepresenta($dato['representante']);
                    }
                    $candidato->save();
                }
            }
            unset($candidato);
        }
        /*Tipo Persona*/
        $t = TipoTable::getInstance()->findOneBy('nombre', $tipoPersona);
        $id_tipo = $t->getIdTipo();
        unset($t);
        $tp = PerfilesPersonaTable::getInstance()->find(array('id_persona' => $dato['id_persona'], 'id_tipo' => $id_tipo));
        if($tp){

        }else{
            $tp = new PerfilesPersona();
            $tp->setIdPersona($dato['id_persona'])
            ->setIdTipoPerfil($id_tipo)
            ->setIdEntidadEducativa($usr->getAttribute('idEntidadEducativa'))
            ->setFechaCreado(date('Y-m-d H:i:s'));
            $tp->save();
        }
        unset($tp);
  }
    
  public function getCelda($i){
      $id = '';
      switch ($i) {
          case 0:
          case "Documento de Identidad":
              $id = 'id_persona';
              break;
          case 1:
          case "Tipo de Documento de Identidad":
              $id = 'tipo_id';
              break;
          case 2:
          case "Apellidos":
              $id = 'apellido';
              break;
          case 3:
          case "Nombres":
              $id = 'nombre';
              break;
          case 4:
          case "Grado":
              $id = 'no_grado';
              break;
          case 5:
          case "Curso":
              $id = 'id_curso';
              break;
          case 6:
          case "Código":
              $id = 'cod_curso';
              break;
          case 7:
          case "Jornada":
              $id = 'jornada';
              break;
          case 8:
          case "Mesa":
              $id = 'id_mesa';
              break;
          case 9:
          case "Jurado":
              $id = 'jurado';
              break;
          case 10:
          case "Candidato":
              $id = 'candidato';
              break;
          case 11:
          case "Representa a":
              $id = 'representante';
              break;
          case 12:
          case "Elección":
              $id = 'elección';
              break;
          default:
              break;
      }
      return $id;
  }

    public function getNombreGrado($no_grado) {
        $nombre = '';
        switch ($no_grado){
            case 1:
                $nombre = 'Primero';
                break;
            case 2:
                $nombre = 'Segundo';
                break;
            case 3:
                $nombre = 'Tercero';
                break;
            case 4:
                $nombre = 'Cuarto';
                break;
            case 5:
                $nombre = 'Quinto';
                break;
            case 6:
                $nombre = 'Sexto';
                break;
            case 7:
                $nombre = 'Séptimo';
                break;
            case 8:
                $nombre = 'Octavo';
                break;
            case 9:
                $nombre = 'Noveno';
                break;
            case 10:
                $nombre = 'Décimo';
                break;
            case 11:
                $nombre = 'Once';
                break;
            case 'JAR':
                $nombre = 'Jardín';
                break;
            case 'TRA':
                $nombre = 'Transición';
                break;
        }
        return $nombre;
    }
}
