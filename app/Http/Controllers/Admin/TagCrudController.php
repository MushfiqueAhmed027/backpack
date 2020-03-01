<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\TagRequest;

class TagCrudController extends CrudController {

  use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

  public function setup()
  {
      $this->crud->setModel('App\Models\Tag');
      $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
      $this->crud->setEntityNameStrings('tag', 'tags');

      $this->crud->operation('list', function() {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
      });

      $this->crud->operation(['create', 'update'], function() {
        $this->crud->addValidation(TagCrudRequest::class);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
      });
  }



  protected function setupListOperation()
  {
      $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
  }

  protected function setupCreateOperation()
  {
      $this->crud->setValidation(TagRequest::class);
      $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
  }

  protected function setupUpdateOperation()
  {
      $this->setupCreateOperation(); // since this calls the methods above, no need to do anything here
  }
}