<?php


namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryformType;

class CategoryController extends AbstractController
{
    private $manager;

    private $categoryRepository;

    public function __construct(EntityManagerInterface $manager, CategoryRepository $categoryRepository)
    {
        $this->manager = $manager;
        $this->categoryRepository= $categoryRepository;
    }

    /**
     * @Route("/category/add", name="category_add")
     */
    public function add(Request $request) : Response
    {
        $category = new Category();

        $list = $this->categoryRepository->findAll();

        $form = $this->createForm(CategoryformType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $this->manager->persist($category);
            $this->manager->flush();

            return $this->redirectToRoute('category_add');
    }
        return $this->render('Category/add.html.twig',[
            'formCategory' => $form->createView(),
            "category" => $list,
        ]);
    }

}