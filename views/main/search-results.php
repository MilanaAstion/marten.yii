<h1>результаты поиска</h1>
<p>слова: <?php echo $searchTerm ?></p>
<?php foreach($results as $result): ?>
    <p><?php echo $result->name; ?></p>
<?php endforeach; ?> 