<?php namespace models;

use app\models\Contact;
use app\models\exceptions\MyCustomException;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Transaction;

class ContactTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var Transaction */
    private $transaction;
    
    protected function _before()
    {
        $this->transaction = \Yii::$app->db->beginTransaction();
    }

    protected function _after()
    {
        $this->transaction->rollBack();
    }

    /**
     * Tests that a correct contact can be saved
     */
    public function testSaveOK()
    {
        $contact = new Contact();
        $contact->firstname = 'Firstname';
        $contact->lastname = 'Lastname';
        $contact->email = 'sample@example.com';
        $this->assertTrue($contact->save());
        $this->assertNotNull($contact->id);
        $this->assertInstanceOf(Contact::class, Contact::findOne(['id' => $contact->id]));
    }

    /**
     * Tests that a contact with no firstname cannot be saved
     */
    public function testSaveKONoFirstname()
    {
        $contact = new Contact();
        $contact->lastname = 'Lastname';
        $contact->email = 'sample@example.com';
        $this->assertFalse($contact->save());
    }

    /**
     * Tests that a contact with no lastname cannot be saved
     */
    public function testSaveKONoLastname()
    {
        $contact = new Contact();
        $contact->firstname = 'Firstname';
        $contact->email = 'sample@example.com';
        $this->assertFalse($contact->save());
    }

    /**
     * Tests that a contact with no email cannot be saved
     */
    public function testSaveKONoEmail()
    {
        $contact = new Contact();
        $contact->firstname = 'Firstname';
        $contact->lastname = 'Lastname';
        $this->assertFalse($contact->save());
    }

    /**
     * Tests that the firstname setter is working
     */
    public function testSetFirstnameOK()
    {
        $contact = new Contact();
        $contact->firstname = 'Firstname';
        $this->assertEquals('Firstname', $contact->firstname);
    }

    /**
     * Tests that a too long firstname cannot be set
     */
    public function testSetFirstnameKOTooLong()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->firstname = 'ThisStringIsTooLongBecauseItIsSeventeenCharactersAndThisIsTooMuchOhYes';
    }

    /**
     * Tests that an empty firstname cannot be set
     */
    public function testSetFirstnameKOEmpty()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->firstname = '';
    }

    /**
     * Tests that a firstname cannot be set to null
     */
    public function testSetFirstnameKONull()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->firstname = null;
    }

    /**
     * Tests that the lastname setter is working
     */
    public function testSetLastnameOK()
    {
        $contact = new Contact();
        $contact->lastname = 'Lastname';
        $this->assertEquals('Lastname', $contact->lastname);
    }

    /**
     * Tests that a too long lastname cannot be set
     */
    public function testSetLastnameKOTooLong()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->lastname = 'ThisStringIsTooLongBecauseItIsSeventeenCharactersAndThisIsTooMuchOhYes';
    }

    /**
     * Tests that an empty lastname cannot be set
     */
    public function testSetLastnameKOEmpty()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->lastname = '';
    }

    /**
     * Tests that a lastname cannot be set to null
     */
    public function testSetLastnameKONull()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->lastname = null;
    }

    /**
     * Tests that the email setter is working
     */
    public function testSetEmailOK()
    {
        $contact = new Contact();
        $contact->email = 'sample@example.com';
        $this->assertEquals('sample@example.com', $contact->email);
    }

    /**
     * Tests that an invalid email cannot be set
     */
    public function testSetEmailKOInvalid()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->email = 'invalid.email';
    }

    /**
     * Tests that an empty email cannot be set
     */
    public function testSetEmailKOEmpty()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->email = '';
    }

    /**
     * Tests that a email cannot be set to null
     */
    public function testSetEmailKONull()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->email = null;
    }

    // TODO Phone number tests
}