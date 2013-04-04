<?php

namespace Pay\PaymentBundle\Controller\Currency;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pay\PaymentBundle\Entity\Currency\Currency;
use Pay\PaymentBundle\Form\Currency\CurrencyType;

/**
 * Currency\Currency controller.
 *
 * @Route("/currency_currency")
 */
class CurrencyController extends Controller
{
    /**
     * Lists all Currency\Currency entities.
     *
     * @Route("/", name="currency_currency")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PayPaymentBundle:Currency\Currency')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Currency\Currency entity.
     *
     * @Route("/", name="currency_currency_create")
     * @Method("POST")
     * @Template("PayPaymentBundle:Currency\Currency:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Currency();
        $form = $this->createForm(new CurrencyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_currency_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Currency\Currency entity.
     *
     * @Route("/new", name="currency_currency_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Currency();
        $form   = $this->createForm(new CurrencyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Currency\Currency entity.
     *
     * @Route("/{id}", name="currency_currency_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Currency\Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency\Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Currency\Currency entity.
     *
     * @Route("/{id}/edit", name="currency_currency_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Currency\Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency\Currency entity.');
        }

        $editForm = $this->createForm(new CurrencyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Currency\Currency entity.
     *
     * @Route("/{id}", name="currency_currency_update")
     * @Method("PUT")
     * @Template("PayPaymentBundle:Currency\Currency:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPaymentBundle:Currency\Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency\Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CurrencyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_currency_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Currency\Currency entity.
     *
     * @Route("/{id}", name="currency_currency_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPaymentBundle:Currency\Currency')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Currency\Currency entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('currency_currency'));
    }

    /**
     * Creates a form to delete a Currency\Currency entity by id.
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
