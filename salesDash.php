<?php
include "./connectServer.php";
session_start();

// Check if the user is authenticated (logged in)
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    // Redirect to the login page or display an error message
    header("Location: adminLogin.php"); // Redirect to the login page
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <section class="aside">
        <div class="top">
            <div class="logo">
                <img src="logo.png" alt="" />
                <h2>ICO<span class="danger">NIC</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> person_outline </span>
                <h3>Customer</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> receipt_long </span>
                <h3>Orders</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> analytics </span>
                <h3>Analytics</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> chat </span>
                <h3>Messages</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">inventory</span>
                <h3>Products</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Reports</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">settings</span>
                <h3>Settings</h3>
            </a>
            <a href="addProduct.php">
                <span class="material-icons-sharp">add</span>
                <h3>Add Product</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">logout</span>
                <h3>Log Out</h3>
            </a>
        </div>
    </section>

    <section class="container">
        <div class="main">
            <div class="top">
                <h1>Dashboard</h1>
                <div class="date">
                    <input type="date" />
                </div>
            </div>

            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales</h3>
                            <h1>Rs 5000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>

                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!---START OF EXPENSES-->
                <div class="expenses">
                    <span class="material-icons-sharp">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>Rs 5000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>

                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!---END OF EXPENSES-->
                <!---START OF INCOME-->
                <div class="income">
                    <span class="material-icons-sharp">stacked_line_chart </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>Rs 5000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>

                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!---END OF INCOME-->
            </div>
            <div class="recent-order">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Oversized T-Shirt (Black)</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">details</td>
                        </tr>
                        <tr>
                            <td>Oversized T-Shirt (White)</td>
                            <td>85632</td>
                            <td>Due</td>
                            <td class="success">Paid</td>
                            <td class="primary">details</td>
                        </tr>
                        <tr>
                            <td>Oversized T-Shirt (Beige)</td>
                            <td>85634</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>
        </div>
        
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler" id="theme-toggle-button">
                    <span class="material-icons-sharp active"> light_mode </span>
                    <span class="material-icons-sharp"> dark_mode </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Piyush</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="profile-1.jpg" />
                    </div>
                </div>
            </div>
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-2.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p>
                                <b>Piyush Shrestha </b>Just made changes with the design in the
                                website
                            </p>
                            <small class="muted-text">2 Minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-3.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p><b>Rohan Shahi </b>Iconic Official brand with standards.</p>
                            <small class="muted-text">2 Minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="profile-4.jpg" alt="" />
                        </div>
                        <div class="message">
                            <p><b>Sonam Tsering Lama </b>Cool Website</p>
                            <small class="muted-text">2 Minutes ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----SALES ANALYTICS----->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp"> shopping_cart </span>
                    </div>
                    <div class="rights">
                        <div class="info">
                            <h3>Online orders</h3>
                            <small class="text-muted">Last 24hours</small>
                        </div>
                        <h5 class="success">-29%</h5>
                        <h3>3122</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp"> local_mall </span>
                    </div>
                    <div class="rights">
                        <div class="info">
                            <h3>Offline orders</h3>
                            <small class="text-muted">Last 24hours</small>
                        </div>
                        <h5 class="danger">+39%</h5>
                        <h3>3122</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp"> person </span>
                    </div>
                    <div class="rights">
                        <div class="info">
                            <h3>New Customers</h3>
                            <small class="text-muted">Last 24hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>312</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp"> add </span>
                        <h3>Add Product</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>

</html>