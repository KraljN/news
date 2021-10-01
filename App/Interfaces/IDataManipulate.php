<?php

namespace App\Interfaces;

interface IDataManipulate{

    public function edit($id);
    public function update($data, $id);
    public function destroy($id);
    public function create();
    public function store();
    
}
