<?php

namespace Pay\PaymentBundle\Controller\Payment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pay\PaymentBundle\Entity\Payment\Payment;
use Pay\PaymentBundle\Form\Payment\PaymentType;

/**
 * Payment\Payment controller.
 *
 * @Route("/payment")
 */
class PaymentController extends Controller
{
    /**
     * Lists all Payment\Payment entities.
     *
     * @Route("/", name="payment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PayPaymentBundle:Payment\Payment')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Payment\Payment entity.
     *
     * @Route("/", name="payment_create")
     * @Method("POST")
     * @Template("PayPaymentBundle:Payment\Payment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Payment();
        $form = $this->createForm(new PaymentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('payment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Payment\Payment entity.
     *
     * @Route("/new", name="payment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Payment();
        $form   = $this->createForm(new PaymentType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Payment\Payment entity.
     *
     * @Route("/{id}", name="payment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Payment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Payment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Payment\Payment entity.
     *
     * @Route("/{id}/edit", name="payment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Payment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Payment entity.');
        }

        $editForm = $this->createForm(new PaymentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Payment\Payment entity.
     *
     * @Route("/{id}", name="payment_update")
     * @Method("PUT")
     * @Template("PayPaymentBundle:Payment\Payment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Payment\Payment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payment\Payment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PaymentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('payment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Payment\Payment entity.
     *
     * @Route("/{id}", name="payment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPaymentBundle:Payment\Payment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Payment\Payment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('payment'));
    }

    /**
     * Creates a form to delete a Payment\Payment entity by id.
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
