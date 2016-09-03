<?php

/**
 * ContactController short summary.
 *
 * ContactController description.
 *
 * @version 1.0
 * @author Jelena
 */
class ContactController extends Controller
{
    public function info()
    {
		$contact = Contact::readContactInfo();
		
		$this->View->render('pages/contact', array('contact' => $contact));
		exit();
		
    }

    public function edit()
    {
		$contact = Contact::readContactInfo();
		
		$this->View->render('pages/contact_edit', array('contact' => $contact));
		exit();
    }
	
	public function update_info()
	{
		$president = strip_tags(Request::post('president'));
		$vicePresident = strip_tags(Request::post('vicePresident'));
		$prmanager = strip_tags(Request::post('prmanager'));
        $phone1 = strip_tags(Request::post('phone1'));
		$phone2 = strip_tags(Request::post('phone2'));
        $phone3 = strip_tags(Request::post('phone3'));
        $fax = strip_tags(Request::post('fax'));
        $email = strip_tags(Request::post('email'));
        $address = strip_tags(Request::post('address'));
		
		$result = Contact::updateContactInformation ($president, $vicePresident, $prmanager, $phone1, $phone2, $phone3, $fax, $email, $address );
        
		if ($result)
		{
			Redirect::to('contact/info');
			exit();
		}
		else
		{
			Redirect::to('contact/edit');
			exit();
		}
	}
}
