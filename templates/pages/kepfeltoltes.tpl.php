<title>Galéria</title>

<body>
<div id="galeria">
<h1>Galéria</h1>
<?php
arsort($kepek);
foreach($kepek as $fajl => $datum)

{
?>
<div class="kep">
<a href="<?php echo $MAPPA.$fajl ?>">
<img src="<?php echo $MAPPA.$fajl ?>">
</a>
<p>Név: <?php echo $fajl; ?></p>
<p>Dátum: <?php echo date($DATUMFORMA, $datum); ?></p>
</div>
<?php
}
?>
<h1>Feltöltés a galériába:</h1>
<?php
    if (!empty($uzenet))
    {
        echo '<ul>';
        foreach($uzenet as $u)
            echo "<li>$u</li>";
        echo '</ul>';
    }
?>
    <form action="index.php" method="post"
                enctype="multipart/form-data">
        <label>Első:
            <input type="file" name="elso" required>
        </label>
         
        <input type="submit" name="kuld">
      </form>    
</body>



