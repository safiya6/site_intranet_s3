<?php require "view_begin.php"?>
<?php var_dump($_SESSION);if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
    <!--AFFICHAGE DU GRAPHE QUOTITE!-->
    <div class="graph-container" style="width: 600px; height: 600px;">
        <h1> quotite par departement</h1>
            <canvas width="100px" height="100px" id="graphiqueCercle"></canvas>
    </div>

    <div>

<script>graphiqueDoughnut("graphiqueCercle", <?php echo $_SESSION["quotite"]; ?>,'quotite par departement');</script>
    <!--AFFICHAGE DU GRAPHE complémentaire !-->
<div class="graph-container" style="width: 600px; height: 600px;">
      <h1> complémentaire vs staturaire <h1>
      <canvas width="100px" height="100px" id="graphiqueC"></canvas>

  </div>
  <script>graphiqueCamenbert("graphiqueC", <?php echo $_SESSION["pourcentage"]; ?>);</script>

<!-- AFFICHAGE DU Graphe statutaire !-->

<div class="graph-container" style="width: 600px; height: 600px;">
  <h1> service complémentaire vs référentiel </h1>
      <canvas  id="graphiqueB"></canvas>
  </div>
  <script>graphiqueBar("graphiqueB", <?php echo $_SESSION["S_vs_C"];?> ,'service statutaire','service complémentaire');</script>
<!-- AFFICHAGE DU GRAPHE DES HEURE DE DISCIPLINE SELON LE DEPPARTEMENT-->
<div class="graph-container" style="width: 600px; height: 600px;">
  <h1> heure par discipline</h1>
  <form action="?controller=page&action=rendre" method="post">
    <label for="semestre1">Semestre 1</label>
    <input type="radio" id="semestre1" name="semestre" value="1" <?= ($_SESSION['semestre'] == 1) ? 'checked' : ''; ?>>

    <label for="semestre2">Semestre 2</label>
    <input type="radio" id="semestre2" name="semestre" value="2" <?= ($_SESSION['semestre'] == 2) ? 'checked' : ''; ?>>

    <input type="submit" value="Choisir">
</form>
      <canvas  id="graphiqueBH2"></canvas>
  </div>
  <script>graphiqueBarresHorizontales("graphiqueBH2", <?php echo $_SESSION["HeurediscIUTDept"]; ?>);</script>

<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php" ;?>