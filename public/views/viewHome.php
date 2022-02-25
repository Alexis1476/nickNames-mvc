<?php $this->_title = "Liste des enseignants"; ?>
<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Surnom</th>
        <th>Options</th>
        <?= "" // CurrentUser condition     ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($teachers as $teacher): ?>
        <tr>
            <td><?= $teacher['teaFirstname'] . ' ' . $teacher['teaName'] ?></td>
            <td><?= $teacher['teaNickname'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

