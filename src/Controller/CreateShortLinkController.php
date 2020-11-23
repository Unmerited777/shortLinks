<?php

namespace App\Controller;

use App\Entity\RedirectCounter;
use App\Entity\ShortLink;
use App\Form\Type\ShortLinkType;
use App\Repository\ShortLinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateShortLinkController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $request
     * @return Response
     */
    public function createNewShortLinkForm(Request $request): Response
    {
        $shortLink = new ShortLink();
        $form = $this->createForm(ShortLinkType::class, $shortLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shortLink = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shortLink);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }

        return $this->render('shortLink/createNewShortLinkForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/success", name="success")
     * @return Response
     */
    public function shortenedLinkSuccess(): Response
    {
        return new Response(
            '<html><body><span>Success!</span></body></html>'
        );
    }

    /**
     * @param ShortLinkRepository $shortLinkRepository
     * @param string $string
     * @Route("/view/{string}", name="view")
     * @return Response
     */
    public function viewLink(ShortLinkRepository $shortLinkRepository, string $string): Response
    {
        $id = ShortLink::getIdFromShortLink($string);
        $shortLink = $shortLinkRepository->find($id);

        if (empty($shortLink)) {
            $message = 'The link with id:' . $id . ' - ' . $string . ' was not found.';
            $status = 404;
        } else {
            $message = 'The link ' . $shortLink->getShortLink() . ' would redirect you to ' . $shortLink->getFullLink() . '.';
            $status = 200;
        }

        return new Response(
            '<html><body><span>' . $message . '</span></body></html>', $status
        );
    }

    /**
     * @param ShortLinkRepository $shortLinkRepository
     * @param string $string
     * @Route("/{string}", name="redirect")
     * @return RedirectResponse
     */
    public function redirectToFullLink(ShortLinkRepository $shortLinkRepository, string $string): RedirectResponse
    {
        $id = ShortLink::getIdFromShortLink($string);
        $hydratedShortLink = $shortLinkRepository->find($id);

        if (empty($hydratedShortLink)) {
            $shortLink = new ShortLink();
            $url = $shortLink->getBaseShortURL();
        } else {
            $url = $hydratedShortLink->getFullLink();
            $redirect = new RedirectCounter();
            $redirect->setShortLink($hydratedShortLink);
            $redirect->setRedirectedDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($redirect);
            $entityManager->flush();
        }

        return $this->redirect($url);
    }
}