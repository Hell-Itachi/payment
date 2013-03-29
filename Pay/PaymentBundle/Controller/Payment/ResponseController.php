<?php

namespace Pay\PaymentBundle\Controller\Payment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pay\PaymentBundle\Entity\Payment\Response;
use Pay\PaymentBundle\Form\Payment\ResponseType;

/**
 * Payment\Response controller.
 *
 * @Route("/response")
 */
class ResponseController extends Controller
{
    /**
     * Lists all Payment\Response entities.
     *
     * @Route("/", name="response")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PayPaymentBundle:Payment\Response')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Payment\Response entity.
     *
     * @Route("/", name="response_create")
     * @Method("POST")
     * @Template("PayPaymentBundle:Payment\Response:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Response();
        $form = $this->createForm(new ResponseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('payment_response_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Payment\Response entity.
     *
     * @Route("/new", name="response_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Response();
        $form   = $this->createForm(new ResponseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Payment\Response entity.
     *
     * @Route("/{id}", name="response_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Response entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Payment\Response entity.
     *
     * @Route("/{id}/edit", name="response_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Response entity.');
        }

        $editForm = $this->createForm(new ResponseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Payment\Response entity.
     *
     * @Route("/{id}", name="response_update")
     * @Method("PUT")
     * @Template("PayPaymentBundle:Payment\Response:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Response entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ResponseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('payment_response_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Payment\Response entity.
     *
     * @Route("/{id}", name="response_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPaymentBundle:Payment\Response')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Payment\Response entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('payment_response'));
    }

    /**
     * Creates a form to delete a Payment\Response entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
