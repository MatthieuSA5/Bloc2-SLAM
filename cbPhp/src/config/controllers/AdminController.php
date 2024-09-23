<?php

namespace App\controllers;

use App\models\Utilisateur;

class AdminController extends BaseController{
 
    public function index(){
        $users = Utilisateur::all();
        return $this->render("./admin/users.html.twig",['users'=>$users]);
    }

    public function addUserForm(){
        $u=new Utilisateur();
        return $this->render ("./admin/userForm.html.twig",['user'=>$u]);
    }

    public function addUser(){
        $users=new Utilisateur();
        $users->login=$_POST['login'];
        $users->password=$_POST['password'];
        if ($users->save()){
            return $this->index();
        }
    }

    public function updateUserForm(){
        $u=Utilisateur();
        return $this->render ("./admin/userForm.html.twig",['user'=>$u]);
    }
}