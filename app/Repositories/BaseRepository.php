<?php

namespace App\Repositories;

interface BaseRepository {

    public function index();
    public function create($new = []);
    public function view($id);
    public function update($id, $data = []);
    public function delete($id);

}