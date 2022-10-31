</main>
    <!-- footer-->
    <footer>
        <div class="footer-container bg-secondary-dark-5">
            <div class="footer bg-secondary-dark-5">
                <div class="footer-heading footer-1">
                    <h2>Alternativ</h2>
                    <a href="menu.php">Meny hantering</a>
                    <a href="reservations.php">Boknings hantering</a>
                </div>
                <div class="footer-heading footer-2">
                    <?php
                    if(isset($_SESSION['username'])) {
                        ?>
                        <h2>Admin</h2>
                        <p>Inloggad: <?= $_SESSION['username'] ?></p>
                        <p><a class="btn-secondary" href="logout.php">Logga ut</a></p>
                        <?php
                    }?>                   
                </div>
                <div class="footer-heading footer-3">

                </div>

            </div>
        </div>

    </footer>
</body>

</html>