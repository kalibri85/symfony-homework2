<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return $this->render('home/index.html.twig');


    }
    /**
     * @Route("/validate/{element}", name="validatePerson")
     * @Route("/validate/{element}", name="validateProject")
     * @Method({"POST"})
     */

    public function validate(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
             return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents();
        $projects = $this->getProjects();

        switch ($element) {
            case 'name';
                return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
            case 'project';
                return new JsonResponse(['valid' => in_array(strtolower($input), $projects)]);
        }
        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }

    private function getStorage()
    {
        return /** @lang json*/
            '{
          "Po pamok\u0173": {
            "mentor": "Tomas",
            "members": [
              "Elena",
              "Just\u0117",
              "Deimantas"
            ]
          },
          "Tech Guide": {
            "mentor": "Sergej",
            "members": [
              "Matas",
              "Martynas"
            ]
          },
          "Kelion\u0117s draugas": {
            "mentor": "Rokas",
            "members": [
              "Zbignev",
              "Aist\u0117"
            ]
          },
          "Wish A Gift": {
            "mentor": "Aistis",
            "members": [
              "Nerijus",
              "Olga"
            ]
          },
          "Mums pakeliui": {
            "mentor": "Paulius",
            "members": [
              "Egl\u0117",
              "Svetlana"
            ]
          },
          "Motyvacin\u0117 platforma": {
            "mentor": "Audrius",
            "members": [
              "Viktoras",
              "Airidas"
            ]
          }
        }';

    }

    private function getStudents() {

        $students = [];
        $storage = json_decode($this->getStorage(),true);


        foreach ($storage as $teamDate){
            foreach ($teamDate['members'] as $student){
                $students[] = strtolower($student);
            }

        }
        return $students;
    }

    private function getProjects() {
       $projects = [];
       $storage = json_decode($this->getStorage(),true);

       foreach (array_keys($storage) as $key){
           $projects[] = strtolower($key);
        }
        return $projects;
    }

}





