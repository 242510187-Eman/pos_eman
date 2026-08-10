
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            font-family:'Poppins',sans-serif;

            background:linear-gradient(135deg,#f1f5f9,#eefbf5);

            color:#334155;

            min-height:100vh;

        }

        .main-content{

            padding:35px;

            min-height:100vh;

        }

        /* Card */

        .card{

            border:none;

            border-radius:22px;

            overflow:hidden;

            box-shadow:
                0 10px 35px rgba(15,23,42,.08);

            transition:.3s;

        }

        .card:hover{

            transform:translateY(-2px);

            box-shadow:
                0 18px 40px rgba(15,23,42,.12);

        }

        /* Button */

        .btn{

            border-radius:12px;

            font-weight:600;

            transition:.25s;

        }

        .btn:hover{

            transform:translateY(-2px);

        }

        /* Table */

        .table{

            margin-bottom:0;

        }

        .table thead th{

            background:#16a34a;

            color:white;

            border:none;

            text-align:center;

            vertical-align:middle;

            font-weight:600;

        }

        .table tbody td{

            vertical-align:middle;

        }

        .table tbody tr{

            transition:.25s;

        }

        .table tbody tr:hover{

            background:#f0fdf4;

        }

        /* Image */

        img{

            border-radius:12px;

        }

        /* Badge */

        .badge{

            font-size:.85rem;

            padding:8px 14px;

            border-radius:30px;

        }

        /* Alert */

        .alert-modern{

            border:none;

            border-radius:18px;

            font-weight:600;

            padding:16px 20px;

            box-shadow:0 10px 25px rgba(0,0,0,.08);

            animation:slideDown .5s;

        }

        @keyframes slideDown{

            from{

                opacity:0;

                transform:translateY(-20px);

            }

            to{

                opacity:1;

                transform:translateY(0);

            }

        }

        /* Scrollbar */

        ::-webkit-scrollbar{

            width:9px;

        }

        ::-webkit-scrollbar-track{

            background:#e5e7eb;

        }

        ::-webkit-scrollbar-thumb{

            background:#16a34a;

            border-radius:20px;

        }

        ::-webkit-scrollbar-thumb:hover{

            background:#15803d;

        }

        /* Pagination */

        .pagination{

            justify-content:end;

        }

        .page-link{

            color:#16a34a;

            border-radius:10px !important;

            margin:0 3px;

        }

        .page-item.active .page-link{

            background:#16a34a;

            border-color:#16a34a;

        }

        /* Responsive */

        @media(max-width:768px){

            .main-content{

                padding:18px;

            }

        }

    </style>

</head>

<body>

<div class="main-content">

    @if(session('success'))

        <div class="alert alert-success alert-modern mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    @yield('content')

</div>

</body>

</html>
```
