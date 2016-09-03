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
		if ($contact)
		{
			$this->View->render('pages/contact', array('contact' => $contact));
			exit();
		}
    }

    public function edit()
    {
        $this->View->render('pages/contact_edit');
        exit();
    }

}