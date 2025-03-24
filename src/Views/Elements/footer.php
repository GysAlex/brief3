<div style="height: 100px; background-color: rgb(96, 96, 254); margin-top: 50px; display: flex; align-items: center; justify-content: center;">
  <div style="color: white; font-weight: bold; text-align: center"> <i class="fa-solid fa-copyright mx-2" style="font-size: 1.2em;"></i> copyright metch entreprise 2025 | tous droit réservés</div>
</div>

<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

?>

<?php if ($uri == '/admin') echo "<script src='assets/admin.js'></script>"; ?>
<?php if ($uri == '/profile') echo "<script src='assets/profile.js'></script>"; ?>

<script src="assets/app.js"></script>
<script src="assets/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
<script src="assets/sweet.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.min.js" integrity="sha512-Pv/SmxhkTB6tWGQWDa6gHgJpfBdIpyUy59QkbshS1948GRmj6WgZz18PaDMOqaEyKLRAvgil7sx/WACNGE4Txw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
</body>

</html>