<?php

namespace App\Controller;

use App\Service\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class DefaultController extends AbstractController
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * DefaultController constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="docs.index")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/service/{name}", name="docs.service")
     *
     * @param string $name
     * @return Response
     */
    public function pageAction(string $name): Response
    {
        $file = __DIR__ . sprintf('/../../docs/%s.service.json', $name);
        if (!is_file($file)) {
            throw new NotFoundHttpException($file);
        }

        $data = $this->serializer->deserialize(file_get_contents($file), 'array');
//        VarDumper::dump($data); die();
        return $this->render('default/page.html.twig', [
            'data' => $data
        ]);
    }
}