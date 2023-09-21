


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.css">
    <link href="assets/css/admin.css" rel="stylesheet" />
    <style>
        tbody tr td {
            overflow: hidden;
            white-space: nowrap;
            max-width: 250px;
            /* width: auto; */
        }

        .form-control select {
            border: none;
            border-radius: 0.375rem;
            width: 100%;
            padding: 0.375rem 0.75rem;
        }

        .form-control select:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.3rem rgba(0, 123, 255, 0.25);
        }

        ul {
            list-style: none;
        }

        .update,
        .delete,
        .view-link {
            text-decoration: none;
            color: #B4C472;
            text-align: center;
        }

        .update:hover,
        .delete:hover,
        .view-link:hover {
            text-decoration: none !important;
        }

        #create {
            float: right;
            margin-left: 50px;
        }

        body {
            height: 100%;
        }

        .avatar-mini {
            width: 75px;
            height: 100px;
        }

        .img-mini {
            width: 125px;
            height: 75px;
        }

        .img-list-mini {
            margin-right: 10px;
            width: 150px;
            height: 100px;
            flex-basis: 0;
        }

        #avatar-preview,
        #img-preview {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .image-preview {
            position: relative;
            display: inline-block;
            margin-right: 20px;
            padding-bottom: 10px;

        }

        #preview-avatar {
            width: 75px;
            height: 100px;
        }

        .preview-image,
        #preview-img {
            width: 125px;
            height: 75px;
        }

        #delete-icon,
        .delete-icon {
            position: absolute;
            top: -23px;
            right: -13px;
            color: black;
            font-size: 25px;
            cursor: pointer;
        }

        .modal-lg {
            max-width: 900px;
        }

        .password-toggle {
            position: relative;
            top: -24px;
            right: 10px;
            cursor: pointer;
            width: 20px;
            height: 20px;
            color: gray;
            position: absolute;
            right: 20px;
            top: 18px;
        }

        .input-password-container {
            position: relative;
        }

        #feedback-badge {
            position: relative;
            top: -5px;
            left: 5px;
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            visibility: hidden;
            /* Ẩn ban đầu */
        }

        #feedback-link:hover #feedback-badge {
            visibility: visible;
            /* Hiển thị khi hover */
        }

        .status-span {
            color: red;
            font-weight: bolder;
            position: absolute;
            left: 25px;
        }
    </style>
</head>
