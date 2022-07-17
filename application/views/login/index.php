<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Data -->
    <title><?php echo $title ?></title>
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>

    <section class="login-content">
        <div class="logo">
            <h1>
                Balai Besar Tekstil Bandung
            </h1>
        </div>

        <div class="login-box">

            <?php $this->load->view('partials/alert') ?>

            <form class="login-form" method="POST" action="<?php echo site_url('authenticate') ?>" onsubmit="return validate()">
                <h3 class="login-head">
                    Login
                </h3>

                <div class="form-group">
                    <label class="control-label" for="username">
                        Username
                    </label>

                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Usernname" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="password">
                        Password
                    </label>

                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" autocomplete="off">
                </div>

                <!-- CSRF Token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-sign-in fa-lg fa-fw"></i>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/main.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace.min.js"></script>

    <script>
        function validate() {
            let username = $('#username').val();
            let password = $('#password').val();

            if (username == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Username tidak boleh kosong !',
                })

                return false;
            }

            if (password == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Password tidak boleh kosong !',
                })

                return false;
            }

            return true;
        }
    </script>
</body>

</html>