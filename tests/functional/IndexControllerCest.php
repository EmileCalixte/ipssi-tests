<?php


namespace functional;


class IndexControllerCest
{
    public function createContactPageWorks(\FunctionalTester $I)
    {
        $I->amOnPage('/site/index');
        $I->click('Create a contact');
        $I->see('Email', 'label');
        $I->see('Firstname', 'label');
        $I->see('Lastname', 'label');
        $I->see('Phone number', 'label');
        $I->see('Save', '.btn');
    }

    public function createContactFormCanBeSubmitted(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form with correct data');
        $I->expectTo('see that contact is created');
        $I->fillField('#editcontactform-email', 'mycontact@example.com');
        $I->fillField('#editcontactform-firstname', 'John');
        $I->fillField('#editcontactform-lastname', 'Doe');
        $I->click('Save');
        $I->dontSee('No contacts.');
        $I->see('Contact successfully created', '.alert-success');
        $I->see('Contacts list:');
        $I->see('mycontact@example.com - John Doe', 'li');
    }

    public function createContactWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form with invalid email');
        $I->expectTo('see validations errors');
        $I->submitForm('#contact-form', [
            'EditContactForm[email]' => 'invalidemail.com',
            'EditContactForm[firstname]' => 'John',
            'EditContactForm[lastname]' => 'Doe',
        ]);
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function createContactWithoutEmail(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form without email');
        $I->expectTo('see validations errors');
        $I->submitForm('#contact-form', [
            'EditContactForm[firstname]' => 'John',
            'EditContactForm[lastname]' => 'Doe',
        ]);
        $I->see('Email cannot be blank.', '.help-block');
    }

    public function createContactWithoutFirstname(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form without firstname');
        $I->expectTo('see validations errors');
        $I->submitForm('#contact-form', [
            'EditContactForm[email]' => 'mycontact@example.com',
            'EditContactForm[lastname]' => 'Doe',
        ]);
        $I->see('Firstname cannot be blank.', '.help-block');
    }

    public function createContactWithoutLastname(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form without lastname');
        $I->expectTo('see validations errors');
        $I->submitForm('#contact-form', [
            'EditContactForm[email]' => 'mycontact@example.com',
            'EditContactForm[firstname]' => 'John',
        ]);
        $I->see('Lastname cannot be blank.', '.help-block');
    }

    public function createContactWithInvalidPhoneNumber(\FunctionalTester $I)
    {
        $I->amOnPage('site/create-contact');
        $I->amGoingTo('submit create contact form with invalid phone number');
        $I->expectTo('see validations errors');
        $I->submitForm('#contact-form', [
            'EditContactForm[email]' => 'mycontact@example.com',
            'EditContactForm[firstname]' => 'John',
            'EditContactForm[lastname]' => 'Doe',
            'EditContactForm[phoneNumber]' => '0000',
        ]);
        $I->see('The format of Phone Number is invalid.', '.help-block');
    }

    public function editContactPageWorks(\FunctionalTester $I)
    {
        $this->createContactFormCanBeSubmitted($I); // Create a contact before edition test
        $I->amOnPage('site/index');
        $I->click('Edit');
        $I->see('Email', 'label');
        $I->see('Firstname', 'label');
        $I->see('Lastname', 'label');
        $I->see('Phone number', 'label');
        $I->see('Save', '.btn');
    }

    public function editContact(\FunctionalTester $I)
    {
        $this->createContactFormCanBeSubmitted($I); // Create a contact before edition test
        $I->amOnPage('site/index');
        $I->amGoingTo('edit a contact');
        $I->click('Edit');
        $I->submitForm('#contact-form', [
            'EditContactForm[email]' => 'mycontactedited@example.com',
            'EditContactForm[firstname]' => 'Dave',
            'EditContactForm[lastname]' => 'Johnson',
        ]);
        $I->see('Contacts list:');
        $I->see('mycontactedited@example.com - Dave Johnson', 'li');
    }

    public function deleteContact(\FunctionalTester $I)
    {
        $this->createContactFormCanBeSubmitted($I); // Create a contact before deletion test
        $I->amOnPage('site/index');
        $I->amGoingTo('delete a contact');
        $I->click('Edit');
        $I->click('Delete');
        $I->see('Contact deleted', '.alert-success');
    }
}