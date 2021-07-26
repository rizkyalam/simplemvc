<?php 

namespace App\Controllers;

use Core\Controller;
use Core\ModelFactory;

/**
 * Example of controller
 * which using a model with simple CRUD
 */
class UserController extends Controller
{
    /**
     * Display of all data from storage.
     */
    public function index()
    {
        ModelFactory::model('User')->all();
    }

    /**
     * Insert a new data in storage.
     */
    public function store()
    {
        $data = [
            'username' => 'test',
            'password' => password_hash('test', PASSWORD_BCRYPT),
        ];

        ModelFactory::model('User')->create($data);
    }

    /**
     * Display the specified data from storage.
     *
     * @param $id
     */
    public function show($id)
    {
        $select_data = ['username', 'password'];

        $where = ['user_id' => $id];
        
        ModelFactory::model('User')->get($select_data, $where);
    }

    /**
     * Update the specified data in storage.
     * 
     * @param $id
     */
    public function update($id)
    {
        $data = [
            'password' => password_hash('testing', PASSWORD_BCRYPT),
        ];

        ModelFactory::model('User')->update($data, $id);
    }

    /**
     * Delete the specified data from storage.
     *
     * @param $id
     */
    public function delete($id)
    {
        ModelFactory::model('User')->delete($id);
    }
}
