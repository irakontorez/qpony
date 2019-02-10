<?php

namespace App\Controller;


use App\Entity\SequenceLengths;
use App\Form\SequenceType;
use App\Helper\StringHelper;
use App\Service\SequenceCalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SequenceController extends AbstractController
{
    /**
     * @Route("/sequence")
     * @param Request $request
     * @param StringHelper $stringHelper
     * @param SequenceCalculatorService $sequenceCalculator
     * @return Response
     */
    public function index(Request $request, StringHelper $stringHelper, SequenceCalculatorService $sequenceCalculator): Response
    {
        $sequenceLengths = new SequenceLengths();
        $form = $this->createForm(
            SequenceType::class,
            $sequenceLengths
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sequenceLengths = $stringHelper->explodeByNewLine($sequenceLengths->getLengths());
            return $this->render(
                'sequence/max.html.twig',
                ['sequenceResults' => $sequenceCalculator->calculateMaxValues($sequenceLengths)]
            );
        }

        return $this->render('sequence/index.html.twig', [
            'max' => 10,
            'form' => $form->createView(),
        ]);
    }
}