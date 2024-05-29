<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class LinkBD extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }
    public function addMovie_Actor($movie_id, $actor_id,$played_name) {
        // Requête SQL pour insérer un nouveau actor
        $sql = "INSERT INTO movie_actor (movie_id, actor_id,played_name) 
                VALUES (:movie_id, :actor_id, :played_name)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':movie_id' => movie_id,
            ':actor_id' => actor_id,
            ':played_name' => played_name]);
    }

    public function addListOfMovie_Actor($list) {
        // Requête SQL pour insérer un nouveau tag
        foreach ($list as $actor) {
            if(!$this->addMovie_Actor($actor['id'],$actor['actor_id'],$actor['played_name'])) {
                return false;
            }
        }
        return true;
    }

    public function addMovie_Tag($movie_id, $tag_id) {
        // Requête SQL pour insérer un nouveau tag
        $sql = "INSERT INTO movie_tag (movie_id, tag_id) 
                VALUES (:movie_id, :tag_id)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':movie_id' => movie_id,
            ':tag_id' => tag_id]);
    }

    public function addListOfMovie_Tag($list) {
        // Requête SQL pour insérer un nouveau tag
        foreach ($list as $tag) {
            if(!$this->addMovie_Tag($tag['movie_id'], $tag['tag_id'])){
                return false;
            }
        }
        return true;
    }
    public function addMovie_Director($movie_id, $director_id) {
        // Requête SQL pour insérer un nouveau director
        $sql = "INSERT INTO movie_director (movie_id, director_id) 
                VALUES (:movie_id, :director_id)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':movie_id' => movie_id,
            ':director_id' => director_id]);
    }
    public function addListOfMovie_Director($list) {
        // Requête SQL pour insérer un nouveau tag
        foreach ($list as $director) {
            if(!$this->addMovie_Director($director['movie_id'], $director['director_id'])){
                return false;
            }
        }
        return true;
    }

    public function addMovie_Composer($movie_id, $composer_id) {
        // Requête SQL pour insérer un nouveau composer
        $sql = "INSERT INTO movie_director (movie_id, composer_id) 
                VALUES (:movie_id, :composer_id)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':movie_id' => movie_id,
            ':composer_id' => composer_id]);
    }
    public function addListOfMovie_Composer($list) {
        // Requête SQL pour insérer un nouveau tag
        foreach ($list as $composer) {
            if(!$this->addMovie_Composer($composer['movie_id'], $composer['composer_id'])){
                return false;
            }
        }
        return true;
    }

}