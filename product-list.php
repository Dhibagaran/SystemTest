<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="main" style="padding: 68px 0;">
        <section class="sign-in">
            <div class="container">
                <h2 class="form-title pt-3">Product Details</h2>
                <div class="d-flex align-items-center flex-column pb-3" style="float: right;">
                    <div class="input-group">
                        <div class="form-outline">
                            <input id="filterbox" type="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
                <table id="listTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Categories Name</th>
                            <th>Description</th>
                            <th>Short Description</th>
                            <th>Images</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        //Data-table
        $('#listTable').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "sDom": 'ltipr',
            "ajax": {
                "url": "http://localhost/system_task/register-post-file.php?type=list_product"
            },
            'columns': [{
                field: 'Product Name',
                textAlign: 'center',
                data: 'name'
            }, {
                field: 'Categories Name',
                textAlign: 'center',
                data: 'categories_name'
            }, {
                field: 'Description',
                textAlign: 'center',
                data: 'description'
            }, {
                field: 'Short Description',
                textAlign: 'center',
                data: 'short_description'
            }, {
                field: 'Image',
                textAlign: 'center',
                width: 50,
                data: 'images'
            }, {
                field: 'Status',
                textAlign: 'center',
                data: 'status'
            }],
            columnDefs: [{
                targets: 4,
                render: function(data) {
                    return '<img style="max-width: 58% !important;" src="' + data + '">'
                }
            }]
        });
        //search-filter
        $("#filterbox").keyup(function() {
            var table = $('#listTable').DataTable();
            table.search(this.value).draw();
        });
    </script>
</body>

</html>