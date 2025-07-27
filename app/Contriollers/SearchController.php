<?php

namespace App\Controllers;

class SearchController extends AbstractController {
    protected function handleRequest(){
         $query = $_GET['query'] ?? '';
        
        
        $resul = [
            'query' => $query,
            'resul' => [
                'hurón 1', 'hurón 2', 'hurón 3'
            ]
        ];

        $this->jsonResponse($resultados);
    }
}