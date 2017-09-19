<?php
/**
 * Created by PhpStorm.
 * User: sherbieny
 * Date: 9/18/17
 * Time: 7:42 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Item;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestController extends FOSRestController
{
    /**
     * @Rest\Get("/items")
     */
    public function indexAction(){
        $items = $this->getDoctrine()
            ->getRepository('AppBundle:Item')
            ->findAll();


        dump($items);

        return new JsonResponse($items);
    }

    /**
     * @param $id
     * @Rest\Get("/item/{id}")
     * @return Item|object|JsonResponse
     */
    public function getByIDAction($id){
        $item = $this->getDoctrine()->getRepository('AppBundle:Item')
            ->find($id);
        if(empty($item)){
            return new JsonResponse('Item not found',
                Response::HTTP_NOT_FOUND);
        }else{
            return new JsonResponse(['item' => $item]);
        }
    }

    /**
     * @param Request $request
     * @Rest\Post("/item/new/")
     * @return JsonResponse
     */
    public function newAction(Request $request){
        $item = new Item();
        $data = $request->getContent();

        if (!empty($data)){
            $params = json_decode($data, true);


            $item->setItemDetail1($params[0]['value']);
            $item->setItemDetail2($params[1]['value']);
            $item->setItemDetail3($params[2]['value']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return new JsonResponse('Item added',
                Response::HTTP_OK);

        }else{
            return new JsonResponse('Item fields Cannot be empty',
                Response::HTTP_NO_CONTENT);

        }



    }

    /**
     * @param $id
     * @param Request $request
     * @Rest\Put("/item/{id}")
     * @return JsonResponse
     */
    public function updateAction($id, Request $request){
        $itemDetail1 = $request->get('itemDetail1');
        $itemDetail2 = $request->get('itemDetail2');
        $itemDetail3 = $request->get('itemDetail3');
        $em = $this->getDoctrine()->getManager();

        $item = $this->getDoctrine()->getRepository('AppBundle:Item')
            ->find($id);
        if(empty($item)){
            return new JsonResponse('No Item found',
                Response::HTTP_NOT_FOUND);
        }
        else{
            $item->setItemDetail1($itemDetail1);
            $item->setItemDetail2($itemDetail2);
            $item->setItemDetail3($itemDetail3);

            return new JsonResponse(['item' => $item],
                Response::HTTP_OK);
        }
    }

    /**
     * @param $id
     * @Rest\Delete("/item/{id}")
     * @return JsonResponse
     */
    public function deleteAction($id){
        $data = new Item();
        $em = $this->getDoctrine()->getManager();
        $item = $this->getDoctrine()->getRepository('AppBundle:Item')
            ->find($id);
        if(empty($item)){
            return new JsonResponse('Item not found',
                Response::HTTP_NOT_FOUND);
        }else{
            $em->remove($item);
            $em->flush();
            return new JsonResponse('Item Deleted',
                Response::HTTP_OK);
        }
    }
}