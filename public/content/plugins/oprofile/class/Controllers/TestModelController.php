<?php

namespace OProfile\Controllers;

use OProfile\Models\DeveloperTechnologyModel;


class TestModelController extends CoreController
{

    public function cteateTable()
    {
        echo 'je suis methode create table';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->createTable();
    }
    public function dropTable()
    {
        echo 'je suis methode drop table';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->dropTable();
    }
    public function insert()
    {
        echo 'je suis methode insert';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->insert(9, 10, 4);
        $modelObject->insert(9, 11, 2);
    }
    public function delete()
    {
        echo 'je suis methode delete';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->delete(1);
    }
    public function update()
    {
        echo 'je suis methode update';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->update(2, 10, 3);
    }
    public function getTechnologyByUserId()
    {
        echo 'je suis methode update';
        $modelObject = new DeveloperTechnologyModel();
        $modelObject->getTechnologyByUserId(9);
    }
}
