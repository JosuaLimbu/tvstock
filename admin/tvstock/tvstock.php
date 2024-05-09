<?php
include '../index.php';
$page = 'tvstock'; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TV Stock</title>
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
                    <p>TV Stock</p>
                </div>
            </div>
            <div class="box-top">
                <div class="box">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" name="search" id="search" placeholder="Search by merk">
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
                        <th scope="col">Merk</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="searchResult">
                    <?php
                    include '../../databaseconnect/connect.php';

                    $sql = "SELECT * FROM `tbl_stock`";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $merk = $row['merk'];
                            $price = $row['price'];
                            $available = $row['available'];

                            echo '
                                <tr id = ' . $row['id'] . '>
                                    <td>' . $count . '</td>
                                    <td>' . $merk . '</td>
                                    <td>Rp. ' . number_format($price, 0, ',', '.') . ',-</td>
                                    <td>' . $available . ' unit</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_<?php echo $id; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $id; ?>">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['id'] . '" onclick="iddata(' . $row['id'] . ')" data-role="update">Update</a></li>
                                                <li><a class="dropdown-item delete-account" href="#" data-id="' . $row['id'] . '" ; onclick = "deletedata(' . $row['id'] . ')"> Delete</a></li>
                                            </ul>
                                        </div>
                                        <button id="updateButton_<?php echo $id; ?>"" class="btn btn-info mt-1" style="display: none;" onclick="iddata(' . $row['id'] . ')" >Update</button>
                                        <button id="deleteButton_ <?php echo $id; ?>" class="btn btn-danger mt-1" style="display: none; onclick = "deletedata(' . $row['id'] . ')">Delete</button>
                                    </td>
                                </tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>

            <div class="modal fade" id="updateModal" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update TV Stock</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm">
                                <div class="mb-3">
                                    <label for="merk" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="merk" name="merk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="available" class="form-label">Available</label>
                                    <input type="number" class="form-control" id="available" name="available" required>
                                </div>
                                <button class="btn btn-info" id="result" name="submit" onclick="updatedata(this.id)"
                                    name="submit">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="insertModal" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel">Create New TV Stock</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form menggunakan AJAX -->
                            <form id="insertForm">
                                <div class="mb-3">
                                    <label for="merkInsert" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="merkInsert" name="merk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="priceInsert" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="priceInsert" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="availableInsert" class="form-label">Available</label>
                                    <input type="number" class="form-control" id="availableInsert" name="available"
                                        required>
                                </div>
                                <button type="button" class="btn btn-info" onclick="submitForm()"
                                    name="submit">Insert</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
    <script src="../components/js/script.js"></script>
    <script src="../components/js/dropdown.js"></script>
    <script>
        $(document).ready(function () {
            $('#role').val('admin');
        });
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                searchByName();
            });
        });
        function submitForm() {
            var merk = $('#merkInsert').val();
            var price = $('#priceInsert').val();
            var available = $('#availableInsert').val();

            // Validasi input
            if (merk.trim() === '' || price.trim() === '' || available.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return; // Hentikan proses jika ada kolom yang kosong
            }

            // Kirim data ke server menggunakan Ajax
            $.ajax({
                type: "POST",
                url: "addtv.php",
                data: {
                    merk: merk,
                    price: price,
                    available: available,
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'New TV Stock added successfully!',
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


        function deletedata(id) {
            $.ajax({
                url: 'deletetv.php',
                type: 'POST',
                data: {
                    id: id,
                    action: "delete"
                },

                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'TV delete successfully!',
                        }).then(() => {
                            location.reload();
                        });
                        $('#row_' + id).remove();
                    } else if (response == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Data Cannot Be Deleted',
                        }).then(() => {
                            location.reload();
                        });

                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Something went wrong! Please try again later.");
                }
            });
        }

        //ambil nilai id di atas
        function iddata(id) {
            document.getElementById("result").setAttribute("onclick", "updatedata(" + id + ")");
            $.ajax({
                url: 'gettv.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    // Mengisi nilai form modal update dengan data TV yang diambil
                    $('#merk').val(response.merk);
                    $('#price').val(response.price);
                    $('#available').val(response.available);
                    // Menetapkan fungsi updatedata dengan ID yang diberikan
                    $('#result').attr('onclick', 'updatedata(' + id + ')');
                    // Membuka modal update
                    $('#updateModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while fetching TV data.');
                }
            });
        }

        //baru tampung
        function updatedata(id) {
            event.preventDefault();
            var newmerk = $("#merk").val();
            var newprice = $("#price").val();
            var newavailable = $("#available").val();

            if (newmerk.trim() === '' || newprice.trim() === '' || newavailable.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }

            $.ajax({
                url: "updatetv.php",
                type: "POST",
                data: {
                    id: id,
                    newmerk: newmerk,
                    newprice: newprice,
                    newavailable: newavailable
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'TV Stock Updated Successfully!',
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }


        function searchByName() {
            var keyword = $('#search').val().trim();
            if (keyword === '') {
                $('#searchResult').load('tvstock.php #searchResult > *');
            } else {
                $.ajax({
                    url: 'searchname.php',
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