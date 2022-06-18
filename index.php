<?php require_once "include/header.php";?>

<div id="tablediv">
<table>
    <th>Name</th>
    <th>Breed</th>
    <th>Age</th>
    <th>Fixed</th>
    <th>Vaccinated</th>
    <th>Actions</th>
    

    <?php if($model->dogs): ?>
        <?php foreach($model->dogs as $dog): ?>
            <tr>
                <td><?=$dog['dog_name']?></td>
                <td><?=$dog['breed_name']?></td>
                <td><?=$dog['age']?></td>
                <td><?=$dog['is_fixed']?></td>
                <td><?=$dog['is_vaccinated']?></td>
                <td>
                    <a href="dog-form.php?id=<?=$dog['dog_id']?>">Edit</a>
                    <a href="delete-dog.php?id=<?=$dog['dog_id']?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
</div>

<nav>
    <a href="dog-form.php">Add new dog</a>
</nav>

<?php require_once "include/footer.php";?>