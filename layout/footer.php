<?php
include_once 'controller/headerController.php'
?>
<footer>
    <div class="container footer-information py-5">
        <h4 class="heading mb-4">
            About Biography
        </h4>
        <div class="row row-cols-3 py-4 footer-sections border-top">
            <div class="footer-section">
                <h5>
                    <?php echo $foundation['code'] ?>
                </h5>
                <p><?php echo $foundation['value'] ?></p>
            </div>
            <div class="footer-section">
                <h5>
                    <?php echo $prize_awarding['code'] ?>
                </h5>
                <p><?php echo $prize_awarding['value'] ?></p>
            </div>
            <div class="footer-section">
                <h5>
                    <?php echo $outreach['code'] ?>
                </h5>
                <p><?php echo $outreach['value'] ?></p>
            </div>
        </div>
        <div class="row row-cols-4 py-4 footer-sections border-top">
            <div class="footer-section">
                <p>Press</p>
                <p>Contact</p>
                <p>FAQ</p>
            </div>
            <div class="footer-section">
                <p>Privacy policy</p>
                <p>Technical support</p>
                <p>Term of use</p>
            </div>
            <div class="footer-section">
                <p>For developers</p>
                <p>Media player</p>
            </div>
            <div class="footer-section">
                <p>Join us</p>
                <ul>
                    <li><a href="<?php echo $facebook["slug"] ?>"><i class="fa-brands fa-facebook fs-5"></i></a></li>
                    <li><a href="<?php echo $instagram["slug"] ?>"><i class="fa-brands fa-instagram fs-5"></i></a></li>
                    <li><a href="<?php echo $twitter["slug"] ?>"><i class="fa-brands fa-twitter fs-5"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/slide.js"></script>
<script src="assets/js/sidebar.js"></script>
<script src="assets/js/datetime.js"></script>