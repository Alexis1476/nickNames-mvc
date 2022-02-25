<?php $this->_title = "Liste des enseignants"; ?>
<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Surnom</th>
        <th>Options</th>
        <?= "" // CurrentUser condition        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($teachers as $teacher): ?>
        <tr>
            <td><?= $teacher['teaFirstname'] . ' ' . $teacher['teaName'] ?></td>
            <td><?= $teacher['teaNickname'] ?></td>
            <!-- If is admin -->
            <td class="containerOptions">
                <a href="#">
                    <img height="20em" src="./public/resources/img/edit.png" alt="edit">
                </a>
                <a href="#">
                    <img height="20em" src="./public/resources/img/delete.png" alt="delete">
                </a>
                <a href="#">
                    <img height="20em" src="./public/resources/img/detail.png" alt="detail">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

