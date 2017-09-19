<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Form\ItemFormType;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\ExceptionHandler;
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
     * @Route("/", name="home")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

//    /**
//     * @Rest\Get("/item/{id}")
//     * @return Item
//     */
//    public function getByIdAction($id){
//        $item = $this->getDoctrine()
//            ->getRepository('AppBundle:Item')
//            ->find($id);
//
//        return $item;
//    }
//
//    /**
//     * @Route("/new", name="new_item", options={"expose" = true})
//     * @Method({"POST"})
//     */
//    public function newAction(Request $request){
//
//        $item = new Item();
//        $itemForm = $this->createForm(ItemFormType::class, $item);
//
//        $itemForm->handleRequest($request);
//        $status = "";
//
//
//            $item = $itemForm->getData();
//
//            $em = $this->getDoctrine()->getManager();
//
//            try {
//                $em->persist($item);
//                $em->flush();
//                $status = "saved";
//            } catch (NotNullConstraintViolationException $e) {
//                $status = new JsonResponse();
//            } catch (UniqueConstraintViolationException $e) {
//                $status = new JsonResponse();
//            } catch (\Exception $e) {
//                $handler = new ExceptionHandler();
//                $handler->handle($e);
//                $status = new JsonResponse([
//                    'status' => 'errorException',
//                    'message' => $e->getMessage()
//                ]);
//            }
//
//
//        return new JsonResponse(array('status' => $status));
//    }
//
////    /**
////     * @param Request $request
////     * @param Item $item
////     * @Rest\Post("/item/{id}/edit")
////     * @return \Symfony\Component\HttpFoundation\Response
////     */
////    public function editAction(Request $request, Item $item){
////        $itemForm = $this->createForm(ItemFormType::class, $item);
////        $itemForm->handleRequest($request);
////
////        if($itemForm->isSubmitted() && $itemForm->isValid()){
////            $item = $itemForm->getData();
////
////            $em = $this->getDoctrine()->getManager();
////            $em->persist($item);
////            $em->flush();
////        }
////        return $this->render(':default:_form.html.twig',[
////            'itemForm' => $itemForm->createView()
////        ]);
////    }
//
//    /**
//     * @param $id
//     * @Rest\Delete("/item/{id}")
//     */
//    public function deleteAction($id){
//        $em = $this->getDoctrine()->getManager();
//        $item = $em->getRepository('AppBundle:Item')
//            ->find($id);
//
//        $em->remove($item);
//        $em->flush();
//
//        exit;
//    }


}
