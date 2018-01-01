<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Contract;
use FreelancingWebsiteBundle\Entity\Feedback;
use FreelancingWebsiteBundle\Form\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/contract/{id}/give_feedback", name="give_feedback")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function giveFeedbackAction($id, Request $request)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);

        if ($contract->getFreelancer() == $this->getUser()) {
            $feedback = $contract->getFreelancerFeedback();
        }
        else if ($contract->getClient() == $this->getUser()) {
            $feedback = $contract->getClientFeedback();
        }

        $form = $this->createForm(FeedbackType::class, $feedback);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('single_contract_view', ['id' => $id]);
        }

        return $this->render('contract/give_feedback.html.twig', ['form' => $form->createView(), 'contract' => $contract]);
    }
}
