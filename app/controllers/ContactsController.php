<?php

class ContactsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
        $this->load_model('ContactsModel');
    }

    public function index_action()
    {
        $contacts = $this->contactsmodel->find_all_by_user_id(current_user()->id, ['order'=>'name']);
        $this->view->contacts = $contacts;
        $this->view->render('contacts/index');
    }

    public function add_action()
    {
        $contact = new ContactsModel();
        $validation = new Validate();
        if($_POST){
            $contact->user_id = current_user()->id;
            $contact->deleted = 0;
            $contact->assign($_POST);
            $validation->check($_POST, ContactsModel::validation());
            if($validation->passed()){
                $contact->save();
                Router::redirect('contacts');
            }
        }
        $this->view->contact = $contact;
        $this->view->post_action = SROOT . 'contacts/add';
        $this->view->display_errors = $validation->display_errors();
        $this->view->render('contacts/add');
    }

    public function details_action($id)
    {
        $contact = $this->contactsmodel->find_by_id_user_id($id, current_user()->id);
        if(!$contact)
        {
            Router::redirect('contacts');
        }
        $this->view->contact = $contact;
        $this->view->render('contacts/details');
    }

}