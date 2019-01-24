<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventRequest as StoreRequest;
use App\Http\Requests\EventRequest as UpdateRequest;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings('event', 'events');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        $this->crud->addColumn([
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title'
        ]);
        $this->crud->addColumn([
            'name' => 'attendance_limit',
            'type' => 'number',
            'label' => 'Attendance Limit'
        ]);
        $this->crud->addColumn([
            'name' => 'organizers',
            'type' => 'text',
            'label' => 'Organizers'
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'boolean',
            'label' => 'Active Event'
        ]);
        $this->crud->addColumn([
            'name' => 'donations_enabled',
            'type' => 'boolean',
            'label' => 'Donations Enabled'
        ]);

        $this->crud->addField([
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title'
        ]);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Event Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public'
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'simplemde',
            'label' => 'Description',
            'simplemdeAttributes' => [
                'promptURLs' => true,
                'status' => false,
                'spellChecker' => true,
                'forceSync' => true,
            ]
        ]);
        $this->crud->addField([
            'name' => 'attendance_limit',
            'type' => 'number',
            'label' => 'Attendance Limit'
        ]);
        $this->crud->addField([
            'name' => 'organizers',
            'type' => 'text',
            'label' => 'Organizers'
        ]);
        $this->crud->addField([
            'name' => 'organizer_link',
            'type' => 'url',
            'label' => 'Organizer\'s Link'
        ]);
        $this->crud->addField([
            'name' => 'date',
            'type' => 'datetime_picker',
            'label' => 'Date',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'en'
            ],
        ]);
        $this->crud->addField([
            'name' => 'location',
            'type' => 'address_google',
            'label' => 'Location',
            'store_as_json' => true
        ]);
        $this->crud->addField([
            'name' => 'helpline',
            'type' => 'text',
            'label' => 'Helpline Numbers'
        ]);
        $this->crud->addField([
            'name' => 'active',
            'type' => 'checkbox',
            'label' => 'Active'
        ]);
        $this->crud->addField([
            'name' => 'donations_enabled',
            'type' => 'checkbox',
            'label' => 'Donations Enabled'
        ]);
        $this->crud->addField([
            'name' => 'donation_limit',
            'type' => 'number',
            'label' => 'Donations Limit'
        ]);

        // add asterisk for fields that are required in EventRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->enablePersistentTable();
        $this->crud->enableDetailsRow();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function showDetailsRow($id)
    {
        $event = $this->crud->model::findOrFail($id);

        $event = $event->toArray();
        $event['location'] = json_decode($event['location'], true);
        $eventDetails = view('event.minor_details')->with('event', $event)->render();
        return $eventDetails;
    }
}
