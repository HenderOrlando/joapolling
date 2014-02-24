<?php

/**
 * jurados actions.
 *
 * @package    sf_sandbox
 * @subpackage jurados
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class juradosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->jurados = Doctrine_Core::getTable('jurado')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new juradoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new juradoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($jurado = Doctrine_Core::getTable('jurado')->find(array($request->getParameter('id_jurado'))), sprintf('Object jurado does not exist (%s).', $request->getParameter('id_jurado')));
    $this->form = new juradoForm($jurado);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($jurado = Doctrine_Core::getTable('jurado')->find(array($request->getParameter('id_jurado'))), sprintf('Object jurado does not exist (%s).', $request->getParameter('id_jurado')));
    $this->form = new juradoForm($jurado);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($jurado = Doctrine_Core::getTable('jurado')->find(array($request->getParameter('id_jurado'))), sprintf('Object jurado does not exist (%s).', $request->getParameter('id_jurado')));
    $jurado->delete();

    $this->redirect('jurados/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $jurado = $form->save();

      $this->redirect('jurados/edit?id_jurado='.$jurado->getIdJurado());
    }
  }
}
