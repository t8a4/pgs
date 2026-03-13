<?php

class Post {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){

        $stmt = $this->pdo->query("SELECT * FROM posts ORDER BY created_at DESC");

        return $stmt->fetchAll();

    }

    public function getBySlug($slug){

        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE slug = ?");

        $stmt->execute([$slug]);

        return $stmt->fetch();

    }

}