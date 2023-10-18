<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Contacts app</title>
</head>
<body>
<div class="container my-5 bg-body-tertiary rounded-3">
    <div class="p-5 text-center">
        <h1 class="text-body-emphasis">Contacts</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        <div class="d-inline-flex gap-2 mb-5">
            <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                New contact &#160;<span>&#43;</span>
                <i class="bi bi-plus-circle-fill"></i>
            </button>
        </div>
    </div>
    <ul class="list-group list-group-light m-3">
<?php
        foreach ($call['data']['db_data'] as $contact){
?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                     class="rounded-circle" />
                <div class="ms-3">
                    <p class="fw-bold mb-1"><?= $contact['name'] ?></p>
                    <p class="text-muted mb-0"><?= $contact['phone'] ?></p>
                </div>
            </div>
            <a class="btn btn-link btn-rounded btn-sm" href="#" role="button">View</a>
        </li>
<?php
                }
?>
    </ul>
</div>
</body>
</html>
