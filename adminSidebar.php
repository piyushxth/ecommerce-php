<section class="aside">
    <div class="top">
        <div class="logo">
            <img src="profile-1.png" alt="" />
            <h2>ICO<span class="danger">NIC</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>

    <div class="sidebar">
        <a href="salesDash2.php" <?php echo ($currentPage === 'salesDash2.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
        </a>
        <a href="storeUsers" <?php echo ($currentPage === 'storeUsers.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp"> person_outline </span>
            <h3>Store Users</h3>
        </a>
        <a href="adminCategories.php" <?php echo ($currentPage === 'adminCategories.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp"> receipt_long </span>
            <h3>Categories</h3>
        </a>
        <a href="adminProduct1.php" <?php echo ($currentPage === 'adminProducts.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp"> analytics </span>
            <h3>Products</h3>
        </a>
        <a href="adminOrder.php" <?php echo ($currentPage === 'adminOrder.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp"> chat </span>
            <h3>Orders</h3>
        </a>
        <a href="adminAnalytics.php" <?php echo ($currentPage === 'adminAnalytics.php') ? 'class="active"':''?>>
            <span class="material-icons-sharp">inventory</span>
            <h3>Analytics</h3>
        </a>

        </a>
    </div>

</section>