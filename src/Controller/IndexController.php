<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Avis;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
//use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * @Route("/", name="home")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'produits' => $produitRepository->findAll(),
        ]);
    }
        /**
     * @Route("/BMX", name="BMX", methods={"GET"})
     */
    public function BMX(ProduitRepository $produitRepository): Response
    {
        return $this->render('index/bmx.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
