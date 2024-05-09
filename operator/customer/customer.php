<?php
include '../index.php';
$page = 'customer'; //buat page aktif di sidebar

include '../../databaseconnect/connect.php';

$sql_stock = "SELECT merk, available FROM tbl_stock";
$result_stock = mysqli_query($con, $sql_stock);


$sql = "SELECT DISTINCT merk FROM tbl_stock";
$result = mysqli_query($con, $sql);

$options = '';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['merk'] . '">' . $row['merk'] . '</option>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link rel="icon" type="image/png" href="../../img/tvstock.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="tvstock.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
    :root {
        --blue: #194376;
    }

    a {
        text-decoration: none;
    }
</style>

<body style="background-color: #dedede;">

    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Customer</p>
                </div>
            </div>
            <div class="box-top">
                <div class="box">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" name="search" id="search" placeholder="Search by name">
                </div>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#insertModal">
                    Insert Data
                </button>
            </div>

            <div class="box-container">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody id="searchResult">
                    <?php
                    include '../../databaseconnect/connect.php';

                    $sql = "SELECT * FROM `tbl_customer`";
                    $result = mysqli_query($con, $sql);
                    $data = array(); // Array untuk menyimpan data
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data[] = $row; // Menyimpan setiap baris data ke dalam array
                        }
                    }

                    $data = array_reverse($data); // Membalikkan urutan array
                    
                    $count = 1;
                    foreach ($data as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $merk = $row['merk'];
                        $price = $row['price'];
                        $amount = $row['amount'];
                        $total_price = $row['total_price'];
                        $date = $row['date'];

                        echo '
                            <tr id="' . $id . '">
                                <td>' . $count . '</td>
                                <td>' . $name . '</td>
                                <td>' . $merk . '</td>
                                <td>Rp. ' . number_format($price, 0, ',', '.') . ',-</td>
                                <td>' . $amount . '</td>
                                <td>Rp. ' . number_format($total_price, 0, ',', '.') . ',-</td>
                                <td>' . $date . '</td>
                            </tr>';
                        $count++;
                    }
                    ?>

                </tbody>
            </table>
            </div>


            <div class="modal fade" id="insertModal" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel" style="font-weight: 600;">New Customer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- Form menggunakan AJAX -->
                            <form id="insertForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="merk" class="form-label">Merk</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="merk" required>
                                        <option value="" selected disabled hidden>Select Option</option>
                                        <?php echo $options; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" required
                                        onchange="calculateTotalPrice()">
                                </div>

                                <div class="mb-3">
                                    <label for="total_price" class="form-label">Total Price</label>
                                    <input type="number" class="form-control" id="total_price" name="total_price"
                                        required>
                                </div>
                                <button type="button" class="btn btn-info" onclick="submitForm()" name="submit">Insert
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </main>

        <!-- MAIN -->
    </section>

    <!-- CONTENT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>
    <script>
        $(document).ready(function () {
            $('#role').val('operator');
        });
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                searchByUsername();
            });
        });

        $(document).ready(function () {
            $('#exampleFormControlSelect1').change(function () {
                var selectedMerk = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "fetchprice.php",
                    data: { merk: selectedMerk },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#price').val(response.price);
                        } else {
                            console.error("Gagal mengambil harga");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        console.error("Kesalahan dalam AJAX request");
                    }
                });
            });
        });

        function calculateTotalPrice() {
            var price = parseFloat($('#price').val());
            var amount = parseFloat($('#amount').val());

            if (!isNaN(price) && !isNaN(amount)) {
                var totalPrice = price * amount;
                $('#total_price').val(totalPrice.toFixed(0));
            } else {
                $('#total_price').val('');
            }

        }


        $(document).ready(function () {
            $('#exampleFormControlSelect1').change(function () {
                var selectedMerk = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "fetchprice.php",
                    data: { merk: selectedMerk },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#price').val(response.price);
                        } else {
                            console.error("Failed to fetch price");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching price:", error);
                    }
                });
            });
        });


        function submitForm() {
            var name = $('#name').val();
            var merk = $('#exampleFormControlSelect1').val();
            var price = $('#price').val();
            var amount = $('#amount').val();
            var total_price = $('#total_price').val();

            if (name === undefined || merk === undefined || price === undefined || amount === undefined || total_price === undefined) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'One or more fields are undefined!',
                });
                return;
            }

            // Validasi input
            if (name.trim() === '' || merk.trim() === '' || price.trim() === '' || amount.trim() === '' || total_price.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }

            // Kirim data ke server menggunakan Ajax
            $.ajax({
                type: "POST",
                url: "addcustomer.php",
                data: {
                    name: name,
                    merk: merk,
                    price: price,
                    amount: amount,
                    total_price: total_price
                },
                dataType: "json", // Menggunakan JSON sebagai tipe data respons
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Customer added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later.',
                    });
                }
            });
        }


        function searchByUsername() {
            var keyword = $('#search').val().trim();
            if (keyword === '') {
                $('#searchResult').load('customer.php #searchResult > *');
            } else {
                $.ajax({
                    url: 'searchusername.php',
                    type: 'POST',
                    data: { keyword: keyword },
                    success: function (response) {
                        $('#searchResult').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#searchResult').html('<tr><td colspan="5">An error occurred while processing your request.</td></tr>');
                    }
                });
            }
        }


    </script>




</body>

</html>