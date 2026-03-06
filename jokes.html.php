<p><?=$totalJokes?> jokes have been submitted to the Internet Joke Database.</p>

<?php foreach ($jokes as $joke): ?>
<blockquote>
    <p style="font-size: 1.1em; margin-bottom: 10px;">
        <strong>Joke Text:</strong> 
        <?=htmlspecialchars($joke['joketext'] ?? '', ENT_QUOTES, 'UTF-8')?>
    </p>
    
    <p style="color: #555; margin-bottom: 15px;">
        <strong>Joke Category:</strong> 
        <?=htmlspecialchars($joke['categoryName'] ?? 'Uncategorized', ENT_QUOTES, 'UTF-8')?>
        <br />
        
        (by <a href="mailto:<?=htmlspecialchars($joke['email'] ?? '', ENT_QUOTES, 'UTF-8');?>">
        <?=htmlspecialchars($joke['name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8'); ?></a>)
        
        <a href="editjoke.php?id=<?=$joke['id']?>" style="margin-left: 10px; color: blue;">Edit</a>
    </p>

    <form action="deletejoke.php" method="post" style="clear: both;">
        <input type="hidden" name="id" value="<?=$joke['id']?>">
        <input type="submit" value="Delete" style="cursor: pointer;">
    </form>
</blockquote>
<?php endforeach; ?>