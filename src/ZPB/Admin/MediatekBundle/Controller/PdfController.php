<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/08/14
 * Time: 10:48
 */
  /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Admin\MediatekBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZPB\Admin\CommonBundle\Controller\BaseController;
use ZPB\Admin\MediatekBundle\Entity\Pdf;

class PdfController extends BaseController
{
    public function indexAction($page=1)
    {
        $pdfs = $this->getRepo('ZPBAdminMediatekBundle:Pdf')->getAllPdfAlphaOrdered($page, 10);
        $maxPage = $this->getRepo('ZPBAdminMediatekBundle:Pdf')->getNumPage(10);
        return $this->render('ZPBAdminMediatekBundle:Pdf:index.html.twig', ['currentPage'=>$page, 'pdfs'=>$pdfs, 'maxPage'=>$maxPage]);
    }

    public function newAction(Request $request)
    {
        $pdf = new Pdf($this->container->getParameter('mediatek_uploads_pdf_dir'), $this->container->getParameter('mediatek_root_dir'));

        $form = $this->createFormBuilder($pdf)
            ->add('name')
            ->add('file')
            ->add('save', 'submit')
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isValid()){
            if($pdf->upload()){
                $em = $this->getEm();
                $em->persist($pdf);
                $em->flush();
                $this->successMessage('Votre pdf a bien été uploadé.');
                return $this->redirect($this->generateUrl('zpb_admin_mediatek_pdf_homepage'));
            }
            $this->errorMessage('Une erreur s\'est produite, votre pdf n\'a pas été traité.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_pdf_homepage'));
        }

        return $this->render('ZPBAdminMediatekBundle:Pdf:new.html.twig', ['form'=>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('pdf_edit',$token)){
            throw new AccessDeniedException();
        }
        $pdf = $this->getRepo('ZPBAdminMediatekBundle:Pdf')->find($id);
        if(!$pdf){
            throw $this->createNotFoundException();
        }
        $form = $this->createFormBuilder($pdf)
            ->add('name')
            ->add('save', 'submit')
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($pdf);
            $em->flush();
            $this->successMessage('Votre pdf a bien été mis à jour.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_pdf_homepage'));
        }
        return $this->render('ZPBAdminMediatekBundle:Pdf:edit.html.twig', ['form'=>$form->createView(), 'image'=>$pdf]);
    }

    public function deleteAction($id, Request $request)
    {

    }
} 
