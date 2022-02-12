<?php

namespace App\Controller;


use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param ProduitRepository $produitRepository
     * @return Response
     */
    public function index( Request $request, ProduitRepository $produitRepository): Response
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []);
        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }

        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Request $request, Produit $produit, ProduitRepository $produitRepository ): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $session = $request->getSession();
//        // stores an attribute in the session for later reuse
//        $session->set('panier', []);

        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        // On sauvegarde dans la session
        $session->set("panier", $panier);
//        dd($panier);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Request $request, Produit $produit, produitRepository $produitRepository)
    {
        // On récupère le panier actuel
        $session = $request->getSession();
        $panier = $session->get("panier", []);

        $id = $produit->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Request $request,Produit $produit)
    {
        // On récupère le panier actuel
        $session = $request->getSession();
        $panier = $session->get("panier", []);

        $id = $produit->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $session = $request->getSession();
        $panier = $session->get("panier", []);

        $session->remove("panier");

        return $this->redirectToRoute("cart_index");
    }
}