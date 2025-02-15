<?php
include "./connectServer.php";
$retreiveSql = "SELECT * FROM sales";
$result = $conn->query($retreiveSql);
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css" class="stylesheet" />
    <title>Order Database</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");
</style>

<body>
    <section id="sales_info" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td> <input type="checkbox" id="myCheckbox" name="myCheckbox" value="isChecked"></td>
                    <td>Date</td>
                    <td>Customer Name</td>
                    <td>Reference</td>
                    <td>Status</td>
                    <td>Payment</td>
                    <td>Total</td>
                    <td>Paid </td>
                    <td>Due</td>
                    <td>Biller</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>
                        <input type='checkbox' name='myCheckbox' value='isChecked'>
                         </td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['customerName'] . "</td>";
                        echo "<td>" . $row['reference'] . "</td>";
                        echo "<td>" . "<div id='status'>" . $row['status'] . "</div>" . "</td>";
                        echo "<td>" . "<div id='payments'>" . $row['payments'] . "</div>" . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "<td>" . $row['paid'] . "</td>";
                        echo "<td>" . $row['due'] . "</td>";
                        echo "<td>" . $row['biller'] . "</td>";
                        echo "<td>" . "<i class='fas fa-bars' id='action'" . "</i>" . "</td>";
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>



    </section>
</body>

</html>