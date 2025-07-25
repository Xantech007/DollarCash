<?php
session_start();
include('inc/header.php');
include('inc/navbar.php');

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Scan CashTag</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item active">Scan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']);
    }
    ?>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        Input CashTag to Scan
                    </div>
                    <div class="card-body mt-3">
                        <form action="scan-results.php" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="text" name="scan_input" placeholder="Paste or type your input here">
                                <button type="button" class="btn btn-outline-secondary" id="button"><i class="bi bi-clipboard"></i></button>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Scan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Paste Functionality -->
    <script>
        let input = document.querySelector("#text");
        let inputbutton = document.querySelector("#button");

        inputbutton.addEventListener('click', pasteFromClipboard);

        function pasteFromClipboard() {
            navigator.clipboard.readText().then(text => {
                if (text.trim()) {
                    input.value = text.trim();
                    inputbutton.innerHTML = 'pasted!';
                    setTimeout(() => {
                        inputbutton.innerHTML = '<i class="bi bi-clipboard"></i>';
                    }, 2000); // Revert after 2 seconds
                } else {
                    console.warn('Clipboard is empty');
                    inputbutton.innerHTML = 'no data!';
                    setTimeout(() => {
                        inputbutton.innerHTML = '<i class="bi bi-clipboard"></i>';
                    }, 2000);
                }
            }).catch(err => {
                console.error('Paste failed:', err);
                inputbutton.innerHTML = 'error!';
                setTimeout(() => {
                    inputbutton.innerHTML = '<i class="bi bi-clipboard"></i>';
                }, 2000);
            });
        }
    </script>
</main><!-- End #main -->

<?php include('inc/footer.php'); ?>

<!-- Inline CSS for Layout -->
<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #main {
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center; /* Center content vertically */
    }

    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        z-index: 1000;
        text-align: center;
        padding: 10px 0;
    }

    body {
        padding-bottom: 60px; /* Adjust based on footer height */
    }

    @media (max-width: 576px) {
        .footer {
            padding: 5px 0;
            font-size: 14px;
        }
    }
</style>
</html>
