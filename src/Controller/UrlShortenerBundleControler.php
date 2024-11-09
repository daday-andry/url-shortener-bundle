<?php

namespace Daday\UrlShortenerBundle\Controller;

use Daday\UrlShortenerBundle\Entity\Url;
use Daday\UrlShortenerBundle\Repository\UrlRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class UrlShortenerBundleControler extends AbstractController
{

    public function __construct(private UrlRepository $repository)
    {

    }

    public function generate(Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $urlEntity = null;

        $csrfToken = $csrfTokenManager->getToken('url_shortener_form')->getValue();
        
        
        if ($request->isMethod('POST')) {
            
            $submittedToken = $request->request->get('_token');

            if (!$csrfTokenManager->isTokenValid(new CsrfToken('url_shortener_form', $submittedToken))) {
                throw $this->createAccessDeniedException('Token CSRF invalide.');
            }

            $original = $request->request->get('original');

            if (!$original) {
                throw  new Exception('Original URL is required');
            }

            $urlEntity = $this->repository->findOneByOriginal($original);

            if(!$urlEntity){
                $urlEntity = (new Url())->setOriginal($original);
                $this->repository->save($urlEntity);
            }

        }

        return $this->render('@UrlShortener/generate.html.twig', [
            'csrf_token' => $csrfToken,
            'url' => $urlEntity
        ]);
        
    }

    public function index(string $shortCode): Response
    {
        $url = $this->repository->findOneByShortCode($shortCode);

        if(!$url){
            throw $this->createNotFoundException('Invalid shortcode');
        }

        return $this->redirect($url->getOriginal());
    }
}
