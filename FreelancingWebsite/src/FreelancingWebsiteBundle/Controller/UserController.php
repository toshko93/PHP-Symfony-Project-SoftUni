<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Role;
use FreelancingWebsiteBundle\Entity\User;
use FreelancingWebsiteBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);

            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("security_login");
        }

        return $this->render("default/register.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/my_profile", name="my_profile_view")
     * @param Request $request
     * @return Response
     */
    public function viewMyProfileAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $myProfile = $this->getUser();

        return $this->render('users/my_profile.html.twig', ['myProfile' => $myProfile]);
    }

    /**
     * @Route("/freelancer/{id}", name="freelancer_profile_view")
     * @param Request $request
     * @return Response
     */
    public function viewFreelancerProfileAction($id)
    {
        $freelancer = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('users/freelancer_profile.html.twig', ['freelancer' => $freelancer]);
    }

    /**
     * @Route("/client/{id}", name="client_profile_view")
     * @param Request $request
     * @return Response
     */
    public function viewClientProfileAction($id)
    {
        $client = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('users/client_profile.html.twig', ['client' => $client]);
    }
}
