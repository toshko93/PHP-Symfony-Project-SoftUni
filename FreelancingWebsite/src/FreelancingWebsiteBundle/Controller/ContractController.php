<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Contract;
use FreelancingWebsiteBundle\Entity\Feedback;
use FreelancingWebsiteBundle\Entity\JobPost;
use FreelancingWebsiteBundle\Entity\Notification;
use FreelancingWebsiteBundle\Entity\Proposal;
use FreelancingWebsiteBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/contract/create", name="contract_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $jobPostId = $_GET['job_post_id'];
        $proposalId = $_GET['proposal_id'];

        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($jobPostId);
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find($proposalId);
        $priceAgreed = $proposal->getProposedPrice();

        $clientId = $jobPost->getClientId();
        $freelancerId = $proposal->getFreelancerId();

        $client = $this->getDoctrine()->getRepository(User::class)->find($clientId);
        $freelancer = $this->getDoctrine()->getRepository(User::class)->find($freelancerId);

        $con = $this->getDoctrine()->getRepository(Contract::class)->findBy(['jobPostId' => $jobPostId]);

        if (!$con) {
            // Create the contract
            $contract = new Contract();
            $contract->setSumAgreed($priceAgreed);
            $contract->setJobPost($jobPost);
            $contract->setProposal($proposal);
            $contract->setClient($client);
            $contract->setFreelancer($freelancer);

            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();

            $client->setMoneyBalance($client->getMoneyBalance() - $contract->getSumAgreed());

//            $contractFeedback = new Feedback($freelancer, $client, $contract->getId());
//            $contract->setFeedback($contractFeedback);
//
//            $em->persist($contractFeedback);
//            $em->flush();

            // Notification create
            $notification = new Notification();
            $notification->setMessage("A contract has started on the job with id " . $jobPost->getId());
            $notification->setUser($contract->getFreelancer());

            $jobPost->setIsActive(false);

            $notification->setTargetLink("http://localhost:8000/contract/" . $contract->getId());
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('single_contract_view', ['id' => $contract->getId(), 'jobPost' => $jobPost, 'contract' => $contract]);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param $id
     *
     * @Route("/contract/{id}", name="single_contract_view")
     *
     * @return Response
     */
    public function viewSingleAction($id)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($contract->getJobPostId());

        return $this->render('contract/single.html.twig', ['jobPost' => $jobPost, 'contract' => $contract]);
    }

    /**
     * @Route("/my_contracts", name="my_contracts")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return Response
     */
    public function viewMyContractsAction(Request $request)
    {
        $myId = $this->getUser()->getId();

        if ($this->getUser()->hasRole('ROLE_CLIENT')) {
            $myContracts = $this->getDoctrine()->getRepository(Contract::class)->findBy(['clientId' => $myId]);
            return $this->render('contract/my_contracts.html.twig', ['myContracts' => $myContracts]);
        } else if ($this->getUser()->hasRole('ROLE_FREELANCER')) {
            $myContracts = $this->getDoctrine()->getRepository(Contract::class)->findBy(['freelancerId' => $myId]);
            return $this->render('contract/my_contracts.html.twig', ['myContracts' => $myContracts]);
        }

        return $this->render('contract/my_contracts.html.twig');
    }

    /**
     * End Contract by paying the client
     *
     * @Route("/contract/{id}/end", name="end_contract")
     */
    public function endContractAction($id, Request $request)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);

        $freelancer = $this->getDoctrine()->getRepository(User::class)->find($contract->getFreelancerId());
        $freelancer->setMoneyBalance($freelancer->getMoneyBalance() + $contract->getSumAgreed());
        $freelancer->setMoneyEarned($freelancer->getMoneyEarned() + $contract->getSumAgreed());

        $client = $this->getDoctrine()->getRepository(User::class)->find($contract->getClientId());
        $client->setMoneySpent($client->getMoneySpent() + $contract->getSumAgreed());

        $contract->setEndDate(new \DateTime('now'));
        $contract->setSumPaid($contract->getSumAgreed());

        $em = $this->getDoctrine()->getManager();
        $em->persist($freelancer);
        $em->flush();
        $em->persist($client);
        $em->flush();

        $em->persist($contract);
        $em->flush();

//        $contractFeedback = new Feedback($freelancer, $client, $contract);
//        $contract->setFeedback($contractFeedback);
//
//        $em->persist($contractFeedback);
//        $em->flush();

        // redirect to give feedback if client
//        if ($this->getUser() == $contract->getClient()) {
//            return $this->redirectToRoute('give_feedback', ['id' => $contract->getId()]);
//        }

        // sent notification to freelancer for feedback
        // Notification create
//        $notification = new Notification();
//        $notification->setMessage("Your payment request for contract with id " . $contract->getId() . " has been approved. Please provide feedback for the client.");
//        $notification->setUser($contract->getFreelancer());
//        $notification->setTargetLink("http://localhost:8000/contract/" . $contract->getId() . "/give_feedback");
//
//        $em->persist($notification);
//        $em->flush();

        return $this->redirectToRoute('single_contract_view', ['id' => $contract->getId()]);
    }

    /**
     * @Route("/contract/{id}/request_payment", name="request_payment_for_contract")
     *
     * @param Request $request
     * @return Response
     */
    public function requestPaymentAction($id, Request $request)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);

        $contract->setIsRequestedPayment(true);

        // Notification create
        $notification = new Notification();
        $notification->setMessage("A payment request has been submited for contract with id " . $contract->getId());
        $notification->setUser($contract->getClient());
        $notification->setTargetLink("http://localhost:8000/contract/" . $contract->getId());

        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();

        $em->persist($contract);
        $em->flush();

        return $this->redirectToRoute('single_contract_view', ['id' => $contract->getId()]);
    }
}
