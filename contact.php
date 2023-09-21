<?php
session_start(); 
include_once 'layout/head.php';
include_once 'controller/contactController.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/header.php'
?>
<main class="container my-5">
    <div class="container">
        <h2>Contact Us</h2>
        <div class="row  mb-5">
            <div class="col-md-6 khoi-thong tin">
                <div class=" row thong-tin">
                    <div class="mt-3"><i class="fa-solid fa-phone fs-5"></i><a href="'<?php echo $hotline['slug'] ?>'"> <?php echo $hotline['value'] ?></a></div>
                    <div class="mt-3"><i class="fa-solid fa-envelope fs-5"></i><a href="'<?php echo $email['slug'] ?>'"> <?php echo $email['value'] ?></a></div>
                    <div class="mt-3"><i class="fa-brands fa-facebook fs-5"></i><a href="'<?php echo $facebook['slug'] ?>'"> <?php echo $facebook["value"] ?></a></div>
                    <div class="mt-3"><i class="fa-brands fa-instagram fs-5"></i><a href="'<?php echo $instagram['slug'] ?>'"> <?php echo $instagram["value"] ?></a></div>
                    <div class="mt-3"><i class="fa-brands fa-twitter fs-5"></i><a href="'<?php echo $twitter['slug'] ?>'"> <?php echo $twitter["value"] ?></a></div>
                </div>
                <div class=" row msg mt-5">
                    <h2>Send message</h2>
                    <form method="post" action="contact.php">
                        <div class="mb-2">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-2">
                            <textarea class="form-control" id="message" rows="6" name="message" placeholder="Message" require></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submit">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 khoi-map">
                <iframe src="<?php echo $address['slug'] ?>" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>
    </div>
    <?php
    renderTicker()
    ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include_once 'layout/footer.php';


if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    echo '
        <script>
            Swal.fire({
                title: "' . $_SESSION['message'] . '",
                text: "' . $_SESSION['text'] . '",
                icon: "' . $_SESSION['status'] . '"
            })
        </script>
    ';
    unset($_SESSION['message']);
    unset($_SESSION['text']);
    unset($_SESSION['status']);
}

?>
</body>

</html>