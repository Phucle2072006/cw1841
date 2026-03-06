<form action="" method="post" enctype="multipart/form-data">
    <label for='joketext'>Type your joke here:</label>
    <textarea name="joketext" rows="3" cols="40" required></textarea>

    <label for="image">Select image:</label>
    <input type="file" name="image" id="image">

    <label for="authors">Select an author:</label>
    <select name="authors" required>
        <option value="">--Select an author--</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?=htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <?=htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="categories">Select a category:</label>
    <select name="categories" required>
        <option value="">--Select a category--</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <?=htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
    </select>   

    <input type="submit" name="submit" value="Add">
</form>