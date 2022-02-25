<?php
$this->_title = "Liste des enseignants";

foreach ($teachers as $teacher): ?>
    <h2><?= $teacher['teaFirstname'] ?></h2>
<?php endforeach; ?>
