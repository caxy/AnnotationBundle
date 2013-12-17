<?php

namespace Caxy\AnnotationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

use Caxy\AnnotationBundle\Entity\Annotation;

/**
 * Annotation controller.
 *
 * @Route("/annotations")
 *
 */
class AnnotationController extends Controller
{
    /**
    * saveAction
    * @Route("/save", name="annotation_save")
    * @Method({"POST", "PUT"})
    * 
    * @return JsonResponse
    */
    public function saveAction(Request $request)
    {      
      $entity_manager = $this->getDoctrine()->getManager();                              

      $json = $request->getContent();

      if(!$json){
        return new JsonResponse(array('success' => false));
      }

      $json = json_decode($json, true);
      $range = $json['ranges'][0];

      $search_array = array(
                              'url' => $json['uri'],
                              'start' => $range['start'],
                              'start_offset' => $range['startOffset'],
                              'end' => $range['end'],
                              'end_offset' => $range['endOffset']
                            );

      $annotation = $entity_manager->getRepository('CaxyAnnotationBundle:Annotation')->findOneBy($search_array);

      if(!$annotation){
        $annotation = new Annotation();
      }

      $annotation->setStart($range['start']);
      $annotation->setStartOffset($range['startOffset']);
      $annotation->setEnd($range['end']);
      $annotation->setEndOffset($range['endOffset']);
      $annotation->setUrl($json['uri']);
      $annotation->setQuote($json['quote']);
      $annotation->setText($json['text']);
      $entity_manager->persist($annotation);
      $entity_manager->flush();

      return new JsonResponse(array('id' => $annotation->getId()));
    }

    /**
    * createAction
    * @Route("/delete", name="annotation_delete")
    * @Method({"DELETE"})
    * 
    * @return JsonResponse
    */
    public function deleteAction(Request $request)
    {      
      $entity_manager = $this->getDoctrine()->getManager();                              

      $json = $request->getContent();

      if(!$json){
        return new JsonResponse(array('success' => false));
      }

      $json = json_decode($json, true);

      $range = $json['ranges'][0];

      $search_array = array(
                              'url' => $json['uri'],
                              'start' => $range['start'],
                              'start_offset' => $range['startOffset'],
                              'end' => $range['end'],
                              'end_offset' => $range['endOffset']
                            );

      $annotation = $entity_manager->getRepository('CaxyAnnotationBundle:Annotation')->findOneBy($search_array);

      if(!$annotation){
        return new JsonResponse(array('success' => false));
      }

      $entity_manager->remove($annotation);
      $entity_manager->flush();

      return new JsonResponse(array('success' => true));
    }

    /**
    * searchAction
    * @Route("/search", name="annotation_search")
    * @Method({"GET"})
    *
    * @return JsonResponse
    */
    public function searchAction(Request $request)
    {      
      $uri = $request->get('uri');

      if(!$uri){
        return new JsonResponse(array('success' => false));
      }

      $entity_manager = $this->getDoctrine()->getManager();                              
      $annotations = $entity_manager->getRepository('CaxyAnnotationBundle:Annotation')
                                    ->findBy(array('url' => $uri));
      
      $annotation_array = array('response' => 'No results found.');

      if($annotations){
        $annotation_data = array();

        foreach($annotations as $annotation){
          $range = array(
                          'start' => $annotation->getStart(),
                          'end' => $annotation->getEnd(),
                          'startOffset' => $annotation->getStartOffset(),
                          'endOffset' => $annotation->getEndOffset(),
                        );

          $annotation_info = array(
                                    'quote' => $annotation->getQuote(),
                                    'text' => $annotation->getText(),
                                    'ranges' => array($range)
                                  );

          $annotation_data[] = $annotation_info;
        }

        $annotation_array = array('total' => count($annotation_data), 'rows' => $annotation_data);
      }

      return new Response(stripslashes(json_encode($annotation_array)));
    }
}