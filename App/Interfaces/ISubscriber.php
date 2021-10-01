<?php 
namespace App\Interfaces;

interface ISubscriber{

    public function subscribe($email, $id);
    public function getSubscribers($id);
    
}