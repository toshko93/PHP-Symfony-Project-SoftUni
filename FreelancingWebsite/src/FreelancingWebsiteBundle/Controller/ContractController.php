<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Contract;
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

        $contract = new Contract();
        $contract->setSumAgreed($priceAgreed);
        $contract->setJobPost($jobPost);
        $contract->setProposal($proposal);
        $contract->setClient($client);
        $contract->setFreelancer($freelancer);

        // Notification create
        $notification = new Notification();
        $notification->setMessage("A contract has started on the job with id " . $jobPost->getId());
        $notification->setUser($contract->getFreelancer());

        $em = $this->getDoctrine()->getManager();
        $em->persist($contract);
        $em->flush();

        $notification->setTargetLink("http://localhost:8000/contract/" . $contract->getId());
        $em->persist($notification);
        $em->flush();

        return $this->redirectToRoute('single_contract_view', ['id' => $contract->getId(), 'jobPost' => $jobPost, 'contract' => $contract]);
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

        $myContracts = $this->getDoctrine()->getRepository(Contract::class)->findBy(['clientId' => $myId]);

        return $this->render('contract/my_contracts.html.twig', ['myContracts' => $myContracts]);
    }
}
