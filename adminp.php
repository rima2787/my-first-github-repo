<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="adminc.css">

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">SeedNest</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="add_product()" >
                        <i class="fas fa-regular fa-file"></i>
                        <span>Add product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="view_product()">
                        <i class="fas fa-regular fa-file"></i>
                        <span>View Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="admin_order_history()">
                        <i class="fas fa-regular fa-file"></i>
                        <span>Order History</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth2" aria-expanded="false" aria-controls="auth2">
                        <i class="fas fa-square-poll-vertical"></i>
                        <span>Result</span>
                    </a>
                    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">class-1</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">class-2</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">class-3</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">class-4</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">class-5</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="notice.html" class="sidebar-link">
                        <i class="fas fa-triangle-exclamation"></i>
                        <span>Notice</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="routine.html" class="sidebar-link">
                        <i class="fas fa-regular fa-file"></i>
                        <span>Routine</span>
                    </a>
                </li> -->
            </ul>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand custom-navbar-height px-4">
                <div class="mb-3 py-3">
                <h3 class="fw-bold fs-4 mb-3 text-white"><i class="fa-solid fa-user-tie"></i>
                        <span class="px-2">Admin Dashboard</span></h3>
                </div>
                <div class="navbar-collapse collapse" >
                    <ul class="navbar-nav ms-auto">
                        <div class="sidebar-footer">
                            <a href="logout.php" class="sidebar-link">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </ul>
                </div>
            </nav>
            <div id="targetdiv">
                

            </div>
           
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start ">
                            <a class="text-body-secondary" href=" #">
                                <strong></strong>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
  
  hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
  });
      </script>
      <script>
        function add_product() {
    console.log("add_product() called");
    $.ajax({
        url: "add_productp.php",
        method: "post",
        Cache: false,
        data: { record: 1 },
        success: function (data) {
            console.log("add_product() success");
            $('#targetdiv').empty();
            $('#targetdiv').html(data);
        }
    });
}
      </script>
      <script>
        function view_product() {
    console.log("view_product() called");
    $.ajax({
        url: "view_productp.php",
        method: "post",
        Cache: false,
        data: { record: 1 },
        success: function (data) {
            console.log("view_product() success");
            $('#targetdiv').empty();
            $('#targetdiv').html(data);
        }
    });
}
      </script>
      <script>
        function admin_order_history() {
    console.log("admin_order_history() called");
    $.ajax({
        url: "admin_order_history.php",
        method: "post",
        Cache: false,
        data: { record: 1 },
        success: function (data) {
            console.log("admin_order_history() success");
            $('#targetdiv').empty();
            $('#targetdiv').html(data);
        }
    });
}
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="Javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="Javascript/ajaxw.js"> </script>

</body>

</html>