<?php

/** @var \app\models\Contact[] $contacts */

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php
    if(empty($contacts)) {
        ?>
        <p>No contacts.</p>
        <?php
    } else {
        ?>
        <p>Contacts list:</p>
        <ul>
            <?php
            foreach($contacts as $contact) {
                ?>
                <li>
                    <?= Html::encode($contact->email) ?>
                    -
                    <?= Html::encode($contact->firstname . " " . $contact->lastname) ?>
                    -
                    <?= empty($contact->phone_number) ? '<i>No phone number</i>' : Html::encode($contact->phone_number) ?>
                    -
                    <a href="/site/edit-contact?id=<?= $contact->id ?>">Edit</a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>

    <a href="/site/create-contact">Create a contact</a>

</div>
