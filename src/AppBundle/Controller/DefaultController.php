<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Form\ItemFormType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Template(":default:index.html.twig")
 */
class DefaultController extends FOSRestController
{
    /**
     * @Route("/", name="homepage")
     * @Rest\Get("/items")
     * @return Response
     */
    public function indexAction()
    {
        $items = $this->getDoctrine()
            ->getRepository('AppBundle:Item')
            ->findAll();

        return $this->render('default/index.html.twig', [
            'items' => $items
        ]);
    }

    /**
     * @Rest\Get("/item/{id}")
     * @return Item
     */
    public function getByIdAction($id){
        $item = $this->getDoctrine()
            ->getRepository('AppBundle:Item')
            ->find($id);

        return $item;
    }

    /**
     * @param Request $request
     * @Route("/new", name="new_item")
     * @Rest\Post("/item/new")
     * @return JsonResponse|Response
     */
    public function newAction(Request $request){
        $itemForm = $this->createForm(ItemFormType::class);
        $itemForm->handleRequest($request);

        if($request->isMethod('POST')){
            if($itemForm->isSubmitted() && $itemForm->isValid()){
                $item = $itemForm->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();

                $response['success'] = true;
                return new JsonResponse( $response );

            }else{
                $response['success'] = false;
                $response['cause'] = 'whatever';
                return new JsonResponse( $response );
            }
        }


        return $this->render('default/index.html.twig',[
            'itemForm' => $itemForm->createView()
        ]);
    }

//    /**
//     * @param Request $request
//     * @param Item $item
//     * @Rest\Post("/item/{id}/edit")
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function editAction(Request $request, Item $item){
//        $itemForm = $this->createForm(ItemFormType::class, $item);
//        $itemForm->handleRequest($request);
//
//        if($itemForm->isSubmitted() && $itemForm->isValid()){
//            $item = $itemForm->getData();
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($item);
//            $em->flush();
//        }
//        return $this->render(':default:_form.html.twig',[
//            'itemForm' => $itemForm->createView()
//        ]);
//    }

    /**
     * @param $id
     * @Rest\Delete("/item/{id}")
     */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Item')
            ->find($id);

        $em->remove($item);
        $em->flush();

        exit;
    }


}
