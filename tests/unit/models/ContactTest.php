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
        $contact->setFirstname('Firstname');
        $contact->setLastname('Lastname');
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
        $contact->setLastname('Lastname');
        $this->assertFalse($contact->save());
    }

    /**
     * Tests that a contact with no lastname cannot be saved
     */
    public function testSaveKONoLastname()
    {
        $contact = new Contact();
        $contact->setFirstname('Firstname');
        $this->assertFalse($contact->save());
    }

    /**
     * Tests that the firstname setter is working
     */
    public function testSetFirstnameOK()
    {
        $contact = new Contact();
        $contact->setFirstname('Firstname');
        $this->assertEquals('Firstname', $contact->firstname);
    }

    /**
     * Tests that a too long firstname cannot be set
     */
    public function testSetFirstnameKOTooLong()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->setFirstname('ThisStringIsTooLongBecauseItIsSeventeenCharactersAndThisIsTooMuchOhYes');
    }

    /**
     * Tests that the lastname setter is working
     */
    public function testSetLastnameOK()
    {
        $contact = new Contact();
        $contact->setLastname('Lastname');
        $this->assertEquals('Lastname', $contact->lastname);
    }

    /**
     * Tests that a too long lastname cannot be set
     */
    public function testSetLastnameKOTooLong()
    {
        $contact = new Contact();
        $this->expectException(MyCustomException::class);
        $contact->setLastname('ThisStringIsTooLongBecauseItIsSeventeenCharactersAndThisIsTooMuchOhYes');
    }

    // TODO Phone number tests
}